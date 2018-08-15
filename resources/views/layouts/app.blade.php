<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Tittle -->
	<title>{{ config('app.name', 'Laravel') }}</title>
	<!-- Style -->
	<link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/cropper/cropper.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/switchery/switchery.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/nouslider/jquery.nouislider.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/dualListbox/bootstrap-duallistbox.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
	<!-- Script -->
    <script>  var root = "{{url('/')}}";</script>
	<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/inspinia.js') }}"></script>
	<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
	<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
	<script src="{{ asset('js/plugins/jsKnob/jquery.knob.js') }}"></script>
	<script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/plugins/nouslider/jquery.nouislider.min.js') }}"></script>
	<script src="{{ asset('js/plugins/switchery/switchery.js') }}"></script>
	<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>
	<script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
	<script src="{{ asset('js/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
	<script src="{{ asset('js/plugins/clockpicker/clockpicker.js') }}"></script>
	<script src="{{ asset('js/plugins/cropper/cropper.min.js') }}"></script>
	<script src="{{ asset('js/plugins/fullcalendar/moment.min.js') }}"></script>
	<script src="{{ asset('js/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"></script>
	<script src="{{ asset('js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
	<script src="{{ asset('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
	<script src="{{ asset('js/plugins/dualListbox/jquery.bootstrap-duallistbox.js') }}"></script>
	<script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
	<script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
	<script src="{{ asset('js/plugins/footable/footable.all.min.js') }}"></script>
	<script src="{{ asset('js/demo/peity-demo.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<!-- Vue -->
	<script src="{{ asset('js/vue/vue.js') }}"></script>
	<script src="{{ asset('js/vue/vue-router.min.js') }}"></script>
	<script src="{{ asset('js/vue/vue-resource.min.js') }}"></script>
	<script src="{{ asset('js/vue/vue-strap.js') }}"></script>
	<!-- App -->

	<script src="{{ asset('js/app/hifi_components.js') }}"></script>
	<script>
		$(document).ready(function () {
			$(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
			//
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "preventDuplicates": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
			//
            $(".select2").select2({
                placeholder: "Seleccione un item",
                allowClear: true,
                width: "100%"
            });
			//
			$('.footable').footable();
			//
			$(".date").datepicker();
			});
	</script>
</head>

<body class="pace-done" cz-shortcut-listen="true">
	<div class="pace  pace-inactive">
		<div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
			<div class="pace-progress-inner"></div>
		</div>
		<div class="pace-activity"></div>
	</div>
	<div id="wrapper">

		<nav class="navbar-default navbar-static-side" role="navigation" id="menu">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu" style="">
					<li class="nav-header">
						<div class="dropdown profile-element">
							<span>
								<img alt="image" class="img-circle" src="{{ url('/img/logo_hifi_ref.jpg') }}">
							</span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear">
									<span class="block m-t-xs">
										<strong class="font-bold">{{Auth::user()->name}}</strong>
									</span>
									<span class="text-muted text-xs block">TODO
										<b class="caret"></b>
									</span>
								</span>
							</a>
						
						</div>
						<div class="logo-element">HiFi</div>
					</li>
					<li>
						<a href="">
							<i class="fa fa-home"></i>
							<span class="nav-label">Inicio</span>
						</a>
					</li>
					<li>
						<a href="">
							<i class="fa fa-user"></i>
							<span class="nav-label">Usuarios</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse">
							<li>
								<a href="{{ url('usuarios') }}">Usuarios</a>
							</li>
							
						</ul>
					</li>
				
				</ul>
			</div>
		</nav>

		<div id="page-wrapper" class="gray-bg" style="min-height: 382px;">
			<div class="row border-bottom" id="cabecera">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<span class="m-r-sm text-muted welcome-message">Bienvenido => {{Auth::user()->name}}</span>
						</li>
						<li>
							<a href="{!! url('/logout') !!}">
								<i class="fa fa-sign-out"></i>Cerrar Sesión</a>
						</li>
					</ul>
				</nav>
			</div>
			@yield('content')
			<div class="footer">
				<div>
					<strong>DEMO</strong> DEMO LARAVEL
				</div>
			</div>

		</div>
	</div>
</body>

</html>