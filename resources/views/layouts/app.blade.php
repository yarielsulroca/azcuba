<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('estilos')
</head>
<body>    
    
    @include('layouts.nav')

    <main class="container" role="main">   
                
        @if( $errors->has('error_aplicacion') )
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>ERROR: </strong> {!! $errors->first('error_aplicacion') !!}
            </div>
        @endif

        <div>
            @yield('content')         
        </div>
    </main>
            
    <footer>
        <div>
           
            <a target="_blank" href="http://www.azcuba.cu">
                <img width="80" border="0" src="/images/logo-cubaenergia.jpg">
            </a>
            
        </div><br>
        <div>Todos los derechos reservados &copy; {!! date('Y') !!}</div>
        <a target="_blank" href="http://www.azcuba.cu">
            <img width="80" border="0" src="{{URL::asset('images/cubamap.jpg')}}" >
        </a>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @yield('script')
</body>
</html>