@extends('layouts.app') @section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Roles</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Inicio</a>
			</li>
			<li class="active">
				<strong>Roles</strong>
			</li>
			
		</ol>
	</div>
</div>
<div id="roles">
	{{-- Listado --}}
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper wrapper-content animated fadeInUp">
				<div class="ibox">
					<div class="ibox-title">
						<h5>Listado de Roles</h5>
						<div class="ibox-tools">
							<a href="#" class="btn btn-primary btn-xs" v-on:click="nuevoRol()">Crear un nuevo Rol</a>
						</div>
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
										<strong>Rol</strong>
									</td>
									<td class="project-title">
										<strong>Descripción</strong>
									</td>																		
									<td class="project-actions">
									</td>
								</thead>
								<tbody>
									<tr v-for="r in roles">
										<td>
                                            @{{r.nombre}}
										</td>
										<td>
                                            @{{r.descripcion}}
										</td>

										<td class="project-actions">

											<span class="btn btn-warning btn-sm" title="Editar" v-on:click="obtenerRol(r)">
												<i class="fa fa-pencil"></i>
											</span>
											<span class="btn btn-danger btn-sm" title="Eliminar" v-on:click="eliminarRol(r.id)">
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
	{{-- Detalles --}}
	<div class="row" >
		<div class="wrapper wrapper-content">
			<div class="row animated fadeInRight">
				<div class="col-md-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab-principal">Principal</a>
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
										<form class="form-horizontal">
											<div class="form-group">
												<label class="col-md-1 control-label">Rol</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Nombre" v-model="rol.nombre"/>
												</div>
												<label class="col-md-1 control-label">Descripción</label>
                                                <div class="col-md-3">
                                                    <input  type="text" class="form-control" placeholder="Descripcion" v-model="rol.descripcion" />
                                                </div>											
											</div>											
											<div class="form-group">
												<div class="col-md-offset-9 col-md-3">
													<span class="btn btn-md btn-primary" v-on:click="guardarRol()">Guardar</span>
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
<script src="{{ asset('js/app/hifi_rol.js') }}"></script>