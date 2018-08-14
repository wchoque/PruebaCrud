@extends('layouts.app') @section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Precios</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Inicio</a>
			</li>
			<li>
				<a>Inventario</a>
			</li>
			<li class="active">
				<strong>Precios</strong>
			</li>
		</ol>
	</div>
</div>
<div id="precios">	
	{{-- Listado --}}

	<div class="row">
	 	<div class="col-lg-12">
			<div class="wrapper wrapper-content animated fadeInUp">
				<form class="form-group">
					<label class="col-md-1 control-label">Familias</label>
	                <div class="col-md-3">
	                    <select class="form-control" v-model="familia.id_famili">
	                        <option v-for="f in familias" value="@{{ f.id_famili }}">@{{ f.nombre }}</option>
	                    </select>
	                </div>
                        <div class="col-md-6">
                            <span class="btn btn-md btn-primary" v-on:click="obtenerProductosFiltradoFamilia()">Filtrar por familia</span>
	                    </div>
				</form>
			</div>
			<div class="wrapper wrapper-content animated fadeInUp">
				<form class="form-group">
					<label class="col-md-1 control-label"> Sub-Familias</label>
	                <div class="col-md-3">
	                    <select class="form-control" v-model="Familias">
	                        <option v-for="f in familias" value="@{{ f.id_famili }}">@{{ f.nombre }}</option>
	                    </select>
	                </div>
                        <div class="col-md-6">
                            <span class="btn btn-md btn-primary" v-on:click="obtenerProductosFiltradoSubFamilia()">Filtrar por sub-familia</span>
	                    </div>
				</form>
			</div>
		</div>
	</div>


	{{-- Detalles --}}
	<div class="row" >
		<div class="wrapper wrapper-content">
			<div class="row animated fadeInRight">
				<div class="col-md-12">
	 				<div class="full-height-scroll">
	                    <div class="table-responsive">
	                        <table class="table table-striped table-hover">
	                            <thead>
	                                <tr>
	                                    <td class="project-title">
	                                        <strong>Producto</strong>
	                                    </td>
	                                    
	                                    <td>Estado</td>
	                                    <td>Costo</td>
	                                    <td>Afecto IGV</td>
	                                    <td>Incoterm</td>
	                                    <td>Editar</td>
	                                    {{-- <td>Acciones</td>
	                                    <td>Acciones</td>
	                                    <td>Acciones</td> --}}
	                                </tr>

	                            </thead>
	                            <tbody>
	                                <tr v-for="p in productos">
                                        <td class="project-status">
                                            <span class="label label-primary" v-if="p.estado">Activo</span>
                                            <span class="label label-default" v-else>Inactivo</span>
                                        </td>
	                                    <td>@{{ p.nombre }}</td>
	                                    <td>@{{ p.costo }}</td>
	                                    {{-- <td>@{{ p.igv }}</td> --}}

                                       	<td class="project-status">
                                            <span v-if="p.igv">Si</span>
                                            <span v-else>No</span>
                                        </td>
	                                    <td> @{{ p.icoterms}} </td>
	                                    <td> <input v-model="producto.editar" type="checkbox" name=""></td>

	                                </tr>
	                            </tbody>
	                        </table>
	                    </div>

                    	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#editarDatosProductosFull">
							<span {{-- class="glyphicon glyphicon-fullscreen" --}}>Editar</span>
						</button>


	                    
                	</div>

            		
				</div> 
						<div class="container" >
	                   	
	                    	<div class="modal fade" id="editarDatosProductosFull" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="model-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="text-center"><strong> EDITAR DATOS DE PRODUCTOS </strong></h4>
										</div>

										<div class="modal-body">
										{{-- 	<div class="form-control">
												<div class="col-md-3">
													<label class="col-md-1 control-label">Costo</label>
                                                    <input class="form-control" type="text" name="Costo" value="100.00" />
                                                </div>

                                                <div class="col-md-3">
													<label class="col-md-1 control-label">IGV</label>
                                                    <select class="form-control" name="igv" >
                                                    	<option selected="true" disabled="disabled">Afecto IGV</option>
                                                        <option  value="1">Si</option>
                                                        <option  value="0">No</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                	<label class="col-md-1 control-label">Incoterm</label>
                                                    <input type="text" class="form-control" placeholder="EXW" name="incoterm"  />
                                                    <select class="form-control" name="icoterms" >
                                                    	<option selected="true" disabled="disabled">Tipo Incoterm</option>
                                                        <option value="EXW" >EXW</option>
                                                        <option value="FOB">FOB</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                               		<label class="col-md-1 control-label">Estado</label>
                                                    <select class="form-control" name="estado">
                                                    	<option selected="true" disabled="disabled">Seleccione Estado</option>
                                                        <option value="1">Activo</option>
                                                        <option value="0">Inactivo</option>
                                                    </select>
                                                </div>
                                             </div> --}}

                                              	<div class="form-group">
                                                       

                                                        <label class="col-md-1 control-label">Costo</label>
                                                        <div class="col-md-2">
                                                            <input v-model="update.costo" type="text" class="form-control" name="costo" value="10" />
                                                        </div>

                                                         <label class="col-md-1 control-label">IGV</label>
                                                        <div class="col-md-2">
                                                            <select v-model="update.igv" class="form-control" name="igv" >
		                                                    	<option selected="true" disabled="disabled">Afecto IGV</option>
		                                                        <option  value="1">Si</option>
		                                                        <option  value="0">No</option>
		                                                    </select>
                                                        </div>

                                                         <label class="col-md-1 control-label">Incoterm</label>
                                                        <div class="col-md-2">
                                                            <select v-model="update.icoterms" class="form-control" name="icoterms" >
		                                                    	<option selected="true" disabled="disabled">Tipo Incoterm</option>
		                                                        <option value="EXW" >EXW</option>
		                                                        <option value="FOB">FOB</option>
		                                                    </select>
                                                        </div>

                                                        <label class="col-md-1 control-label">Estado</label>
                                                        <div class="col-md-2">
                                                            <select v-model="update.estado" class="form-control" name="estado" >
		                                                    	<option selected="true" disabled="disabled">Seleccione estado</option>
		                                                    	<option value="1">Activo</option>
                                                        		<option value="0">Inactivo</option>
		                                                    </select>
                                                        </div>

                                                        
                                                 </div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
											<button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="ActualizarProductosMasivo()">Guardar Cambios</button>
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
<script src="{{ asset('js/app/hifi_precios.js') }}"></script>