<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use App\Models\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FamiliaController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function obtenerFamilias(Request $request)
    {
        $r = new ApiResponse();
        $familias = Familia::all();
        $r->data = $familias;
        return response()->json($r);
    }
    public function obtenerFamiliasPadre(Request $request)
    {
        $r = new ApiResponse();
        $familias = Familia::whereNull('famili_id_familia')->get();
        $r->data = $familias;
        return response()->json($r);
    }
    public function familiaInsertar(Request $request)
    {
        $r = new ApiResponse();

        $datafamilia = $request->all();

        if ($request->get('id_famili', 0) == 0) {
            $familia = new Familia();
            $datafamilia['creado_por']=Auth::user()->name;
            $count=Familia::count();
            $count++;
            $datafamilia['codigo']='FAM'.$count;
        } else {
            $familia = Familia::find($request->get('id_famili'));
            $datafamilia['modificado_por']=Auth::user()->name;
        }
        $validate=$familia->isValid($datafamilia);
        if ($validate->passes()) {
            if ($request->hasFile('foto')) {
                $familia->foto = $request->file('foto')->storeAs('public/familias', uniqid() . '.' . $request->file('foto')->extension());
            }
            $familia->fill($datafamilia);
            $familia->save();

        }else{
            $r->error=$validate->errors();
            $r->status->setStatus(Status::ERROR_PARAMS);
        }

        $r->data = $familia;
        return response()->json($r);
    }
    public function familiaEliminar(Request $request)
    {
        $r = new ApiResponse();

        if ($request->get('id_famili', 0) != 0) {
            $id=$request->get('id_famili');
            $familia = Familia::find($id);
            $last=Familia::orderBy('created_at', 'desc')->first();
            if($id==$last->id){
                $familia->delete();
            }else{
                $r->status->setStatus(Status::ERROR_PARAMS);
            }
        } else {
            $r->status->setStatus(Status::ERROR_PARAMS);
        }
        return response()->json($r);
    }
}
