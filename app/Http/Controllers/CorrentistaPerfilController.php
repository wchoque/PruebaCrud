<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use App\Models\Correntista_dato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CorrentistaPerfilController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function obtenerContactos(Request $request)
    {
        $r = new ApiResponse();
        $id = $request->get('id_corren');
        $correntista_datos = DB::table('correntista_datos')->where('correntista_datos.corren_id_corren', $id)->where('principal',0)->get();
        $r->data = $correntista_datos;
        return response()->json($r);
    }

    /**/

      public function obtenerAlmacenes(Request $request)
    {
        $r = new ApiResponse();
        $id = $request->get('id_almace');
        $almacen_datos = DB::table('almacenes')->where('almacen.id_almace', $id);
        $r->data = $almacen_datos;
        return response()->json($r);
    }


    /**/
    public function contactoInsertar(Request $request)
    {
        $r = new ApiResponse();

        $datacorrentista = $request->all();

        if ($request->get('id_cordat', 0) == 0) {
            $perfil = new Correntista_dato();
            $datacorrentista['creado_por']=Auth::user()->name;
        } else {
            $perfil = Correntista_dato::find($request->get('id_cordat'));
            $datacuenta['modificado_por']=Auth::user()->name;
        }
        $validate=$perfil->isValid($datacorrentista);
        if ($validate->passes()) {
            $perfil->fill($datacorrentista);
            $perfil->save();

        }else{
            $r->error=$validate->errors();
            $r->status->setStatus(Status::ERROR_PARAMS);
        }

        $r->data = $perfil;
        return response()->json($r);
    }
    public function contactoEliminar(Request $request)
    {
        $r = new ApiResponse();

        if ($request->get('id_cordat', 0) != 0) {
            $id=$request->get('id_cordat');
            $perfil = Correntista_dato::find($id);
            $perfil->forceDelete();
        } else {
            $r->status->setStatus(Status::ERROR_PARAMS);
        }
        return response()->json($r);
    }
}
