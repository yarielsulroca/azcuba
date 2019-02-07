<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index() {
        // Mando a crear el backup
        try { 
            \Artisan::call('backup:run');
        }
        catch( \Exception $e ) {
        	//dd( $e );
            return redirect()->back();
            /*->withErrors(['error_aplicacion'=>'Error al crear el backup, contacte con el administrador.']);      */              
        } 
        
        return redirect()->back();
    }
}