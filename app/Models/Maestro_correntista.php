<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maestro_correntista extends Model
{
    protected $table = 'maestro_correntista';
    protected $primaryKey = 'id_maecor';
    public function tiendas(){
        return $this->belongsToMany('\App\Models\Tienda','tiendas_empleados','maecor_id_maecor','tienda_id_tienda')
            ->withPivot('modificado_por','creado_por');
    }
}
