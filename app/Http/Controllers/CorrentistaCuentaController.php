<?php

namespace App\Http\Controllers;

use App\Models\Entidad_bancaria;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use App\Models\Correntista_cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CorrentistaCuentaController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function obtenerBancos(){
        $r= new ApiResponse();
        $bancos=Entidad_bancaria::all();
        $r->data=$bancos;
        return response()->json($r);
    }
    public function obtenerCuentas(Request $request){
        $r =new ApiResponse();
        $id_corren=$request->get('id_corren');
        $cuentas=Correntista_cuenta::where('corren_id_corren',$id_corren)->get();
        foreach($cuentas as $cuenta){
            $banco=Entidad_bancaria::find($cuenta->entban_id_entban);
            $cuenta->bancodesc=$banco->descripcion;
        }
        $r->data= $cuentas;
        return response()->json($r);
    }
    public function cuentaInsertar(Request $request)
    {
        $r = new ApiResponse();

        $datacuenta= $request->all();

        if ($request->get('id_corcue', 0) == 0) {
            $cuenta = new Correntista_cuenta();
            $datacuenta['creado_por']=Auth::user()->name;
        } else {
            $cuenta = Correntista_cuenta::find($request->get('id_corcue'));
            $datacuenta['modificado_por']=Auth::user()->name;
        }
        $validate=$cuenta->isValid($datacuenta);
        if ($validate->passes()) {
            $cuenta->fill($datacuenta);
            $cuenta->save();

        }else{
            $r->error=$validate->errors();
            $r->status->setStatus(Status::ERROR_PARAMS);
        }

        $r->data = $cuenta;
        return response()->json($r);
    }
    public function cuentaEliminar(Request $request)
    {
        $r = new ApiResponse();

        if ($request->get('id_corcue', 0) != 0) {
            $id=$request->get('id_corcue');
            $perfil = Correntista_cuenta::find($id);
            $perfil->forceDelete();
        } else {
            $r->status->setStatus(Status::ERROR_PARAMS);
        }
        return response()->json($r);
    }
}
