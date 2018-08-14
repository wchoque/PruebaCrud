<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Correntista extends Model
{
    use SoftDeletes;
    protected $table = 'correntistas';
    protected  $hidden = ['updated_at'];
    protected $primaryKey = 'id_corren';
    protected $fillable = [  'num_doc',
        'apellidos',
        'nombres',
        'razon_social',
        'nombre_comercial',
        'correntista_cargo',
        'codigo_qr',
        'estado' ,
        'direccion',
        'extranjero',
        'nombre_conviviente' ,
        'genero' ,
        'estado_civil',
        'fecha_nacimiento' ,
        'numero_hijos',
        'notas',
        'cargo',
        'fecha_contratacion' ,
        'fecha_cese' ,

        'fecha_vacaciones_inicio',
        'fecha_vacaciones_fin',
        'sueldo',
        'contacto_emergencia',
        'numero_seguro',
        'doc_curriculum' ,
        'doc_contrato',
        'nivel_organizacion',
        'creado_por',
        'modificado_por',
        'distribuidor',

        'ubigeo_id_ubigeo',
        'tipdoc_id_tipdoc'];

    public function contactos()
    {
        return $this->hasMany('App\Models\Correntista_dato','corren_id_corren')->where('principal',0);
    }
    public function contactoPrincipal()
    {
        return $this->hasMany('App\Models\Correntista_dato','corren_id_corren')->where('principal',1);
    }


    public function cliente()
    {
        return $this->hasMany('App\Models\Maestro_correntista','corren_id_corren')->where('tipcor_id_tipcor',1);
    }
    public function proveedor()
    {
        return $this->hasMany('App\Models\Maestro_correntista','corren_id_corren')->where('tipcor_id_tipcor',2);
    }
    public function empleado()
    {
        return $this->hasMany('App\Models\Maestro_correntista','corren_id_corren')->where('tipcor_id_tipcor',3);
    }
    //Mutators
    function getFotoAttribute($value){
        if(!$value) $value = 'default_avatar.jpg';
        return asset(\Storage::url($value));
    }
    function getFechaVacacionesInicioAttribute($value){
        if(!$value) $value = 'default_avatar.jpg';
        return asset(\Storage::url($value));
    }
    function getFechaVacacionesFinAttribute($value){
        if(!$value) $value = 'default_avatar.jpg';
        return asset(\Storage::url($value));
    }
    //validacion
    function isValidCliente($input)
{
    if($input['id_corren']>0){
        $datos = Correntista_dato::where('corren_id_corren',$input['id_corren'])->where('principal',1)->first();

        $validacion='required|unique:correntista_datos,email,'.$datos->id_cordat.',id_cordat';
    }else{
        $validacion='required|unique:correntista_datos,email';
    }
    $rules = array(

        'email' => $validacion,
        'telefono' => 'required|numeric',
        'movil' => 'required|numeric',
        'tipdoc_id_tipdoc'=>'required',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required',
        'estado_civil' => 'required',
        'num_doc' => 'required|numeric',
        //'razon_social' => 'required',
        'estado' => 'required',
        'extranjero' => 'required',
        'direccion' => 'required',
        'apellidos' => 'required',
        'nombres' => 'required',
        //'nombre_comercial' => 'required',
        'notas' => 'required',
        /*'nombre_conviviente' => '',

        'correntista_cargo' => '',
        'codigo_qr' => '',

        'fecha_nacimiento' => '',
        'numero_hijos' => '',
        'foto' => '',
        'nivel_organizacion' => '',
       ,*/
        //  'cargo' => 'required',
        //'fecha_contratacion' => 'required',
        //'fecha_cese' => 'required',
        //'fecha_vacaciones_inicio' => 'required',
        //'fecha_vacaciones_fin' => 'required',
        //  'sueldo' => 'required',
        //  'contacto_emergencia' => 'required',
        // 'numero_seguro' => 'required',
        // 'doc_curriculum' => 'required',
        //'doc_contrato' => 'required',
    );
    // make a new validator object
    $v = Validator::make($input, $rules);

    return  $v;
}
    function isValidProveedor($input)
    {
        if($input['id_corren']>0){
            $datos = Correntista_dato::where('corren_id_corren',$input['id_corren'])->where('principal',1)->first();

            $validacion='required|unique:correntista_datos,email,'.$datos->id_cordat.',id_cordat';
        }else{
            $validacion='required|unique:correntista_datos,email';
        }
        $rules = array(

            'email' => $validacion,
            'telefono' => 'required|numeric',
            'movil' => 'required|numeric',
            'tipdoc_id_tipdoc'=>'required',
            //'fecha_nacimiento' => 'required|date',
           // 'genero' => 'required',
          //  'estado_civil' => 'required',
            'num_doc' => 'required|numeric',
            //'razon_social' => 'required',
            'estado' => 'required',
            'extranjero' => 'required',
            'direccion' => 'required',
            'apellidos' => 'required',
            'nombres' => 'required',
            //'nombre_comercial' => 'required',
            'notas' => 'required',
            /*'nombre_conviviente' => '',

            'correntista_cargo' => '',
            'codigo_qr' => '',

            'fecha_nacimiento' => '',
            'numero_hijos' => '',
            'foto' => '',
            'nivel_organizacion' => '',
           ,*/
            //  'cargo' => 'required',
            //'fecha_contratacion' => 'required',
            //'fecha_cese' => 'required',
            //'fecha_vacaciones_inicio' => 'required',
            //'fecha_vacaciones_fin' => 'required',
            //  'sueldo' => 'required',
            //  'contacto_emergencia' => 'required',
            // 'numero_seguro' => 'required',
            // 'doc_curriculum' => 'required',
            //'doc_contrato' => 'required',
        );
        // make a new validator object
        $v = Validator::make($input, $rules);

        return  $v;
    }
    function isValidEmpleado($input)
    {
        if($input['id_corren']>0){
            $datos = Correntista_dato::where('corren_id_corren',$input['id_corren'])->where('principal',1)->first();

            $validacion='required|unique:correntista_datos,email,'.$datos->id_cordat.',id_cordat';
        }else{
            $validacion='required|unique:correntista_datos,email';
        }
        $rules = array(

            'email' => $validacion,
            'telefono' => 'required|numeric',
            'movil' => 'required|numeric',
            'tipdoc_id_tipdoc'=>'required',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required',
            'estado_civil' => 'required',
            'num_doc' => 'required|numeric',
            //'razon_social' => 'required',
            'estado' => 'required',
            'extranjero' => 'required',
            'direccion' => 'required',
            'apellidos' => 'required',
            'nombres' => 'required',
            //'nombre_comercial' => 'required',
            'notas' => 'required',
            'nombre_conviviente' => '',
            /*'nombre_conviviente' => '',

            'correntista_cargo' => '',
            'codigo_qr' => '',


            'foto' => '',
            'nivel_organizacion' => '',
           ,*/

            'numero_hijos' => 'required',
            'cargo' => 'required',
            'fecha_contratacion' => 'required',
            'fecha_cese' => 'required',
            'fecha_vacaciones_inicio' => 'required',
            'fecha_vacaciones_fin' => 'required',
            'sueldo' => 'required',
            'contacto_emergencia' => 'required',
            'numero_seguro' => 'required',
            //'doc_curriculum' => 'required',
            //'doc_contrato' => 'required',
        );
        // make a new validator object
        $v = Validator::make($input, $rules);

        return  $v;
    }

    public function multimedia()
    {
        return $this->morphOne(Multimediable::class, 'multimediable');
    }
}
