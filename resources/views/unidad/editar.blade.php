@extends('layouts.app')

@section('content')
	<h2>Editar unidad</h2>
	<form class="form padding" method="post" action="/unidades/{{ $obj->id }}">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-md-6">
		        @include('unidad.formulario')

		        <div class="form-group">    
				   
				    	<br>
				    	<input type="submit" value="Actualizar" class="btn btn-primary">                    
				   
				</div>

				<div class="form-group">    
				        	
				    	<a href="/unidades">Regresar a pantalla principal de unidades</a>
				    
				</div>
			</div>
		</div>
	</form>
@stop