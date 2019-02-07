@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="padding">        
                <div class="row">
                    <!-- 
                        Filtro de cai y anno.
                    -->
                    <div class="col-md-6">
                        <h2>Mediciones</h2>      
                    </div>
                    
                </div>  
                <form>
                    <div class="row">   
                        <div class="col-md-4">
                            <div class="form-group">
                                <small>CAI</small>
                                <select class="form-control">
                                    <option value="0">[ TODAS ]</option>
                                    @foreach( $cais as $cai )
                                        <option value="{{ $cai->id }}">{{ $cai->codigo }} - {{ $cai->nombre }}</option> 
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <small>Estado</small>
                                <select class="form-control" name="estado_id">
                                    <option value="0">[ TODAS ]</option>
                                    @foreach( $estados as $estado )
                                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option> 
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <small>A&ntilde;o</small>
                                <input type="text" class="form-control" name="">
                            </div>  
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <small style="color: white;">.</small><br>
                                <input type="submit" class="btn btn-warning" value="Buscar">
                            </div>  
                        </div>

                        @hasrole('Usuario')
                        <div class="col-md-2 text-right">
                            <div class="form-group">
                                <small style="color: white;">.</small><br>
                                <a href="/mediciones/crear" class="btn btn-primary">Crear</a>
                            </div>
                        </div>
                        @endhasrole
                    </div>
                </form>
                @if( count($mediciones) >0 )
                    <table class="table">
                        <thead>
                            <tr>    
                                           
                                <th>CAI</th>
                                <th>UNIDAD</th>             
                                <th width="100">FECHA</th>
                                <th>ESTADO</th>
                                <th width="90"></th>
                                <th width="30"></th>                                
                                <th width="50"></th>       
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $mediciones as $medicion )
                                <tr>      
                                    <td>{!! $medicion->cai->nombre !!}</td>                                
                                    <td>{!! join(', ', $medicion->cai->unidades->pluck('nombre')->toArray()) !!}</td>    
                                    <td class="text-center">{!! $medicion->created_at !!}</td>     
                                    <td>{!! $medicion->estado->nombre !!}</td>
                                    <td>
                                        <a href="/medicion/{{ $medicion->id }}/descargar-ficheros">Descargar</a>
                                    </td>
                                    <td>                                        
                                        <a class="pull-right" href="/mediciones/{{$medicion->id}}">Mostrar</a>                                 
                                    </td>    
                                    <td>
                                        @if( !$medicion->estaRechazada() )
                                        <a href="/medicion/{{ $medicion->id }}/chat">Intercambio</a>
                                        @endif
                                    </td>                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>            
                @else        
                    <div class="padding">
                        <div class="alert alert-warning" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>            
                            No existen mediciones en el sistema. 
                            @hasrole('Usuario')
                                Presione <a href="{!! route('mediciones.create') !!}">aqu&iacute;</a> para insertar una
                            @endhasrole
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop