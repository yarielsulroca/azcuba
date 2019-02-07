@extends('layouts.app')

@section('content')
    
        <div class="row">
            <div class="col-md-12">
                <div class="padding">        
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Tipos de unidad</h2>      
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{!! route('tipo-unidad.create') !!}" class="btn btn-primary">Crear</a>
                        </div>
                    </div>  
                    <div class="row">   
                        <div class="col-md-12">
                            <form>
                                <div class="input-group">
                                  <input type="text" class="form-control" name="criteria" value="{{ old('criteria', Request::get('criteria')) }}" placeholder="Buscar por...">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Buscar</button>
                                  </span>
                                </div><!-- /input-group -->
                            </form>
                        </div>
                    </div>
                    @if( count($tipos) >0 )
                    <table class="table">
                        <thead>
                            <tr>                                        
                                <th>NOMBRE</th>
                                <th width="30"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $tipos as $tipo )
                                <tr>                                    
                                    <td><span>{!! $tipo->nombre !!}</span></td>          
                                    <td><a class="pull-right" href="{!! route('tipo-unidad.edit', $tipo) !!}">Editar</a></td>                                                          
                                </tr>
                            @endforeach
                        </tbody>
                    </table>            
                    @else        
                        <div class="padding">
                            <div class="alert alert-warning" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>            
                                No existen tipos de unidad en el sistema. Presione <a href="{!! route('tipo-unidad.create') !!}">aqu&iacute;</a> para insertar uno
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
   
        
   
@stop