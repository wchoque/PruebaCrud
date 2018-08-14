<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function obtenerUsuarios(Request $request)
    {
        $r = new ApiResponse();
        $usuario = Usuario::all();
        $usuario->load('roles');

        foreach($usuario as $u){
            $rols=array();

            foreach($u->roles as $rol){
                array_push($rols,$rol->id);
            }
            $u->rol= $rols;
        }
        $r->data = $usuario;
        return response()->json($r);
    }
    
    public function usuarioInsertar(Request $request)
    {
        $r = new ApiResponse();

        $datausuario = $request->all();

        if ($request->get('id', 0) == 0) {
            $usuario = new Usuario();
            $datausuario['creado_por']=Auth::user()->name;
        } else {
            $usuario = Usuario::find($request->get('id'));
            $datausuario['modificado_por']=Auth::user()->name;
        }
        $validate=$usuario->isValid($datausuario);
        if ($validate->passes()) {
            $usuario->fill($datausuario);
            $usuario->save();
            $usuario->roles()->detach();
            $usuario->roles()->attach($datausuario['rol']);

        }else{
            $r->error=$validate->errors();
            $r->status->setStatus(Status::ERROR_PARAMS);
        }

        $r->data = $usuario;
        return response()->json($r);
    }
    public function usuarioEliminar(Request $request)
    {
        $r = new ApiResponse();

        if ($request->get('id', 0) != 0) {
            $id=$request->get('id');
            $usuario = Usuario::find($id);
            $last=Usuario::orderBy('created_at', 'desc')->first();
            if($id==$last->id){
                $usuario->delete();
            }else{
                $r->status->setStatus(Status::ERROR_PARAMS);
            }
        } else {
            $r->status->setStatus(Status::ERROR_PARAMS);
        }
        return response()->json($r);
    }
}
