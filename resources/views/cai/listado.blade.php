@extends('layouts.app')

@section('content')
    @if( count($cais) >0 )
        <div class="row">
            <div class="col-md-12">
                <div class="padding">              
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Cai</h2> 
                        </div>
                    </div>    

                    <form class="form-inline padding">  
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="criteria" placeholder="Criterio" class="form-control" value="{{ Request::get('criteria') }}">
                                <input type="text" name="codigo" placeholder="Codigo" class="form-control" value="{{ Request::get('codigo') }}">
                                
                                <input type="submit" value="Buscar" class="btn btn-default" name="">
                                 
                                <a href="/cai/crear" class="btn btn-primary pull-right">Crear</a>
                               
                            </div>
                        </div>
                    </form>
                         
                    <table class="table">
                        <thead>
                            <tr>                                        
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>PROVINCIA</th>
                                <th>MUNICIPIO</th>
                                <th width="30"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $cais as $cai )
                                <tr>                                    
                                    <td><span>{!! $cai->codigo !!}</span></td>          
                                    <td><span>{!! $cai->nombre !!}</span></td>          
                                    <td><span>{!! optional(optional($cai->municipio)->provincia)->nombre !!}</span></td>          
                                    <td><span>{!! optional($cai->municipio)->nombre !!}</span></td>          
                                    <td><a class="pull-right" href="{!! route('cai.edit', $cai) !!}">Editar</a></td>                                                          
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                 

                    {{ $cais->render() }}   
                </div>
            </div>
        </div>
    @else
        <div class="padding">
            <div class="alert alert-warning" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>            
                No existen cais en el sistema. Presione <a href="/cai/crear">aqu&iacute;</a> para insertar uno
            </div>
        </div>
    @endif
@stop