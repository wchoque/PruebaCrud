<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Api\ApiResponse;
use App\Models\Ubigeo;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function paises(){
        $r =new ApiResponse();
        $pais=Ubigeo::where('tipo',1)->get();
        $r->data= $pais;

        return response()->json($r);
    }
    public function departamento(Request $request){
        $r =new ApiResponse();
        $departamento=Ubigeo::where('ubigeo_id_ubigeo',$request->get('ubigeo_id_ubigeo'))->get();
        $r->data= $departamento;
        return response()->json($r);
    }
    public function provincia(Request $request){
        $r =new ApiResponse();
        $provincia=Ubigeo::where('ubigeo_id_ubigeo',$request->get('ubigeo_id_ubigeo'))->get();
        $r->data= $provincia;
        return response()->json($r);
    }
    public function distrito(Request $request){
        $r =new ApiResponse();
        $distrito=Ubigeo::where('ubigeo_id_ubigeo',$request->get('ubigeo_id_ubigeo'))->get();
        $r->data= $distrito;
        return response()->json($r);
    }
}
