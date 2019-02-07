<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CrearMedicionRequest;
use App\Servicios\Mapa;

class MapaController extends Controller
{
    function indice() {
    	// Mostrar formulario para subir los ficheros.
    	return view('mapa_subir_files');
    }

    /**
     * Procesa el formulario de los ficheros
     * @return [type] [description]
     */
    function subir( CrearMedicionRequest $request, Mapa $servicio ) {
    	// Mando a hacer el procesamiento del formulario dentro del servicio.
    	$servicio->procesar( $request );

    	return redirect()->to('mapa');
    }
}  