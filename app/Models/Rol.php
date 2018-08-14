<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected  $hidden = ['updated_at'];
    protected $primaryKey = 'id';
    protected $fillable = [  'nombre',       
        'descripcion',
		'creado_por',
        'modificado_por',
    ];

    public function isValid($input){
        $rules = array(

            'nombre' => 'required',
            'descripcion' => 'required'

        );
        // make a new validator object
        $v = Validator::make($input, $rules);

        return  $v;
    }
    public function usuarios(){
        return $this->belongsToMany('\App\Models\Usuario','role_user','role_id','user_id');
    }
}
