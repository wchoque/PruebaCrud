<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use \Validator;
class Correntista_cuenta extends Model
{
    use SoftDeletes;
    protected $table = 'correntista_cuentas';
    protected $primaryKey = 'id_corcue';
    protected $fillable =array('titular','num_cuenta','tipo_moneda','num_cuenta_interbancario','entban_id_entban','corren_id_corren','creado_por','modificado_por','banco');
    function isValid($input)
    {

        $rules = array(

            'titular' => 'required',
            'num_cuenta' => 'required',
            'tipo_moneda' => 'required',
            'banco' => 'required',
            'num_cuenta_interbancario' => 'required'
        );
        $v = Validator::make($input, $rules);
        // return the result
        return  $v;
    }
}
