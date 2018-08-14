<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\Status;
use App\Models\Correntista_dato;
use App\Models\Correntista_tipo;
use App\Models\Maestro_correntista;
use App\Models\Ubigeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Correntista;
use Illuminate\Support\Facades\Auth;

class CorrentistaController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function Index(){

        return view('correntista');
    }
    public function selectData(){
        $r =new ApiResponse();

        $tipo_documentos= DB::table('tipo_documentos')->select('tipo_documentos.id_tipdoc','tipo_documentos.descripcion')->get();
        $ubigeos= DB::table('ubigeos')->select('ubigeos.id_ubigeo','ubigeos.nombre')->where('ubigeos.tipo',1)->get();

        $r->data['tipo_documentos']=$tipo_documentos;
        $r->data['ubigeos']=$ubigeos;
        return response()->json($r);
    }
    //clientes
    public function obtenerClientes(Request $request){
        $r =new ApiResponse();

        $correntistas= DB::table('correntistas')
            ->join('correntista_datos', 'correntistas.id_corren', '=', 'correntista_datos.corren_id_corren')
            ->join('maestro_correntista', 'correntistas.id_corren', '=', 'maestro_correntista.corren_id_corren')

            ->select('correntistas.id_corren','correntista_datos.telefono','correntistas.nombres','correntistas.apellidos','correntistas.direccion','correntistas.estado','maestro_correntista.codigo','correntistas.num_doc')
            ->where('correntista_datos.principal',1)
            ->get();

        $r->data= $correntistas;
        return response()->json($r);
    }
    public function obtenerCliente(Request $request){
        $r =new ApiResponse();

        $id=$request->get('id_corren');

        $correntistas=Correntista::find($id)->load('cliente','contactoPrincipal');
        /* $correntistas= DB::table('correntistas')
             ->join('maestro_correntista', 'correntistas.id_corren', '=', 'maestro_correntista.corren_id_corren')
             ->join('correntista_datos', 'correntistas.id_corren', '=', 'correntista_datos.corren_id_corren')
             ->select( 'foto','maestro_correntista.codigo','correntistas.tipdoc_id_tipdoc','correntista_datos.telefono','correntistas.nombres','correntistas.distribuidor','correntistas.apellidos','correntistas.direccion',
                 'correntistas.estado','maestro_correntista.codigo','correntistas.num_doc','correntistas.razon_social','correntistas.nombre_comercial','correntistas.extranjero','correntista_datos.movil','correntista_datos.email','correntistas.ubigeo_id_ubigeo','correntistas.notas','correntistas.direccion'
             )
             ->where('correntista_datos.principal',1)
             ->where('correntistas.id_corren',$id)
             ->first();*/
        if($correntistas->ubigeo_id_ubigeo!=null){
            $distrito=Ubigeo::find($correntistas->ubigeo_id_ubigeo);
            $correntistas->distrito=$distrito->id_ubigeo;
            $provincia=Ubigeo::find($distrito->ubigeo_id_ubigeo);
            $correntistas->provincia=$provincia->id_ubigeo;
            $departamento=Ubigeo::find($provincia->ubigeo_id_ubigeo);
            $correntistas->departamento=$departamento->id_ubigeo;
            $pais=Ubigeo::find($departamento->ubigeo_id_ubigeo);
            $correntistas->pais=$pais->id_ubigeo;
        }else{
            $correntistas->distrito='';
            $correntistas->provincia='';
            $correntistas->departamento='';
            $correntistas->pais='';
        }

        // $correntistas->foto=base64_decode(utf8_encode($correntistas->foto));
        $r->data=$correntistas;
        return response()->json($r);
    }
    public function clienteInsertar(Request $request){
        $r =new ApiResponse();


        try{
            $datacorrentista =$request->all();

            if($datacorrentista['fecha_nacimiento']!=null && $datacorrentista['fecha_nacimiento']!='Invalid Date'){
                $fecha=$datacorrentista['fecha_nacimiento'];

                $rest = substr($fecha, 0,24);

                $ymd = \DateTime::createFromFormat('D M d Y h:i:s', $rest)->format('Y-m-d H:i:s');
                $datacorrentista['fecha_nacimiento']=$ymd;
            }
            if($datacorrentista['tipdoc_id_tipdoc']==0){
                $datacorrentista['tipdoc_id_tipdoc']=null;
            }



            $m=1;
            if($request->get('id_corren',0)==0){
                $correntista=new Correntista();
                $datacorrentista['creado_por']=Auth::user()->name;
            }else{
                $correntista=Correntista::find($request->get('id_corren'));
                $m=0;
                $datacorrentista['modificado_por']=Auth::user()->name;
            }
            $validate=$correntista->isValidCliente($datacorrentista);
            if($validate->passes()){
                if ($request->hasFile('foto')) {
                    $correntista->foto = $request->file('foto')->storeAs('public/fotos', uniqid() . '.' . $request->file('foto')->extension());
                }

                $correntista->fill($datacorrentista);
                if($correntista->extranjero){
                    $correntista->ubigeo_id_ubigeo=null;
                }

                $correntista->save();
                if($m){
                    $maestro_correntista=new Maestro_correntista();


                    $maestro_correntista->corren_id_corren=$correntista->id_corren;
                    $correntista_tipo=Correntista_tipo::where('descripcion','CLIENTE')->first();
                    $maestro_correntista->tipcor_id_tipcor=$correntista_tipo->id_tipcor;
                    $count_corren=Maestro_correntista::where('tipcor_id_tipcor',$correntista_tipo->id_tipcor)->count();
                    $count_corren++;
                    $maestro_correntista->codigo='CLI'.$count_corren;
                    $maestro_correntista->save();
                }
                if($request->get('id_corren',0)==0){
                    $correntista_principal=new Correntista_dato();
                }else{
                    $correntista_principal=Correntista_dato::where('corren_id_corren',$request->get('id_corren'))->first();
                    $datacorrentista['id_corr_datos']=$correntista_principal->id_corr_datos;

                }
                $correntista_principal->fill($datacorrentista);
                $correntista_principal->principal=true;
                $correntista_principal->corren_id_corren=$correntista->id_corren;
                $correntista_principal->save();
            }
            else{
                $r->error=$validate->errors();
                $r->status->setStatus(Status::ERROR_PARAMS);
            }
            $r->data= $correntista;
        } catch (\Exception $e) {
            $r->status->setStatus(Status::ERROR_PROCESS);
            $r->status->details = "Error al procesar la información";
        }
        return response()->json($r);
    }

    //empleados
    public function obtenerEmpleados(Request $request){
        $r =new ApiResponse();

        $correntistas= DB::table('correntistas')
            ->join('correntista_datos', 'correntistas.id_corren', '=', 'correntista_datos.corren_id_corren')
            ->join('maestro_correntista', 'correntistas.id_corren', '=', 'maestro_correntista.corren_id_corren')

            ->select('correntistas.id_corren','correntista_datos.telefono','correntistas.nombres','correntistas.apellidos','correntistas.direccion','correntistas.estado','maestro_correntista.codigo','correntistas.num_doc','correntistas.cargo')
            ->where('correntista_datos.principal',1)
            ->where('maestro_correntista.tipcor_id_tipcor',3)
            ->get();

        $r->data= $correntistas;
        return response()->json($r);
    }
    public function obtenerEmpleado(Request $request){
        $r =new ApiResponse();

        $id=$request->get('id_corren');

        $correntistas=Correntista::find($id)->load('empleado','contactoPrincipal');
        if($correntistas->ubigeo_id_ubigeo!=null){
            $distrito=Ubigeo::find($correntistas->ubigeo_id_ubigeo);
            $correntistas->distrito=$distrito->id_ubigeo;
            $provincia=Ubigeo::find($distrito->ubigeo_id_ubigeo);
            $correntistas->provincia=$provincia->id_ubigeo;
            $departamento=Ubigeo::find($provincia->ubigeo_id_ubigeo);
            $correntistas->departamento=$departamento->id_ubigeo;
            $pais=Ubigeo::find($departamento->ubigeo_id_ubigeo);
            $correntistas->pais=$pais->id_ubigeo;
        }else{
            $correntistas->distrito='';
            $correntistas->provincia='';
            $correntistas->departamento='';
            $correntistas->pais='';
        }
        $r->data=$correntistas;
        return response()->json($r);
    }
    public function empleadoInsertar(Request $request){
        $r =new ApiResponse();

        //try{
            $datacorrentista =$request->all();
            $m=1;
            if($datacorrentista['fecha_nacimiento']!=null && $datacorrentista['fecha_nacimiento']!='Invalid Date'){
                $fecha=$datacorrentista['fecha_nacimiento'];

                $rest = substr($fecha, 0,24);

                $ymd = \DateTime::createFromFormat('D M d Y h:i:s', $rest)->format('Y-m-d H:i:s');
                $datacorrentista['fecha_nacimiento']=$ymd;
            }
        if($datacorrentista['fecha_vacaciones_inicio']!=null && $datacorrentista['fecha_vacaciones_inicio']!='Invalid Date'){
            $fecha=$datacorrentista['fecha_vacaciones_inicio'];

            $rest = substr($fecha, 0,24);

            $ymd = \DateTime::createFromFormat('D M d Y h:i:s', $rest)->format('Y-m-d H:i:s');
            $datacorrentista['fecha_vacaciones_inicio']=$ymd;
        }

        if($datacorrentista['fecha_vacaciones_fin']!=null && $datacorrentista['fecha_vacaciones_fin']!='Invalid Date'){
            $fecha=$datacorrentista['fecha_vacaciones_fin'];

            $rest = substr($fecha, 0,24);

            $ymd = \DateTime::createFromFormat('D M d Y h:i:s', $rest)->format('Y-m-d H:i:s');
            $datacorrentista['fecha_vacaciones_fin']=$ymd;
        }
        if($datacorrentista['fecha_contratacion']!=null && $datacorrentista['fecha_contratacion']!='Invalid Date'){
            $fecha=$datacorrentista['fecha_contratacion'];

            $rest = substr($fecha, 0,24);

            $ymd = \DateTime::createFromFormat('D M d Y h:i:s', $rest)->format('Y-m-d H:i:s');
            $datacorrentista['fecha_contratacion']=$ymd;
        }
        if($datacorrentista['fecha_cese']!=null && $datacorrentista['fecha_cese']!='Invalid Date'){
            $fecha=$datacorrentista['fecha_cese'];

            $rest = substr($fecha, 0,24);

            $ymd = \DateTime::createFromFormat('D M d Y h:i:s', $rest)->format('Y-m-d H:i:s');
            $datacorrentista['fecha_cese']=$ymd;
        }
            if($datacorrentista['tipdoc_id_tipdoc']==0){
                $datacorrentista['tipdoc_id_tipdoc']=null;
            }




            if($request->get('id_corren',0)==0){
                $correntista=new Correntista();
                $datacorrentista['creado_por']=Auth::user()->name;
            }else{
                $correntista=Correntista::find($request->get('id_corren'));
                $m=0;
                $datacorrentista['modificado_por']=Auth::user()->name;
            }
            $validate=$correntista->isValidEmpleado($datacorrentista);
            if($validate->passes()){
                if ($request->hasFile('foto')) {
                    $correntista->foto = $request->file('foto')->storeAs('public/fotos', uniqid() . '.' . $request->file('foto')->extension());
                }
                if ($request->hasFile('doc_curriculum')) {
                    $correntista->doc_curriculum = $request->file('doc_curriculum')->storeAs('public/curriculums', uniqid() . '.' . $request->file('doc_curriculum')->extension());
                }
                if ($request->hasFile('doc_contrato')) {
                    $correntista->doc_contrato = $request->file('doc_contrato')->storeAs('public/contratos', uniqid() . '.' . $request->file('doc_contrato')->extension());
                }
                $correntista->fill($datacorrentista);
                if($correntista->extranjero){
                    $correntista->ubigeo_id_ubigeo=null;
                }
                $correntista->save();
                if($m){
                    $maestro_correntista=new Maestro_correntista();


                    $maestro_correntista->corren_id_corren=$correntista->id_corren;
                    $correntista_tipo=Correntista_tipo::where('descripcion','EMPLEADO')->first();
                    $maestro_correntista->tipcor_id_tipcor=$correntista_tipo->id_tipcor;
                    $count_corren=Maestro_correntista::where('tipcor_id_tipcor',$correntista_tipo->id_tipcor)->count();
                    $count_corren++;
                    $maestro_correntista->codigo='EMP'.$count_corren;
                    $maestro_correntista->save();
                }
                if($request->get('id_corren',0)==0){
                    $correntista_principal=new Correntista_dato();
                }else{
                    $correntista_principal=Correntista_dato::where('corren_id_corren',$request->get('id_corren'))->first();
                    $datacorrentista['id_corr_datos']=$correntista_principal->id_corr_datos;

                }
                $correntista_principal->fill($datacorrentista);
                $correntista_principal->principal=true;
                $correntista_principal->corren_id_corren=$correntista->id_corren;
                $correntista_principal->save();
            }
            else{
                $r->error=$validate->errors();
                $r->status->setStatus(Status::ERROR_PARAMS);
            }
            $r->data= $correntista;
       /* } catch (\Exception $e) {
            $r->status->setStatus(Status::ERROR_PROCESS);
            $r->status->details = "Error al procesar la información";
        }*/
        return response()->json($r);
    }
    //PROVEEDORES
    public function obtenerProveedores(Request $request){
        $r =new ApiResponse();

        $correntistas= DB::table('correntistas')
            ->join('correntista_datos', 'correntistas.id_corren', '=', 'correntista_datos.corren_id_corren')
            ->join('maestro_correntista', 'correntistas.id_corren', '=', 'maestro_correntista.corren_id_corren')

            ->select('correntistas.id_corren','correntista_datos.telefono','correntistas.nombres','correntistas.apellidos','correntistas.direccion','correntistas.estado','maestro_correntista.codigo','correntistas.num_doc')
            ->where('correntista_datos.principal',1)
            ->where('maestro_correntista.tipcor_id_tipcor',2)
            ->get();

        $r->data= $correntistas;
        return response()->json($r);
    }
    public function obtenerProveedor(Request $request){
        $r =new ApiResponse();

        $id=$request->get('id_corren');

        $correntistas=Correntista::find($id)->load('proveedor','contactoPrincipal');
        if($correntistas->ubigeo_id_ubigeo!=null){
            $distrito=Ubigeo::find($correntistas->ubigeo_id_ubigeo);
            $correntistas->distrito=$distrito->id_ubigeo;
            $provincia=Ubigeo::find($distrito->ubigeo_id_ubigeo);
            $correntistas->provincia=$provincia->id_ubigeo;
            $departamento=Ubigeo::find($provincia->ubigeo_id_ubigeo);
            $correntistas->departamento=$departamento->id_ubigeo;
            $pais=Ubigeo::find($departamento->ubigeo_id_ubigeo);
            $correntistas->pais=$pais->id_ubigeo;
        }else{
            $correntistas->distrito='';
            $correntistas->provincia='';
            $correntistas->departamento='';
            $correntistas->pais='';
        }
        $r->data=$correntistas;
        return response()->json($r);
    }
    public function proveedorInsertar(Request $request){
        $r =new ApiResponse();

        try{
            $datacorrentista =$request->all();
            if($datacorrentista['fecha_nacimiento']!=null && $datacorrentista['fecha_nacimiento']!='Invalid Date'){
                $fecha=$datacorrentista['fecha_nacimiento'];

                $rest = substr($fecha, 0,24);

                $ymd = \DateTime::createFromFormat('D M d Y h:i:s', $rest)->format('Y-m-d H:i:s');
                $datacorrentista['fecha_nacimiento']=$ymd;
            }
            if($datacorrentista['tipdoc_id_tipdoc']==0){
                $datacorrentista['tipdoc_id_tipdoc']=null;
            }



            $m=1;
            if($request->get('id_corren',0)==0){
                $correntista=new Correntista();
                $datacorrentista['creado_por']=Auth::user()->name;
            }else{
                $correntista=Correntista::find($request->get('id_corren'));
                $m=0;
                $datacorrentista['modificado_por']=Auth::user()->name;
            }
            $validate=$correntista->isValidProveedor($datacorrentista);
            if($validate->passes()){
                if ($request->hasFile('foto')) {
                    $correntista->foto = $request->file('foto')->storeAs('public/fotos', uniqid() . '.' . $request->file('foto')->extension());
                }

                $correntista->fill($datacorrentista);
                if($correntista->extranjero){
                    $correntista->ubigeo_id_ubigeo=null;
                }
                $correntista->save();
                if($m){
                    $maestro_correntista=new Maestro_correntista();


                    $maestro_correntista->corren_id_corren=$correntista->id_corren;
                    $correntista_tipo=Correntista_tipo::where('descripcion','PROVEEDOR')->first();
                    $maestro_correntista->tipcor_id_tipcor=$correntista_tipo->id_tipcor;
                    $count_corren=Maestro_correntista::where('tipcor_id_tipcor',$correntista_tipo->id_tipcor)->count();
                    $count_corren++;
                    $maestro_correntista->codigo='PRO'.$count_corren;
                    $maestro_correntista->save();
                }
                if($request->get('id_corren',0)==0){
                    $correntista_principal=new Correntista_dato();
                }else{
                    $correntista_principal=Correntista_dato::where('corren_id_corren',$request->get('id_corren'))->first();
                    $datacorrentista['id_corr_datos']=$correntista_principal->id_corr_datos;

                }
                $correntista_principal->fill($datacorrentista);
                $correntista_principal->principal=true;
                $correntista_principal->corren_id_corren=$correntista->id_corren;
                $correntista_principal->save();
            }
            else{
                $r->error=$validate->errors();
                $r->status->setStatus(Status::ERROR_PARAMS);
            }
            $r->data= $correntista;
        } catch (\Exception $e) {
            $r->status->setStatus(Status::ERROR_PROCESS);
            $r->status->details = "Error al procesar la información";
        }
        return response()->json($r);
    }
    /*vistas */
    public function viewClientes(){
        return view("maestros.clientes");
    }

      public function viewAlmacenes(){
        return view("maestros.almacenes");
    }

    public function viewEmpleados(){
        return view("maestros.empleados");
    }
    public function viewProveedores(){
        return view("maestros.proveedores");
    }
    public function correntistaEliminar(Request $request)
    {
        $r = new ApiResponse();

        if ($request->get('id_corren', 0) != 0) {
            $id=$request->get('id_corren');
            $correntista = Correntista::find($id);

            if($correntista->estado==1){
                $correntista->estado=0;

            }else{
                $correntista->estado=1;
            }
            $correntista->save();
        } else {
            $r->status->setStatus(Status::ERROR_PARAMS);
        }
        return response()->json($r);
    }
}
