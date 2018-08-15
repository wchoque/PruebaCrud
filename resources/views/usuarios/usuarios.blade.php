@extends('layouts.app') @section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>cliente</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Inicio</a>
			</li>
			<li class="active">
				<strong>cliente</strong>
			</li>
		</ol>
	</div>
</div>
<div id="clientes">
	{{-- Listado --}}
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper wrapper-content animated fadeInUp">
				<div class="ibox">
					<div class="ibox-title">
						<h5>Listado de clientes</h5>
						<div class="ibox-tools">
							<a href="#" class="btn btn-primary btn-xs" v-on:click="nuevoCliente()">Crear un nuevo cliente</a>
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
										<strong>Estado</strong>
									</td>
									<td class="project-title">
										<strong>Cliente</strong>
									</td>
									<td class="project-title">
										<strong>Codigo</strong>
									</td>
									<td class="project-title">
										<strong>RUC/DNI</strong>
									</td>
									<td class="project-title">
										<strong>Direccion</strong>
									</td>
									<td class="project-title">
										<strong>Telefono Principal</strong>
									</td>
									<td class="project-title">
										<strong>Ultima Compra</strong>
									</td>
									<td class="project-actions">
									</td>
								</thead>
								<tbody>
									<tr v-for="c in correntistas">
										<td class="project-status">
											<span class="label label-primary" v-if="c.estado">Activo</span>
											<span class="label label-default" v-else>Inactivo</span>
										</td>
										<td class="project-title">
											<a href="project_detail.html">@{{ c.nombres }} @{{ c.apellidos }}</a>
										</td>
										<td>
											@{{ c.codigo }}
										</td>
										<td>
											@{{ c.num_doc }}
										</td>
										<td>
											@{{ c.direccion }}
										</td>
										<td>
											@{{ c.telefono }}
										</td>
										<td>
											15/Oct/2017
											<br/>
											<small>S/. 250.00</small>
										</td>
										<td class="project-actions">

											<span class="btn btn-warning btn-sm" title="Editar" v-on:click="obtenerCliente(c.id_corren)">
												<i class="fa fa-pencil"></i>
											</span>
											<span class="btn btn-danger btn-sm" title="Eliminar" v-on:click="eliminarCorrentista(c.id_corren)">
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
	<div class="row" v-show="nuevo">
		<div class="wrapper wrapper-content">
			<div class="row animated fadeInRight">
				<div class="col-md-2">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Perfil</h5>
						</div>
						<div>
							<div class="ibox-content no-padding border-left-right">
								<img :src="C." alt="image" class="img-responsive">
							</div>
							<div class="ibox-content profile-content">
								<h4>
									<strong>@{{ correntista.nombres }}</strong>
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
										<a v-show="con" data-toggle="tab" href="#tab-contactos" v-on:click="obtenerContactos()">Contactos</a>
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
												<label class="col-md-1 control-label">Codigo</label>
												<div class="col-md-3">
													<input readonly type="text" class="form-control" placeholder="Codigo" v-model="correntista.codigo" />
												</div>
												<label class="col-md-1 control-label">Tipo Doc.</label>
												<div class="col-md-3">
													<select class="form-control" v-model="correntista.tipdoc_id_tipdoc">
														<option v-for=" t in tipo_documentos" value="@{{ t.id_tipdoc }}">@{{ t.descripcion }}</option>
													</select>
												</div>
												<label class="col-md-1 control-label">RUC/DNI</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="RUC/DNI" v-model="correntista.num_doc" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Razon Social</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Razon Social" v-model="correntista.razon_social" />
												</div>
												<label class="col-md-1 control-label">Nombre Comercial</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Nombre Comercial" v-model="correntista.nombre_comercial" />
												</div>
												<label class="col-md-1 control-label">Estado</label>
												<div class="col-md-3">
													<select class="form-control " v-model="correntista.estado">
														<option value="1">Activo</option>
														<option value="0">Inactivo</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Apellidos</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Apellidos" v-model="correntista.apellidos" />
												</div>
												<label class="col-md-1 control-label">Nombres</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Nombres" v-model="correntista.nombres" />
												</div>
												<label class="col-md-1 control-label">Extranjero</label>
												<div class="col-md-3">
													<select class="form-control " v-model="correntista.extranjero">
														<option value="1">Si</option>
														<option value="0">No</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class=" col-md-1 control-label">Telefono</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Telefono" v-model="correntista.telefono" />
												</div>
												<label class="col-md-1 control-label">Celular</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Celular" v-model="correntista.movil" />
												</div>
												<label class="col-md-1 control-label">Correo</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Correo" v-model="correntista.email" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Pais</label>
												<div class="col-md-3">
													<select id="pais" name="pais" class="form-control select2" v-model="correntista.pais">
														<option v-for="p in paises" value="@{{ p.id_ubigeo }}">@{{ p.nombre }}</option>
													</select>
												</div>
												<label class="col-md-1 control-label">Departamento</label>
												<div class="col-md-3">
													<select id="departamento" class="form-control select2" v-model="correntista.departamento">
														<option v-for="d in departamentos" value="@{{ d.id_ubigeo }}">@{{ d.nombre }}</option>
													</select>
												</div>
												<label class="col-md-1 control-label">Provincia</label>
												<div class="col-md-3">
													<select id="provincia" class="form-control select2" v-model="correntista.provincia">
														<option v-for="pr in provincias" value="@{{ pr.id_ubigeo }}">@{{ pr.nombre }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Distrito</label>
												<div class="col-md-3">
													<select id="distrito" class="form-control select2" v-model="correntista.distrito">
														<option v-for="d in distritos" value="@{{ d.id_ubigeo }}">@{{ d.nombre }}</option>
													</select>
												</div>
												<label class="col-md-1 control-label">Direccion</label>
												<div class="col-md-7">
													<input type="text" class="form-control" placeholder="Direccion" v-model="correntista.direccion" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Genero</label>
												<div class="col-md-3">
													<select id="genero" class="form-control "  v-model="correntista.genero">
														<option value="M">Masculino</option>
														<option value="F">Femenino</option>
													</select>
												</div>
												<label class="col-md-1 control-label">Est. Civil</label>
												<div class="col-md-3">
													<select id="estadoCivil" class="form-control"  v-model="correntista.estado_civil">
														<option value="CA">Casado(a)</option>
														<option value="DI">Divorciado(a)</option>
														<option value="SO">Soltero(a)</option>
														<option value="VI">Viudo(a)</option>
													</select>
												</div>
												<label class="col-md-1 control-label">Fec. Nacimiento</label>
												<div  class="col-md-3">
													<div id="fechanacimiento" class="input-group date">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" />
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Distribuidor</label>
												<div class="col-md-3">
													<select class="form-control " v-model="correntista.distribuidor">
														<option value="1">Si</option>
														<option value="0">No</option>
													</select>
												</div>
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
												<label class="col-md-1 control-label">Notas</label>
												<div class="col-md-11">
													<textarea class="form-control" v-model="correntista.notas"></textarea>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-9 col-md-3">
													<span class="btn btn-md btn-primary" v-on:click="guardarCliente()">Guardar</span>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div id="tab-contactos" class="tab-pane">
									<div class="panel-body">
										<form class="form-horizontal">
											<div class="form-group">
												<label class="col-md-1 control-label">Contacto</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Contacto" v-model="contacto.contacto" />
												</div>
												<label class="col-md-1 control-label">Pagina Web</label>
												<div class="col-md-7">
													<input type="text" class="form-control" placeholder="www." v-model="contacto.pagina_web" />
												</div>

											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Telefono</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Telefono" v-model="contacto.telefono" />
												</div>
												<label class="col-md-1 control-label">Celular</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Celular" v-model="contacto.movil" />
												</div>
												<label class="col-md-1 control-label">Correo</label>
												<div class="col-md-3">
													<input type="text" class="form-control" placeholder="Correo" v-model="contacto.email" />
												</div>
											</div>
                                            <div class="form-group">
                                                <label class="col-md-1 control-label">Direccion</label>
                                                <div class="col-md-11">
                                                    <input type="text" class="form-control" placeholder="Direccion" v-model="contacto.ubicacion" />
                                                </div>

                                            </div>
											<div class="form-group">
												<div class="col-md-offset-9 col-md-3">
													<span class="btn btn-md btn-primary" v-on:click="guardarContacto()">Guardar</span>
												</div>
											</div>
											<div class="full-height-scroll">
												<div class="table-responsive">
													<table class="table table-striped table-hover">
														<thead>
															<tr>
																<td class="project-title">
																	<strong>Contacto</strong>
																</td>
																<td class="project-title">
																	<strong>Telefono</strong>
																</td>
																<td class="project-title">
																	<strong>Celular</strong>
																</td>
																<td class="project-title">
																	<strong>Correo</strong>
																</td>
																<td class="project-title">
																	<strong>Web</strong>
																</td>
																<td></td>
															</tr>

														</thead>
														<tbody>
															<tr v-for="c in contactos">
																<td>@{{ c.telefono }}</td>
																<td>@{{ c.telefono }}</td>
																<td>@{{ c.movil }}</td>
																<td>@{{ c.email }}</td>
																<td>@{{ c.pagina_web }}</td>
																<td>
																	<span class="btn btn-xs btn-warning" title="Editar" v-on:click="obtenerContacto(c)">
																		<i class="fa fa-edit"></i>
																	</span>
																	<span class="btn btn-xs btn-danger" title="Eliminar" v-on:click="eliminarContacto(c.id_cordat)">
																		<i class="fa fa-close"></i>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection
<script src="{{ asset('js/app/hifi_app.js') }}"></script>