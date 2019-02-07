<div class="form-group {!! $errors->has('codigo') ? 'has-error' : '' !!}">    
    <label>Codigo</label>
    <input type="text" name="codigo" value="{!! old('codigo', is_null($obj) ? '' : $obj->codigo) !!}" class="form-control" maxlength="8">        
    @if ($errors->has('codigo'))  
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('codigo') }}</strong>
        </span>
    @endif                      
</div>

<div class="form-group {!! $errors->has('nombre') ? 'has-error' : '' !!}">      
	<label>Nombre</label>
	<input type="text" name="nombre" value="{!! old('nombre', is_null($obj) ? '' : $obj->nombre) !!}" class="form-control" maxlength="50">        
    @if ($errors->has('nombre'))  
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('nombre') }}</strong>
        </span>
    @endif                      
</div>

<div class="form-group {!! $errors->has('provincia_id') ? 'has-error' : '' !!}">    
	<label>Provincia</label>
	<select name="provincia_id" class="form-control" id="provincia_id">
		@foreach( $provincias as $prov ) 
			<option value="{{ $prov->id }}" {{ $prov->id == old('provincia_id', is_null($obj)?null:$obj->id) ? 'selected' : '' }}>
                {{ $prov->nombre }}
            </option>
		@endforeach
	</select>        
    @if ($errors->has('provincia_id'))  
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('provincia_id') }}</strong>
        </span>
    @endif                      
</div>

<div class="form-group {!! $errors->has('municipio_id') ? 'has-error' : '' !!}">    
	<label>Municipio</label> 
	<select name="municipio_id" class="form-control" id="municipio_id">
		@foreach( $municipios as $municipio ) 
			<option value="{{ $municipio->id }}" {{ $municipio->id == old('municipio_id', optional($obj)->municipio_id ) ? 'selected' : '' }}>{{ $municipio->nombre }}</option>
		@endforeach
	</select>  
    @if ($errors->has('municipio_id'))  
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('municipio_io') }}</strong>
        </span>
    @endif                      
</div>

@section('script')
    @@parent
    <script type="text/javascript">
        let _provincia = $('#provincia_id');
        let _municipio = $('#municipio_id');

        _provincia.on('change', cambioProvincia);

        function cambioProvincia (target) {
            _municipio.empty();
            $.get('/provincia/'+_provincia.val()+'/municipios').then(onMunicipios, onError);  
        }

        function onMunicipios (municipios) {
            for (municipio of municipios) {
                _municipio.append('<option value="'+municipio.id+'">'+municipio.nombre+'</option>');
            }
        }

        function onError() { }
    </script>
@stop