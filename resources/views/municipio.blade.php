@extends('layouts.app')

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="padding">              
                <h2 class="float-left">Municipios</h2>      
                <form name="form">
                    <select name="provincia_id" onchange="this.form.submit()" class="form-control">
                        @foreach( $provincias as $prov ) 
                            <option value="{{ $prov->id }}" {{ app('request')->input('provincia_id') == $prov->id ? 'selected' : '' }}>{{ $prov->nombre }}</option>                      
                        @endforeach
                    </select>
                </form>

                <table class="table" style="margin-top: 40px;">
                    <thead>
                        <tr>                                        
                            <th>NOMBRE</th>
                            <th>PROVINCIA</th>                                                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $municipios as $municipio )
                            <tr>                                    
                                <td><span>{!! $municipio->nombre !!}</span></td>
                                <td><span>{!! $municipio->provincia->nombre !!}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                    
            </div>
        </div>
    </div>  
@stop