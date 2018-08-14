@extends('layouts.app') @section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Productos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Inicio</a>
            </li>
            <li>
                <a>Inventario</a>
            </li>
            <li class="active">
                <strong>Productos</strong>
            </li>
        </ol>
    </div>
</div>
<div id="productos">
    {{-- Listado --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Listado de Productos</h5>
                        <div class="ibox-tools">
                            <a href="#" class="btn btn-primary btn-xs"  v-on:click="nuevoProducto()">Crear un nuevo producto</a>
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
                                        <strong>Estado</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Nombre</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Codigo</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Descripción</strong>
                                    </td>
                                    <td class="project-title">
                                        <strong>Precio</strong>
                                    </td>

                                    <td class="project-actions">
                                    </td>
                                    </thead>
                                    <tbody>
                                        <tr v-for="p in productos">
                                            <td class="project-status">
                                                <span class="label label-primary" v-if="p.estado">Activo</span>
                                                <span class="label label-default" v-else>Inactivo</span>
                                            </td>
                                            <td class="project-title">
                                                <a href="project_detail.html">@{{ p.nombre }} </a>
                                            </td>
                                            <td>
                                                @{{ p.codigo_hifi }}
                                            </td>
                                            <td>
                                                @{{ p.descripcion }}
                                            </td>
                                            <td>
                                                @{{ p.precio }}
                                            </td>
                                            <td class="project-actions">
                                                <span class="btn btn-warning btn-sm" title="Editar" v-on:click="obtenerProducto(p)">
                                                    <i class="fa fa-pencil"></i>
                                                </span>
                                                <span class="btn btn-danger btn-sm" title="Eliminar" v-on:click="eliminarProducto(p.id_produc)">
                                                    <i class="fa fa-times"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      {{-- Detalles --}}
    <div class="row" id="NuevoProducto">
        <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Perfil</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img :src="image" alt="image" class="img-responsive">
                                {{-- <img width="150px" :src="image"> --}}
                            </div>
                            <div class="ibox-content profile-content">
                                <h4>
                                    <strong>@{{ producto.nombre }}</strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tab-principal">Principal</a>
                                    </li>
                                     <li class="">
                                        <a  data-toggle="tab" href="#tab-marca" >Marca</a>
                                    </li>
                                     <li class="">
                                        <a  data-toggle="tab" href="#tab-familia-subfamilia" >Familia/Subfamilia</a>
                                    </li>

                                     <li class="">
                                        <a  data-toggle="tab" href="#tab-fotos" >Fotos</a>
                                    </li>
                                     <li class="">
                                        <a  data-toggle="tab" href="#tab-costos" >Costos</a>
                                    </li>
                                    <li class="">
                                        <a  data-toggle="tab" href="#tab-precios" >Precios</a>
                                    </li>

                                     <li class="">
                                        <a  data-toggle="tab" href="#tab-presentaciones" >Presentaciones</a>
                                    </li>

                                     <li class="">
                                        <a  data-toggle="tab" href="#tab-unidades-medida" >Unidades de medida</a>
                                    </li>

                                      <li class="">
                                        <a  data-toggle="tab" href="#tab-Descripcion-Web" >Descripcion Web</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                </div>
                            </div>

                             <div class="ibox-content">
                                <div class="tab-content">
                                    <div id="tab-principal" class="tab-pane active">
                                            <div class="panel-body">
                                                <form  class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Codigo</label>
                                                        <div class="col-md-3">
                                                            <input readonly type="text" class="form-control" name="codigo_hifi" placeholder="Codigo_hifi" v-model="producto.codigo_hifi"/>
                                                        </div>

                                                         <label class="col-md-1 control-label">Costo Actual</label>
                                                        <div class="col-md-3">
                                                            <input readonly type="text" class="form-control" name="costo_actual" value="10" v-model="producto.costo" />
                                                        </div>

                                                         <label class="col-md-1 control-label">Precio Actual</label>
                                                        <div class="col-md-3">
                                                            <input readonly type="text" class="form-control" name="precio_actual" value="20" v-model="producto.precio"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Proveedor</label>
                                                        <div class="col-md-3">
                                                            <select class="form-control" {{-- v-model="producto.proveedor" --}} name='proveedor'>
                                                                <option v-for="p in proveedores" value="@{{ p.id_corren }}">@{{ p.razon_social }}</option>
                                                            </select>
                                                        </div>
                                              
                                                        <label class="col-md-1 control-label">Stock Minimo</label>
                                                        <div class="col-md-3">
                                                            <input type="number" class="form-control" value="10" name="stock_min" v-model="producto.stock_min"/>
                                                        </div>
                                                        <label class="col-md-1 control-label">Stock Maximo</label>
                                                        <div class="col-md-3">
                                                            <input type="number" class="form-control" value="20"  name="stock_max" v-model="producto.stock_max"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Nombre</label>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" placeholder="Nombre" name="nombre" v-model="producto.nombre"/>
                                                        </div>
                                                        <label class="col-md-1 control-label">Descripción</label>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" placeholder="Descripcion" name="descripcion"  v-model="producto.descripcion"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Estado</label>
                                                        <div class="col-md-3">
                                                            <select class="form-control" name="estado" v-model="producto.estado" >
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select>
                                                        </div>
                                                        <label class="col-md-1 control-label">Incoterm</label>
                                                        <div class="col-md-3">
                                                            {{-- <input type="text" class="form-control" placeholder="EXW" name="incoterm"  /> --}}
                                                            <select class="form-control" name="icoterms" v-model="producto.icoterms">
                                                                <option value="EXW">EXW</option>
                                                                <option value="FOB">FOB</option>
                                                            </select>
                                                        </div>
                                                        <label class="col-md-1 control-label">Afecto de IGV</label>
                                                        <div class="col-md-3">
                                                            <select class="form-control" name="igv" v-model="producto.igv">
                                                                <option  value="1">Si</option>
                                                                <option  value="0">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Tipo de Moneda</label>
                                                        <div class="col-md-3">
                                                                <select class="form-control" v-model="producto.divisa">
                                                                    <option v-for=" d in divisas" value="@{{ d.id_divisa }}">@{{ d.descripcion }}</option>
                                                                </select>
                                                        </div>
                                                         <label class="col-md-1 control-label">Multiplicador</label>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" placeholder="0.1" name="multiplicador" {{-- v-model="producto.multiplicador" --}} />
                                                        </div>
                                                         <div class=" col-md-3">
                                                            <span class="btn btn-md btn-info" v-on:click="ejecutarMultiplicador()">Ejecutar</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-offset-9 col-md-3">
                                                            <span class="btn btn-md btn-primary" v-on:click="guardarProducto()">Guardar</span>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div id="tab-marca" class="tab-pane">
                                            <div class="panel-body">
                                                <form  class="form-horizontal" >
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Marcas</label>
                                                        <div class="col-md-3">
                                                            <select class="form-control" v-model="marca.id_marcas">
                                                                <option v-for="m in marcas" value="@{{ m.id_marcas }}">@{{ m.nombre }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span class="btn btn-md btn-primary" v-on:click="guardarMarcaProducto()">Agregar</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="full-height-scroll">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <td class="project-title">
                                                                            <strong>Marca</strong>
                                                                        </td>
                                                                        
                                                                        <td>Acciones</td>
                                                                    </tr>

                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="mp in marcas_productos">
                                                                        <td>@{{ mp.id_marpro }}</td>
                                                                        <td>
                                                                            <span class="btn btn-xs glyphicon glyphicon-trash" title="Eliminar" v-on:click="eliminarMarcaProducto(mp.id_marpro)">
                                                                                 Eliminar
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                         <div id="tab-familia-subfamilia" class="tab-pane">
                                            <div class="panel-body">

                                                <form  class="form-horizontal" >
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Familia</label>
                                                       {{--   <div class="col-md-3">
                                                            <select class="form-control " v-model="familia.famili_id_famili" >
                                                                <option v-for="f in familias" v-if="f.id_famili!=familia.id_famili" value="@{{ f.id_famili }}">@{{  f.nombre }}</option>
                                                            </select>
                                                        </div> --}}
                                                         <div class="col-md-3">
                                                            <select class="form-control" v-model="familia.id_famili">
                                                                <option v-for=" f in familias" value="@{{ f.id_famili }}">@{{ f.nombre }}</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span class="btn btn-md btn-primary" v-on:click="guardarFamiliaProducto()">Agregar</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-1 control-label">Sub-Familia</label>
                                                        <div class="col-md-3">
                                                            <select class="form-control" v-model="familia.id_famili">
                                                                <option v-for=" f in familias" value="@{{ f.id_famili }}">@{{ f.nombre }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span class="btn btn-md btn-primary" v-on:click="guardarFamiliaProducto()">Agregar</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-horizontal" >
                                                        <div class="form-group">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <td class="">
                                                                      <strong>Familia</strong>
                                                                    </td>
                                                                    <td class="">
                                                                        <strong>Acciones</strong>
                                                                    </td>
                                                                </thead>
                                                                    <tbody>
                                                                        <tr v-for="fp in familias_productos">
                                                                            <td>@{{ fp.famili_id_famili }}</td>
                                                                            <td>
                                                                                <span class="btn btn-xs glyphicon glyphicon-trash" title="Eliminar" v-on:click="eliminarFamiliaProducto(fp.id_fampro)">
                                                                                     Eliminar
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>


                                             <div id="tab-fotos" class="tab-pane">
                                                <div class="panel-body">
                                                    <form class="form-horizontal">
                                                            <div class="form-group">
                                                                <label class="col-md-1 control-label">Foto</label>
                                                                <div class="fileinput fileinput-new input-group col-md-3" data-provides="fileinput">
                                                                    <div class="form-control" data-trigger="fileinput">
                                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                        <span class="fileinput-filename"></span>
                                                                    </div>
                                                                    <span class="input-group-addon btn btn-default btn-file">
                                                                        <span class="fileinput-new">Seleccionar</span>
                                                                        <span class="fileinput-exists">Cambiar</span>
                                                                        <input type="file" name="..." id="fotoRead">
                                                                    </span>
                                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-md-offset-9 col-md-3">
                                                                    <span class="btn btn-md btn-primary" v-on:click="guardarProducto()">Guardar</span>
                                                                </div>
                                                            </div>

                                                    </form>
                                                </div>

                                              {{--   <div id="AddImagesFromGallery" class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <ul class="nav nav-tabs">
                                                                <li class="active"><a href="#upload-tab" data-toggle="tab">Subir archivos</a></li>
                                                                <li><a href="#gallery-tab" data-toggle="tab">Galería de imagenes</a></li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="upload-tab">
                                                                    <span>Select files...</span>
                                                                    <!-- The file input field used as target for the file upload widget -->
                                                                    <input id="fileupload" type="file" name="files[]" multiple>
                                                                    <form id="media-upload" action="{{ url('api/v1/media/upload') }}" class="dropzone text-center">
                                                                        <h4>Subir archivos</h4>
                                                                        <div class="icons">
                                                                            <i class="icon-cloud-upload"></i>
                                                                        </div>
                                                                        <h3>
                                                                            <i class="icon-file-video"></i> <i class="icon-file-picture"></i>
                                                                        </h3>
                                                                        <p>Haz clic para elegir archivos desde tu computadora o arrastralos aquí</p>
                                                                    </form>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                                             aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                                            0%
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="gallery-tab">
                                                                    <ul class="list-gallery" id="list-gallery">
                                                                    
                    @forelse(\App\Multimedia::all() as $m)
                                                                            <li id="{{ $m->id }}">
                                                                                <div class="list-gallery-item">
                                                                                    @if(strpos($m->type, 'video')!==false)
                                                                                        <img src="{{ asset(Storage::url('default.png')) }}" alt="" data-code="{{ $m->id }}">
                                                                                        <p><i class="icon-file-video"></i> {{ $m->name }}</p>
                                                                                    @else
                                                                                        <img src="{{ $m->source }}" alt=""  data-code="{{ $m->id }}">
                                                                                        <p><i class="icon-file-picture"></i> {{ $m->name }}</p>
                                                                                    @endif
                                                                                </div>
                                                                            </li>
                                                                        @empty
                                                                            <div>No hay multimedia</div>
                                                                        @endforelse
                                                                                                                            
                                                                    </ul>

                                                                </div>
                                                                <!-- End gallery -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h3 class="block-label">Información de archivo</h3>
                                                            <div class="form-group">
                                                                <label for="name">Nombre</label>
                                                                <input type="text" class="form-control" name="name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Descripción</label>
                                                                <input type="text" class="form-control" name="description">
                                                            </div>
                                                            <br>
                                                            <a id="btnHideGallery" class="btn btn-sm btn-primary" ><i class="icon-check"></i>Seleccionar imágen</a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>



                                        <div id="tab-costos" class="tab-pane">
                                            <div class="panel-body">
                                                <form class="form-horizontal">
                                                    <div class="form-group">    

                                                        <table class="table table-hover">
                                                            <thead>
                                                                <td class="">
                                                                    <strong>Fecha</strong>
                                                                </td>
                                                                <td class="">
                                                                    <strong>Costo</strong>
                                                                </td>
                                                                <td class="">
                                                                    <strong>Incoterm</strong>
                                                                </td>

                                                                <td class="">
                                                                    <strong>Proveedor</strong>
                                                                </td>
                                                            </thead>
                                                            <tbody>
                                                                 @foreach(\App\Models\Producto::all() as $Producto)
                                                                     <form class="form-horizontal" >
                                                                        {{ csrf_field() }}
                                                                        <tr >
                                                                            <td  >
                                                                                {{$Producto->created_at}}
                                                                            </td>
                                                                            <td>
                                                                                {{$Producto->costo}}
                                                                            </td>
                                                                            <td  >
                                                                                {{$Producto->icoterms}}
                                                                            </td>
                                                                            <td  >
                                                                                Proveedor 1
                                                                            </td>
                                                                        </tr>
                                                                    </form>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                         </div>



                                        <div id="tab-presentaciones" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                   <form  class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-md-1 control-label">Presentaciones</label>
                                                             <div class="col-md-3">
                                                                <select class="form-control" v-model="presentacion.id_presen">
                                                                    <option v-for="p in presentaciones" value="@{{ p.id_presen }}">@{{p.nombre }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                            <div class="col-md-3">
                                                                <span class="btn btn-md btn-primary" v-on:click="guardarProductoPresentacion()">Agregar</span>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="form-horizontal" >
                                                            <div class="form-group">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <td class="">
                                                                            <strong>Presentacion</strong>
                                                                        </td>
                                                                        <td class="">
                                                                            <strong>Acciones</strong>
                                                                        </td>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="pp in productos_presentaciones">
                                                                            <td>@{{ pp.id_propre }}</td>
                                                                            <td>
                                                                                <span class="btn btn-xs glyphicon glyphicon-trash" title="Eliminar" v-on:click="eliminarProductoPresentacion(pp.id_propre)">
                                                                                     Eliminar
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="tab-unidades-medida" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <form  class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-md-1 control-label">Unidades de medida</label>
                                                            <div class="col-md-3">
                                                                <select class="form-control" v-model="unidad_medida.id_unimed">
                                                                    <option v-for="um in unidades_medida" value="@{{ um.id_unimed }}">@{{um.nombre }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-3">
                                                                    <span class="btn btn-md btn-primary" v-on:click="guardarProductoUnidadMedida()">Agregar</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-horizontal" >
                                                            <div class="form-group">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <td class="">
                                                                            <strong>Unidad de medida</strong>
                                                                        </td>
                                                                        <td class="">
                                                                            <strong>Acciones</strong>
                                                                        </td>
                                                                    </thead>
                                                                   <tbody>
                                                                        <tr v-for="pum in productos_unidades_medida">
                                                                            <td>@{{ pum.id_prunme }}</td>
                                                                            <td>
                                                                                <span class="btn btn-xs glyphicon glyphicon-trash" title="Eliminar" v-on:click="eliminarProductoUnidadMedida(pum.id_prunme)">
                                                                                     Eliminar
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="tab-precios" class="tab-pane">
                                            <div class="panel-body">
                                                <form class="form-horizontal">
                                                    <div class="form-group">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <td class="">
                                                                    <strong>Precio</strong>
                                                                </td>
                                                                <td class="">
                                                                    <strong>Fecha</strong>
                                                                </td>
                                                            </thead>
                                                            <tbody>
                                                                @foreach(\App\Models\Producto::all() as $Producto)
                                                                     <form class="form-horizontal" >
                                                                        {{ csrf_field() }}
                                                                        <tr >
                                                                             <td>
                                                                                {{$Producto->precio}}
                                                                            </td>
                                                                            <td  >
                                                                                {{$Producto->created_at}}
                                                                            </td>
                                                                        </tr>
                                                                    </form>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                <div id="tab-Descripcion-Web" class="tab-pane">
                                    <div class="panel-body">
                                        <form class="form-horizontal">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label for="pagina_web">Descripcion Web</label>
                                                            <textarea class="form-control" name="requirements"
                                                                  placeholder="Requerimientos"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   

@endsection
<script src="{{ asset('js/app/hifi_producto.js') }}"></script>