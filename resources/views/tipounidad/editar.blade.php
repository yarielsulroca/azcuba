@extends('layouts.app')

@section('content')
	<form class="form padding" method="post" action="/tipo-unidad/{{ $obj->id }}">
		@csrf
		@method('PUT')
		
		<h2 class="pl-15">Editar Tipo de unidad "{{ $obj->nombre }}"</h2>

		<div class="row">
			<div class="col-md-6">
		        @include('tipounidad.formulario')

		        <div class="form-group">    
				  
				    	<br>
				    	<input type="submit" value="Actualizar" class="btn btn-primary">                    
				  
				</div>

				<div class="form-group">    
				    
				    	<a href="/tipo-unidad">Regresar a pantalla principal de tipo de unidad</a>
				   
				</div>
			</div>
		</div>
	</form>
@stop