@extends('layouts.app')

@section('content')
	<h2>Editar CAI</h2>
	<form class="form padding" method="post" action="/cai/{{ $obj->id }}">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-md-6">				
		        @include('cai.formulario')

		        <div class="form-group">    
			    	<br>
			    	<input type="submit" value="Actualizar" class="btn btn-primary">                    
				</div>

				<div class="form-group">    
				    <a href="/cai">Regresar a pantalla principal de cais</a>
				</div>
			</div>
		</div>
	</form>
@stop