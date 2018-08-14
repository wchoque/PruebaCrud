<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

        '/obtener-cliente',
        '/obtener-proveedor',
        '/obtener-empleado',
        '/obtener-contactos',
        '/guardar-contacto',
        '/departamento',
        '/provincia',
        '/distrito',
        '/paises',
        '/guardar-cliente',
        '/guardar-empleado',
        '/guardar-proveedor',
        '/obtener-bancos',
        '/obtener-cuentas',
        '/guardar-cuenta',
        '/obtener-marcas',
        '/guardar-marca',
        '/obtener-familias',
        '/obtener-familias-padre',
        '/guardar-familia',
        '/select-data',
        '/guardar-excel',
        '/subir-excel',
        '/descargar-excel',
        '/obtener-almacenes',
        '/guardar-almacen',
        '/eliminar-almacen',
        '/eliminar-contacto',
        '/eliminar-correntista',
        '/eliminar-cuenta',
        '/eliminar-marca',		
        '/eliminar-familia',
        '/obtener-almacenes-padre',
        '/obtener-tiendas',
        '/guardar-tienda',
        '/eliminar-tienda',
		'/obtener-roles',
		'/guardar-rol',
		'/eliminar-rol',
		'/obtener-usuarios',
		'/guardar-usuario',
		'/eliminar-usuario',
        '/obtener-estantes',
        '/guardar-estante',
        '/eliminar-estante',
        '/obtener-productos',
        '/guardar-producto',
        '/eliminar-producto',
        '/obtener-marcas-productos',
        '/guardar-marca-producto',
        '/eliminar-marca-producto',
        '/obtener-familias-productos',
        '/guardar-familia-producto',
        '/eliminar-familia-producto',
        '/obtener-productos-presentaciones',
        '/guardar-producto-presentacion',
        '/eliminar-producto-presentacion',
        '/obtener-productos-unidades-medida',
        '/guardar-producto-unidad-medida',
        '/eliminar-producto-unidad-medida',
        '/guardar-foto-principal',
        '/obtener-productos-filtrados-familia',
        '/actualizar-productos-masivo',
		'/process-documentos'
    ];
}
