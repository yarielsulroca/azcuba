@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <t> Bienvenido al sistema digital para gestión de mapas del INICA del AZCUBA.</t>
                    <p>
                        Este es un sistema para el almacenamiento de mapas digitales, el cual le será de gran utilidad para el estudio, análisis y contenido de estos.
                    </p>
                    <img src="{!! asset('images/siembra.jpg') !!}">
                </div>
            </div>
        </div>
    </div>
@endsection
