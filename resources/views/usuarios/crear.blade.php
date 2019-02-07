@extends('layouts.app')

@section('content')
	<h2>Crear usuario</h2>
	<form class="form padding" method="post" action="/usuario">
		{{ csrf_field() }}
		<div class="row">
			@include('usuarios.formulario')
		</div>

		<span id="list" class="cais">
			@include('usuarios.cais_list')
		</span>

		{{--<span id="select" class="cais">
			@include('usuarios.cais_select')
		</span>--}}

		<br>

	
		
		<div class="row">
			<div class="col-md-12">
				<input type="submit" value="Crear" class="btn btn-primary">  
			</div>	              
		</div>   
		<div class="row">
			<div class="col-md-12">
		    	<a href="/usuario">Regresar a pantalla principal de usuarios</a>
			</div>
		</div>
	</form>
@stop

@section('script')
	<script type="text/javascript">
		let role = $('#role_id'),
			cais = $('.cais');

		role.on('change', onChangeRole);

		function onChangeRole() {
			cais.hide();
			$('input, select', cais).prop('disabled', true);
			
			if( role.val()==2 || role.val()==4 ) { 
				$(cais[0]).show(); 
				$('input, select', $(cais[0])).prop('disabled', false);
			}
			if( role.val()==3 ) { 
				$(cais[1]).show(); 
				$('input, select', $(cais[1])).prop('disabled', false);
			}
 		}
	</script>
@stop