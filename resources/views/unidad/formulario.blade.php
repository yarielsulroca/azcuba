<div class="form-group {!! $errors->has('nombre') ? 'has-error' : '' !!}">    
    
    	<label>Nombre</label>
    	<input type="text" name="nombre" value="{!! old('nombre', is_null($obj) ? '' : $obj->nombre) !!}" class="form-control" maxlength="50">        
        @if ($errors->has('nombre'))  
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('nombre') }}</strong>
            </span>
        @endif                      
    
</div>

<div class="form-group {!! $errors->has('codigo') ? 'has-error' : '' !!}">    

        <label>codigo</label>
        <input type="text" name="codigo" maxlength="10" value="{!! old('codigo', is_null($obj) ? '' : $obj->codigo) !!}" class="form-control" maxlength="50">        
        @if ($errors->has('codigo'))  
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('codigo') }}</strong>
            </span>
        @endif                      
   
</div>

<div class="form-group {!! $errors->has('tipo_id') ? 'has-error' : '' !!}">    
    
    	<label>Tipo</label>
    	<select name="tipo_id" class="form-control">
    		@foreach( $tipos as $tipo ) 
    			<option value="{{ $tipo->id }}" {{ $tipo->id == old('tipo_id', is_null($obj) ? -1 : $obj->tipo_id) ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
    		@endforeach
    	</select>        
        @if ($errors->has('tipo_id'))  
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('tipo_id') }}</strong>
            </span>
        @endif                      
   
</div>

<div class="form-group {!! $errors->has('cai_id') ? 'has-error' : '' !!}">    
    
    	<label>Cai</label> 
    	<select name="cai_id" class="form-control">
    		@foreach( $cais as $cai ) 
    			<option value="{{ $cai->id }}" {{ $cai->id == old('cai_id', is_null($obj) ? -1 : $obj->cai_id) ? 'selected' : '' }}>{{ $cai->nombre }}</option>
    		@endforeach
    	</select>  
        @if ($errors->has('cai_id'))  
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('cai_id') }}</strong>
            </span>
        @endif                      
    
</div>