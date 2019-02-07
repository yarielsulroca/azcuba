<label>CAIS</label>
<div class="row">
	@foreach( $cais as $bloque)
		<div class="col-md-4">
			@foreach($bloque as $cai)
				<label style="display: block;">
					<input type="checkbox" 
						   name="cai_id[]" 
						   value="{{ $cai->id }}"
						   {{ in_array($cai->id, old('cai_id', is_null($obj)?[]:$obj->cai->pluck('id'))) ? 'checked' : '' }}>
					{{ $cai->nombre }} 
				</label>
				
			@endforeach
		</div>
	@endforeach
</div>