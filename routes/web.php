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
//usuarios
Route::get('/usuarios', 'HomeController@viewUsuarios');

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


//todocorrentista
Route::post('/eliminar-correntista', 'CorrentistaController@correntistaEliminar');

//contacto
Route::any('/obtener-contactos', 'CorrentistaPerfilController@obtenerContactos');
Route::post('/guardar-contacto', 'CorrentistaPerfilController@contactoInsertar');
Route::post('/eliminar-contacto', 'CorrentistaPerfilController@contactoEliminar');





