<div class="form-group {!! $errors->has('nombre') ? 'has-error' : '' !!}">    
	<label>Nombre</label>
	<input type="text" name="nombre" value="{!! old('nombre', is_null($obj) ? '' : $obj->nombre) !!}" class="form-control" maxlength="50">        
    @if ($errors->has('nombre'))  
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('nombre') }}</strong>
        </span>
    @endif                      
</div>