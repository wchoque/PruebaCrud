@extends('layouts.app') @section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Clientes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Inicio</a>
                </li>
                <li>
                    <a>Maestros</a>
                </li>
                <li class="active">
                    <strong>Clientes</strong>
                </li>
            </ol>
        </div>
    </div>
    <div id="importaciones">
        {{-- Listado --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">

                            <div class="project-list">
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
														<input type="file" name="excel" id="excelRead">
													</span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-9 col-md-3">
                                            <span class="btn btn-md btn-primary" v-on:click="subirExcel()">Excel</span>
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



@endsection
<script src="{{ asset('js/app/hifi_importaciones_app.js') }}"></script>