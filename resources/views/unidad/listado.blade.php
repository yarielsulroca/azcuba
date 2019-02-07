@extends('layouts.app')

@section('content')
    @if( count($tipos) >0 )
        <div class="row">
            <div class="col-md-12">
                <div class="padding">              
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Unidades</h2>      
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="/unidades/crear" class="btn btn-primary">Crear</a>
                        </div>
                    </div>  

                    <form class="form-inline padding">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="criteria" class="form-control" value="{{ Request::get('criteria') }}">
                                <select name="cai_id" class="form-control">
                                    <option></option>
                                    @foreach( $cais as $cai ) <option value="{{ $cai->id }}" {{ Request::get('cai_id')==$cai->id ? 'selected' : '' }}>{{ $cai->nombre }}</option> @endforeach
                                </select>
                                <select name="tipo_id" class="form-control">
                                    <option></option>
                                    @foreach( $tipos as $tipo ) <option value="{{ $tipo->id }}" {{ Request::get('tipo_id')==$tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option> @endforeach
                                </select>

                                <input type="submit" value="Buscar" class="btn btn-default" name="">
                            </div>
                        </div>
                    </form>
                    
                    <table class="table">
                        <thead>
                            <tr>                                        
                                <th>UNIDAD</th>
                                <th>CAI</th>
                                <th>TIPO</th>
                                <th width="30"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $unidades as $unidad )
                                <tr>                                    
                                    <td><span>{!! $unidad->nombre !!}</span></td>          
                                    <td><span>{!! $unidad->cai->nombre !!}</span></td>          
                                    <td><span>{!! optional($unidad->tipo)->nombre !!}</span></td>          
                                    <td><a class="pull-right" href="{!! route('unidades.edit', $unidad) !!}">Editar</a></td>                                                          
                                </tr>
                            @endforeach
                        </tbody>
                    </table>        

                    {{ $unidades->render() }}           
                </div>
            </div>
        </div>
    @else
        <div class="padding">
            <div class="alert alert-warning" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>            
                No existen unidades en el sistema. Presione <a href="/unidades/crear">aqu&iacute;</a> para insertar uno
            </div>
        </div>
    @endif
@stop