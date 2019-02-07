<div class="row chat-line chat-line-cliente">
	<div class="col-md-10 offset-md-2">
		<div class="alert alert-secondary" role="alert">
		{{ $chatLine->comentario }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-10 offset-md-2">
		<small><b>{{ $chatLine->usuario->name }}: </b> {{ $chatLine->created_at }}</small>
	</div>
</div>