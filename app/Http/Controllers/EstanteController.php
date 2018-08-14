<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use App\Models\Almacen;
use App\Models\Casillero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Estante;

class EstanteController extends Controller
{
    public function obtenerTodoEstantes(Request $request)
    {
        $r = new ApiResponse();

        $estantes = Estante::all();
        $r->data = $estantes;
        return response()->json($r);
    }
    public function obtenerEstantes(Request $request)
    {
        $r = new ApiResponse();
        $id_almace=$request->get('id_almace');
        $estantes = Estante::where('almace_id_almace',$id_almace)->get();
        foreach($estantes as $estante){
            $estante->numero_casilleros=Casillero::where('estant_id_estant',$estante->id_estant)->count();
        }
        $r->data = $estantes;
        return response()->json($r);
    }
    public function estanteInsertar(Request $request)
    {
        $r = new ApiResponse();

        $dataestant = $request->all();

        if ($request->get('id_estant', 0) == 0) {
            $estante = new Estante();
            $dataestant['creado_por']=Auth::user()->name;
        } else {
            $estante = Estante::find($request->get('id_estant'));
            $dataestant['modificado_por']=Auth::user()->name;
        }
        $validate=$estante->isValid($dataestant);
        if ($validate->passes()) {
            $estante->fill($dataestant);
            $estante->save();
            for($num=1; $num<=$dataestant['numero_casilleros'];$num++){
                $casillero=new Casillero();
                $casillero->estant_id_estant=$estante->id_estant;
                $casillero->nombre='0'.$num;
                $estante->creado_por=$dataestant['creado_por'];
                $casillero->save();
            }

        }else{
            $r->error=$validate->errors();
            $r->status->setStatus(Status::ERROR_PARAMS);
        }

        $r->data = $estante;
        return response()->json($r);
    }
    public function estanteEliminar(Request $request)
    {
        $r = new ApiResponse();

        if ($request->get('id_estant', 0) != 0) {
            $id=$request->get('id_estant');
            $estante = Estante::find($id);
            $casilleros=Casillero::where('estant_id_estant',$id)->count();
            if($casilleros==0){
                $estante->delete();
            }else{
                $r->status->setStatus(Status::ERROR_PARAMS);
            }
        } else {
            $r->status->setStatus(Status::ERROR_PARAMS);
        }
        return response()->json($r);
    }
}
