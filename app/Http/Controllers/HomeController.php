<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = [ 'nombre'=>'12345678' ];
        return view('home', $a);

        //$pdf = \PDF::loadView('home', $a);
        //return $pdf->download('nombre.pdf');
    }

    function a () {
        return 'el reporte';
    }
}