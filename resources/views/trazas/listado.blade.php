@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="padding">              
                <div class="row">
                    <div class="col-md-6">
                        <h2>Trazas</h2>      
                    </div>
                </div>  

                <form class="form-inline padding">  
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="criteria" placeholder="Criterio" class="form-control" value="{{ Request::get('criteria') }}">
                            
                            <select name="user_id" class="form-control">
                                <option></option>
                                @foreach( $users as $user ) <option value="{{ $user->id }}" {{ Request::get('user_id')==$user->id ? 'selected' : '' }}>{{ $user->name }}</option> @endforeach
                            </select>
                            
                            <input type="submit" value="Buscar" class="btn btn-warning  " name="">
                        </div>
                    </div>
                </form>
                
                <table class="table">
                    <thead>
                        <tr>                                        
                            <th>FECHA</th>
                            <th>TEXTO</th>
                            <th>USUARIO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $trazas as $traza )
                            <tr>                                    
                                <td><span>{!! $traza->created_at->format('Y-m-d H:i:s') !!}</span></td>          
                                <td><span>{!! $traza->texto !!}</span></td>          
                                <td><span>{!! $traza->usuario->name !!}</span></td>          
                            </tr>
                        @endforeach
                    </tbody>
                </table>        

                {{ $trazas->render() }}           
            </div>
        </div>
    </div>
@stop