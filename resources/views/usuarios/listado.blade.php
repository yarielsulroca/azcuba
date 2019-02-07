@extends('layouts.app')

@section('content')  
    <div class="row">
        <div class="col-md-12">
            <div class="padding">              
                <div class="row">
                    <div class="col-md-6">
                        <h2>Usuarios</h2>      
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/usuario/crear" class="btn btn-primary">Crear</a>
                    </div>
                </div>  
                
                {{ $usuarios->render() }}           
                
                <table class="table">
                    <thead>
                        <tr>                                        
                            <th>NOMBRE</th>
                            <th>EMAIL</th>             
                            <th>ROL</th>             
                            <th width="30"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $usuarios as $usuario )
                            <tr>                                    
                                <td><span>{!! $usuario->name !!}</span></td>          
                                <td><span>{!! $usuario->email !!}</span></td>                                          
                                <td><span>{!! optional($usuario->roles->first())->name !!}</span></td>                                          
                                <td><a class="pull-right" href="{!! route('usuario.edit', $usuario) !!}">Editar</a></td>                                                          
                            </tr>
                        @endforeach
                    </tbody>
                </table>        

                {{ $usuarios->render() }}           
                
            </div>
        </div>
    </div>   
@stop