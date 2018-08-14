<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>{{ config('app.name', 'Laravel') }}</title>
	<!-- Style -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<!-- Script -->
	<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>

<body class="gray-bg">

	<div class="middle-box text-center loginscreen animated fadeInDown">
		<div>
			<div>
				<h1 class="logo-name">HiFi</h1>
			</div>
			<h3>Bienvenido a HiFi</h3>
			<form class="m-t" role="form"  method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
					<input type="text" class="form-control" placeholder="Usuario" required="" value="{{ old('email') }}" name="email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
				</div>
				<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
					<input type="password" class="form-control" placeholder="Contraseña" required="" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                         </span>
                    @endif
				</div>
				<button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>

				<a href="#">
					<small>Olvidaste la contraseña?</small>
				</a>
				<a class="btn btn-sm btn-white btn-block" href="register.html">Crear una cuenta</a>
			</form>
			<p class="m-t">
				<small>Desarrollo &copy; 2017</small>
			</p>
		</div>
	</div>
</body>

</html>