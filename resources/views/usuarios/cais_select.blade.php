<label>CAI</label>
<div class="row">
	<div class="col-md-4">
		<select name="cai_id[]" class="form-control">
			@foreach( $cais as $bloque)
				@foreach($bloque as $cai)
					<option 
						value="{{ $cai->id }}" 
						{{ in_array($cai->id, old('cai_id', is_null($obj)?[]:$obj->cai->pluck('id'))) ? 'selected' : '' }}>
						{{ $cai->nombre }} 
					</option>
				@endforeach
			@endforeach
		</select>
	</div>
</div>