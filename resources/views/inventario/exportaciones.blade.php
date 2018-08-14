@extends('layouts.app') @section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Importaciones</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Inicio</a>
                </li>
                <li>
                    <a>Inventario</a>
                </li>
                <li class="active">
                    <strong>Importaciones</strong>
                </li>
            </ol>
        </div>
    </div>
    <div id="exportaciones">
        {{-- Listado --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Listado de Familias</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm">
                                        <i class="fa fa-refresh"></i> Refrescar</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group">
                                        <input type="text" placeholder="Buscar" class="input-sm form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Buscar</button>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="project-list">

                                <table class="table table-hover">
                                    <thead>
                                    <td class="project-title">
                                        <strong>Imagen</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Modelo oculto</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Modelo</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Descripcion</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Marca</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Pais</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>QTY</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Unit</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>U/Price</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>T/price</strong>
                                    </td>
                                    <td class="project-actions">
                                    </td>
                                    </thead>
                                    <tbody>
                                    <tr v-for="p in productos">


                                        <td>
                                            {{-- @{{p.foto}} --}}
                                            {{-- @{{p.imagen}} --}}
                                           <img src="storage/@{{p.foto}}" alt="image" class="img-responsive"> 
                                        </td>
                                        <td class="project-title">
                                            @{{p.modelo_oculto}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.modelo}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.descripcion}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.marca}}
                                        </td>
                                        <td class="project-title">
                                            <select  name="pais" class="form-control" v-model="p.pais">
                                                <option v-for="p in paises" value="@{{ p.nombre }}">@{{ p.nombre }}</option>
                                            </select>
                                        </td>
                                        <td class="project-title">
                                            <input  type="text" class="form-control" value="1" v-model="p.qty" />
                                        </td>
                                        <td class="project-title">
                                            <select class="form-control " v-model="p.unidad" >
                                                <option value="pcs">pcs</option>
                                                <option value="pcs">...</option>
                                            </select>
                                        </td>
                                        <td class="project-title">
                                            @{{p.preciou = p.precio}}
                                            {{-- @{{p.precio}} --}}
                                        </td>
                                        <td class="project-title">
                                            {{-- @{{p.preciot}} --}}
                                            @{{p.preciot = p.preciou * p.qty}}
                                        </td>
                                        <td class="project-title">
                                            <input type="checkbox"  v-model="p.checked">
                                        </td>


                                        <td class="project-actions">


                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Listado de Familias</h5>
                        </div>
                        <div class="ibox-content">

                            <div class="project-list">

                                <table class="table table-hover">
                                    <thead>
                                    <td class="project-title">
                                        <strong>Imagen</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Modelo oculto</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Modelo</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Descripcion</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Marca</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Pais</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>QTY</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Unit</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>U/Price</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>T/price</strong>
                                    </td>
                                    <td class="project-actions">
                                    </td>
                                    </thead>
                                    <tbody>
                                    <tr v-for="p in productos" v-if="p.checked">


                                        <td>
                                            @{{p.imagen}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.modelo_oculto}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.modelo}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.descripcion}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.marca}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.pais}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.qty}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.unidad}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.preciou}}
                                        </td>
                                        <td class="project-title">
                                            @{{p.preciot=p.preciou*p.qty}}
                                        </td>
                                        <td class="project-title">
                                            <input type="checkbox"  v-model="p.checked">
                                        </td>


                                        <td class="project-actions">


                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-9 col-md-3">
                                <span class="btn btn-md btn-primary" v-on:click="descargarExcel()">Excel</span>
                            </div>
                        </div>
                      {{--   <div class="form-group">
                            <a href="@{{descarga}}" download>descargar</a>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>

    </div>



@endsection
<script src="{{ asset('js/app/hifi_exportaciones_app.js') }}"></script>