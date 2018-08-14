<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RolController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function obtenerRoles(Request $request)
    {
        $r = new ApiResponse();
        $roles = Rol::all();
        $r->data = $roles;
        return response()->json($r);
    }
     public function rolInsertar(Request $request)
    {
        $r = new ApiResponse();

        $datarol = $request->all();

        if ($request->get('id', 0) == 0) {
            $rol = new Rol();
            $datarol['creado_por']=Auth::user()->name;
        } else {
            $rol = Rol::find($request->get('id'));
            $datarol['modificado_por']=Auth::user()->name;
        }
        $validate=$rol->isValid($datarol);
        if ($validate->passes()) {
            $rol->fill($datarol);
            $rol->save();

        }else{
            $r->error=$validate->errors();
            $r->status->setStatus(Status::ERROR_PARAMS);
        }

        $r->data = $rol;
        return response()->json($r);
    }
    public function rolEliminar(Request $request)
    {
        $r = new ApiResponse();

        if ($request->get('id', 0) != 0) {
            $id=$request->get('id');
            $rol = Rol::find($id);
            $last=Rol::orderBy('created_at', 'desc')->first();
            if($id==$last->id){
                $rol->delete();
            }else{
                $r->status->setStatus(Status::ERROR_PARAMS);
            }
        } else {
            $r->status->setStatus(Status::ERROR_PARAMS);
        }
        return response()->json($r);
    }
}
