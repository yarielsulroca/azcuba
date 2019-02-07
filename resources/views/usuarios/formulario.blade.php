
    <div class="col-md-6 form-group {!! $errors->has('name') ? 'has-error' : '' !!}">    
        
    	<label>Nombre</label>
    	<input type="text" name="name" value="{!! old('name', is_null($obj) ? '' : $obj->name) !!}" class="form-control" maxlength="50">        
        @if ($errors->has('name'))  
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('name') }}</strong>
            </span>
        @endif                      
        
    </div>

    <div class="col-md-6 form-group {!! $errors->has('email') ? 'has-error' : '' !!}">    
        
        <label>email</label>
        <input type="text" autocomplete="off" name="email" value="{!! old('email', is_null($obj) ? '' : $obj->email) !!}" class="form-control" maxlength="50">        
        @if ($errors->has('email'))  
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('email') }}</strong>
            </span>
        @endif                      
        
    </div>

    @if( is_null($obj) )
        <div class="col-md-6 form-group {!! $errors->has('password') ? 'has-error' : '' !!}">    
            
            <label>password</label>
            <input type="text" autocomplete="off" name="password" value="{!! old('password', is_null($obj) ? '' : $obj->password) !!}" class="form-control" maxlength="50">        
            @if ($errors->has('password'))  
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                </span>
            @endif                      
            
        </div>
    @endif

    <div class="col-md-6 form-group {!! $errors->has('role_id') ? 'has-error' : '' !!}">    
    	<label>Rol</label>
    	<select name="role_id" id="role_id" class="form-control">
            <option {{ is_null($obj) && is_null(old('role_id', null)) ? 'disabled selected' : '' }}>Seleccione un role</option>
    		@foreach( $roles as $rol ) 
    			<option value="{{ $rol->id }}" {{ $rol->id == old('role_id') ? 'selected' : '' }}>{{ $rol->name }}</option>
    		@endforeach
    	</select>        
        @if ($errors->has('role_id'))  
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('role_id') }}</strong>
            </span>
        @endif                      
    </div>

    <div class="col-md-6 form-group {!! $errors->has('activo') ? 'has-error' : '' !!}">    
        <label>Activo</label>
        <input type="checkbox" value="1" name="activo" {{ old('activo', is_null($obj) ? 0 : ($obj->activo?1:0))==1 ? 'checked' : '' }}>
    </div>
