@extends('layouts.app')

@section('content')
	
	<h2>Crear tipo de unidad</h2>	

	<form class="form padding" method="post">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
		        @include('tipounidad.formulario')

		        <div class="form-group">    
				    
				    	<br>
				    	<input type="submit" value="Crear" class="btn btn-primary">                    
				   
				</div>

				<div class="form-group">    
				    	    	
				    	<a href="/tipo-unidad">Regresar a pantalla principal de tipos de unidad</a>
				   
				</div>
			</div>
		</div>
	</form>
@stop