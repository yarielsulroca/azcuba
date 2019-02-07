@extends('layouts.app')

@section('content')
	<h2>Crear medici&oacute;n</h2>
	<form action="/mediciones" class="form padding" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group {!! $errors->has('cai_id') ? 'has-error' : '' !!}">    
			    	<label>CAI</label>
			    	<select name="cai_id" class="form-control">
			    		@foreach( $cais as $cai ) 
			    			<option value="{{ $cai->id }}" {{ $cai->id == old('cai_id', is_null($obj) ? -1 : $obj->unidad->cai_id) ? 'selected' : '' }}>{{ $cai->nombre }}</option>
			    		@endforeach
			    	</select>        
			        @if ($errors->has('cai_id'))  
			            <span class="help-block">
			                <strong class="text-danger">{{ $errors->first('cai_id') }}</strong>
			            </span>
			        @endif                      
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group {!! $errors->has('mdb') ? 'has-error' : '' !!}">    
			    	<label>Fichero de accdb</label>
			    	<input type="file" name="mdb" class="form-control">
			    	       
			        @if ($errors->has('mdb'))  
			            <span class="help-block">
			                <strong class="text-danger">{{ $errors->first('mdb') }}</strong>
			            </span>
			        @endif                      
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group {!! $errors->has('id') ? 'has-error' : '' !!}">    
			    	<label>Fichero ID</label>
			    	<input type="file" name="id" class="form-control">
			    	       
			        @if ($errors->has('id'))  
			            <span class="help-block">
			                <strong class="text-danger">{{ $errors->first('id') }}</strong>
			            </span>
			        @endif                      
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group {!! $errors->has('ind') ? 'has-error' : '' !!}">    
			    	<label>Fichero ind</label>
			    	<input type="file" name="ind" class="form-control">
			    	       
			        @if ($errors->has('ind'))  
			            <span class="help-block">
			                <strong class="text-danger">{{ $errors->first('ind') }}</strong>
			            </span>
			        @endif                      
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group {!! $errors->has('map') ? 'has-error' : '' !!}">    
			    	<label>Fichero map</label>
			    	<input type="file" name="map" class="form-control">
			    	       
			        @if ($errors->has('map'))  
			            <span class="help-block">
			                <strong class="text-danger">{{ $errors->first('map') }}</strong>
			            </span>
			        @endif                      
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group {!! $errors->has('tab') ? 'has-error' : '' !!}">    
			    	<label>Fichero tab</label>
			    	<input type="file" name="tab" class="form-control">
			    	       
			        @if ($errors->has('tab'))  
			            <span class="help-block">
			                <strong class="text-danger">{{ $errors->first('tab') }}</strong>
			            </span>
			        @endif                      
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">    
			    	<br>
			    	<input type="submit" value="Crear" class="btn btn-primary">       
				</div>

				<div class="form-group">    
				    			    	
				    	<a href="/tipo-unidad">Regresar a pantalla principal de mediciones</a>
				    
				</div>
			</div>
		</div>
	</form>
@stop