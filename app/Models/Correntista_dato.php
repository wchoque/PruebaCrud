<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use \Validator;
class Correntista_dato extends Model
{
    use SoftDeletes;
   protected $table = 'correntista_datos';
    protected $primaryKey = 'id_cordat';
   protected $fillable =array( 'ubicacion','email','pref_pais','pref_ciudad','telefono' ,'pagina_web','movil','corren_id_corren','contacto','creado_por','modificado_por');
    function isValid($input)
    {
        if(array_key_exists('id_corr_datos',$input)){
            $datos = Correntista_dato::find($input['id_corr_datos']);
            $validacion='required|unique:correntista_datos,email,'.$datos->id_cordat.',id_cordat';
        }else{
            $validacion='required|unique:correntista_datos,email';
        }

        $rules = array(
            'email' => $validacion,
            //'pref_pais' => 'required',
           // 'pref_ciudad' => 'required',
            'telefono' => 'required',
            'pagina_web' => 'required',
            'movil' => 'required',
        );
        $v = Validator::make($input, $rules);
        // return the result
        return  $v;
    }
}
