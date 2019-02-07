<div class="row chat-line chat-line-investigador">
	<div class="col-md-10">
		<div class="alert alert-warning" role="alert">
		  {{ $chatLine->comentario }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-10">
		<small><b>{{ $chatLine->usuario->name }}: </b> {{ $chatLine->created_at }}</small>
	</div>
</div>