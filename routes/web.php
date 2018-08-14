<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index');
Route::get('logout',[
    'uses' => 'Auth\LoginController@logout',
    'as'   => 'logout'
]);

Auth::routes();
//ventas
Route::get('/ventas', 'HomeController@viewVentas');
//roles
Route::get('/roles', 'HomeController@viewRoles');
//usuarios
Route::get('/usuarios', 'HomeController@viewUsuarios');
//tiendas
Route::get('/tiendas', 'HomeController@viewTiendas');
//marcas
Route::get('/marcas', 'HomeController@viewMarcas');
//familias
Route::get('/familias', 'HomeController@viewFamilias');
//productos
Route::get('/productos', 'HomeController@viewProductos');
//importaciones
Route::get('/importaciones', 'HomeController@viewImportaciones');
//exportaciones
Route::get('/exportaciones', 'HomeController@viewExportaciones');
//correntista
Route::get('/clientes', 'CorrentistaController@viewClientes');
Route::get('/distribuidores', 'CorrentistaController@viewDistribuidores');
Route::get('/empleados', 'CorrentistaController@viewEmpleados');
Route::get('/proveedores', 'CorrentistaController@viewProveedores');
Route::get('/almacenes', 'CorrentistaController@viewAlmacenes');
Route::get('/correntista', 'CorrentistaController@index');
Route::any('/select-data', 'CorrentistaController@selectData');



//Inventario
Route::get('/precios', 'HomeController@viewPrecios');


//ubigeo
Route::post('/distrito', 'UbigeoController@distrito');
Route::post('/provincia', 'UbigeoController@provincia');
Route::post('/departamento', 'UbigeoController@departamento');
Route::post('/paises', 'UbigeoController@paises');
//cliente
Route::any('/obtener-clientes', 'CorrentistaController@obtenerClientes');
Route::any('/obtener-cliente', 'CorrentistaController@obtenerCliente');
Route::post('/guardar-cliente', 'CorrentistaController@clienteInsertar');
//empleado
Route::any('/obtener-empleados', 'CorrentistaController@obtenerEmpleados');
Route::any('/obtener-empleado', 'CorrentistaController@obtenerEmpleado');
Route::post('/guardar-empleado', 'CorrentistaController@empleadoInsertar');
//proveedor
Route::any('/obtener-proveedores', 'CorrentistaController@obtenerProveedores');
Route::any('/obtener-proveedor', 'CorrentistaController@obtenerProveedor');
Route::post('/guardar-proveedor', 'CorrentistaController@proveedorInsertar');

//todocorrentista
Route::post('/eliminar-correntista', 'CorrentistaController@correntistaEliminar');

//contacto
Route::any('/obtener-contactos', 'CorrentistaPerfilController@obtenerContactos');
Route::post('/guardar-contacto', 'CorrentistaPerfilController@contactoInsertar');
Route::post('/eliminar-contacto', 'CorrentistaPerfilController@contactoEliminar');
//banco
Route::post('/obtener-bancos', 'CorrentistaCuentaController@obtenerBancos');
//cuentas
Route::post('/obtener-cuentas', 'CorrentistaCuentaController@obtenerCuentas');
Route::post('/guardar-cuenta', 'CorrentistaCuentaController@cuentaInsertar');
Route::post('/eliminar-cuenta', 'CorrentistaCuentaController@cuentaEliminar');

//marca
Route::any('/obtener-marcas', 'MarcaController@obtenerMarcas');
Route::post('/guardar-marca', 'MarcaController@marcaInsertar');
Route::post('/eliminar-marca', 'MarcaController@marcaEliminar');
//familias
Route::any('/obtener-familias-padre', 'FamiliaController@obtenerFamiliasPadre');
Route::any('/obtener-familias', 'FamiliaController@obtenerFamilias');
Route::post('/guardar-familia', 'FamiliaController@familiaInsertar');
Route::post('/eliminar-familia', 'FamiliaController@familiaEliminar');
//productos
Route::any('/obtener-productos', 'ProductoController@obtenerProductos');
Route::post('/guardar-producto', 'ProductoController@productoInsertar');
Route::post('/eliminar-producto', 'ProductoController@productoEliminar');
Route::any('/select-data-productos', 'ProductoController@selectDataProductos');

Route::any('/obtener-marcas-productos', 'ProductoController@obtenerMarcasProductos');
Route::post('/guardar-marca-producto', 'ProductoController@marcaProductoInsertar');
Route::post('/eliminar-marca-producto', 'ProductoController@marcaProductoEliminar');

Route::any('/obtener-familias-productos', 'ProductoController@obtenerFamiliasProductos');
Route::post('/guardar-familia-producto', 'ProductoController@familiaProductoInsertar');
Route::post('/eliminar-familia-producto', 'ProductoController@familiaProductoEliminar');

Route::any('/obtener-productos-presentaciones', 'ProductoController@obtenerProductosPresentaciones');
Route::post('/guardar-producto-presentacion', 'ProductoController@productoPresentacionInsertar');
Route::post('/eliminar-producto-presentacion', 'ProductoController@productoPresentacionEliminar');

Route::any('/obtener-productos-unidades-medida', 'ProductoController@obtenerProductosUnidadesMedida');
Route::post('/guardar-producto-unidad-medida', 'ProductoController@productoUnidadMedidaInsertar');
Route::post('/eliminar-producto-unidad-medida', 'ProductoController@productoUnidadMedidaEliminar');


//Precios
Route::any('/obtener-productos-filtrados-familia', 'ProductoController@obtenerProductosFiltradosPorFamilia');
Route::post('/actualizar-productos-masivo', 'ProductoController@actualizarProductosMasivo');




//multimedia
Route::post('/guardar-foto-principal', 'ProductoController@guardaFotoPrincipal');





//almacenes
Route::any('/obtener-almacenes', 'AlmacenController@obtenerAlmacenes');
Route::any('/obtener-almacenes-padre', 'AlmacenController@obtenerAlmacenesPadre');
Route::post('/guardar-almacen', 'AlmacenController@almacenInsertar');
Route::post('/eliminar-almacen', 'AlmacenController@almacenEliminar');

//tiendas
Route::any('/obtener-tiendas', 'TiendaController@obtenerTiendas');
Route::post('/guardar-tienda', 'TiendaController@tiendaInsertar');
Route::post('/eliminar-tienda', 'TiendaController@tiendaEliminar');

//roles
Route::any('/obtener-roles', 'RolController@obtenerRoles');
Route::post('/guardar-rol', 'RolController@rolInsertar');
Route::post('/eliminar-rol', 'RolController@rolEliminar');

//usuarios
Route::any('/obtener-usuarios', 'UsuarioController@obtenerUsuarios');
Route::post('/guardar-usuario', 'UsuarioController@usuarioInsertar');
Route::post('/eliminar-usuario', 'UsuarioController@usuarioEliminar');

//estantes
Route::any('/obtener-estantes', 'EstanteController@obtenerEstantes');
Route::post('/guardar-estante', 'EstanteController@estanteInsertar');
Route::post('/eliminar-estante','EstanteController@estanteEliminar');
Route::any('/obtener-todo-estantes', 'EstanteController@obtenerTodoEstantes');

//estantes
Route::any('/obtener-casilleros', 'CasilleroController@obtenerCasilleros');

//Excel
Route::any('/descargar-excel', 'ProductoController@descargarExcel');
Route::any('/subir-excel', 'ProductoController@subirExcel');

//Ventas
Route::any('/process-documentos', 'ProcessController@Process');