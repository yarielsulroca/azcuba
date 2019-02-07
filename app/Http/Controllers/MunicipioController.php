<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\{Municipio, Provincia};

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $form )
    {
        return view('municipio', [
        	'municipios'=>Municipio::porProvincia( $form->get('provincia_id', 1) )->with('provincia')->get(),
        	'provincias'=>Provincia::all()
        ]);
    }   

    public function porProvincia( Provincia $provincia ) {
        return $provincia->municipios;
    }
}