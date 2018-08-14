<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
class Usuario extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected  $hidden = ['password'];
    protected $fillable = [
         'corren_id_corren', 
		 'name', 
		 'creado_por',
		 'modificado_por',
		 'email',
		 'password',
     ];
    public function isValid($input){
        $rules = array(
            'name' => 'required',
			'email' => 'required',
			'password' => 'required'

        );
        // make a new validator object
        $v = Validator::make($input, $rules);

        return  $v;
    }
    public function roles(){
        return $this->belongsToMany('\App\Models\Rol','role_user','user_id','role_id');
    }
}
