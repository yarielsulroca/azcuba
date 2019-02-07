@extends('layouts.app')

@section('content')
	@if( $puedeComentar )
		<label>Comentario</label>
		<form method="POST">
			@csrf
			<textarea class="form-control" name="comentario"></textarea>
			<br>
			<input type="submit" value="Comentar" class="btn btn-primary">
		</form>
		<hr>
	@endif

	@foreach( $medicion->chat->sortByDesc('created_at') as $chatLine )		
		@includeWhen($chatLine->user_id == $medicion->recomendacion->user_id, 'mediciones.chat.investigador')
		@includeWhen($chatLine->user_id != $medicion->recomendacion->user_id, 'mediciones.chat.cliente')
	@endforeach
	<br>
@stop