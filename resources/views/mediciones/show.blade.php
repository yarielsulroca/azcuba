@extends('layouts.app')

@section('content')
	<h3>Resumen</h3>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<strong>Estado: </strong> {{ $medicion->estado->nombre }} 
			<br>					
			<strong>Creado por: </strong> {{ $medicion->usuario->name }}	<br>					
			<strong>Fecha de creaci&oacute;n: </strong> {{ $medicion->created_at }} <br>			
			<strong>CAI: </strong> {{ $medicion->cai->nombre }} ( {{ $medicion->cai->municipio->nombre }},  {{ $medicion->cai->municipio->provincia->nombre }} )	<br>
			<strong>Actualizado:</strong> {{$medicion->updated_at}}	<br>
			<strong>Atendido por: </strong> {{ is_null($medicion->recomendacion) ? '( no ha sido atendido )' : $medicion->recomendacion->usuario->name}}
		</div>	
		<div class="col-md-8">
			<strong>Unidades: </strong> {{ join(', ',$medicion->cai->unidades->pluck('nombre')->toArray()) }}
		</div>
	</div>
	
	<br>
	
	@if( $medicion->estaAprobada() )
		<h3>Recomendaci&oacute;n</h3>
		<hr>
			
		<div class="row">
			<div class="col-md-12">	
				<form method="POST" action="/mediciones/{{$medicion->id}}">
					@method('PUT')
					@csrf
					<div class="form-group {!! $errors->has('comentario') ? 'has-error' : '' !!}">    
				    	<label>Comentario</label>
				    	<textarea class="form-control" name="comentario">{{ old('comentario', optional($medicion->recomendacion)->comentario )}}</textarea>  
				        @if ($errors->has('comentario'))  
				            <span class="help-block">
				                <strong class="text-danger">{{ $errors->first('comentario') }}</strong>
				            </span>
				        @endif                      
					</div>
					@if( !$tieneRecomendacion || $soyElRecomendante )
						<input type="submit" value="Actualizar" class="btn btn-primary">
					@endif
				</form>
			</div>
		</div>

		<br>
		<h3>Ficheros asociados</h3>
	
		@if( $tieneRecomendacion )
			@if( !is_null($medicion->recomendacion) && $medicion->recomendacion->ficheros->count()>0)
				<table class="table">
					<thead>
						<tr>
							<th>Nombre fichero</th>
							<th>Subido el</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach( $medicion->recomendacion->ficheros as $fichero )
							<tr>
								<td>
									<a target="_blank" href="/medicion/descargar-recomendaciones/{{$fichero->id}}">{{ $fichero->nombre_fichero }}</a>
								</td>
								<td>{{ $fichero->created_at }}</td>
								<td>
									@if( $puedeEliminarFicheros )
										<form method="POST" action="/eliminar-fichero-recomendacion/{{ $fichero->id }}">
											@method('DELETE')
											@csrf
											<button type="submit" class="close" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
										</form>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<div class="alert alert-info">No hay ficheros en la recomendaci&oacute;n</div>
			@endif

			@if( $puedeSubirRecomendacion )
				<form action="/medicion/{{ $medicion->id }}/subir-fichero" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="file" name="fichero"> <br>
					<br>
					<input type="submit" class="btn-primary btn" value="Subir fichero">
				</form>
			@endif
			<br>
		@endif

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">    				    			    
				   	<a href="/tipo-unidad">Regresar a pantalla principal de mediciones</a>
				</div>
			</div>
		</div>
	@endif

	@if( $medicion->estaSolicitada() )  
		<a href="/medicion/{{$medicion->id}}/aprobar" class="btn btn-primary">Aprobar</a>
		<a href="/medicion/{{$medicion->id}}/rechazar" class="btn btn-danger">Rechazar</a>
	@endif
	<hr>
@stop