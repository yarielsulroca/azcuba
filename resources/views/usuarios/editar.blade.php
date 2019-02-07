@extends('layouts.app')

@section('content')
	<form class="form padding" method="post" action="/usuario/{{ $obj->id }}">
		@csrf
		@method('PUT')

		<h2 class="pl-15">Editar usuario "{{ $obj->name }}"</h2>

		<div class="row">
			<div class="col-md-6">
		        @include('usuarios.formulario')

		        <div class="form-group">    
				    <div class="col-sm-12">
				    	<br>
				    	<input type="submit" value="Actualizar" class="btn btn-primary">                    
				    </div>
				</div>

				<div class="form-group">    
				    <div class="col-sm-12">				    	
				    	<a href="/usuario">Regresar a pantalla principal de usuarios</a>
				    </div>
				</div>
			</div>
		</div>
	</form>
@stop