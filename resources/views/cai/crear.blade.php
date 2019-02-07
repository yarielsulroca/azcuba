@extends('layouts.app')

@section('content')
	<h2>Crear CAI</h2>
	<form class="form padding" method="post" action="/cai">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
		        @include('cai.formulario')

		        <div class="form-group">    
				    
				    	<br>
				    	<input type="submit" value="Crear" class="btn btn-primary">                    
				    
				</div>

				<div class="form-group">    
				    
				    	<a href="/cai">Regresar a pantalla principal de cais</a>
				    
				</div>
			</div>
		</div>
	</form>
@stop

