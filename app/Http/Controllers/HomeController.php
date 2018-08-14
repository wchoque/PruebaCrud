<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
    public function viewMarcas()
    {
        return view('inventario.marcas');
    }
    public function viewTiendas()
    {
        return view('maestros.tiendas');
    }
    public function viewFamilias()
    {
        return view('inventario.familias');
    }
    public function viewProductos()
    {
        return view('inventario.productos');
    }
	public function viewUsuarios()
    {
        return view('usuarios.usuarios');
    }
    public function viewImportaciones()
    {
        return view('inventario.importaciones');
    }
    public function viewExportaciones()
    {
        return view('inventario.exportaciones');
    }
	public function viewRoles()
    {
        return view('usuarios.roles');
    }
    public function viewPrecios()
    {
        return view('inventario.precios');
    }
	public function viewVentas()
    {
        return view('ventas.ventas');
    }
}
