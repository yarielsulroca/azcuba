<?php

	namespace App\Extensiones;

	use App\Servicios\Traza;

	trait Trazeable { 
		
		/**
		 * Manda a escribir un texto de traza en la base de datos
		 * @param  string $texto Texto de la traza
		 * @return 
		 */
		public function	traza( $texto ) {
			Traza::escribir( $texto, \Auth::user() );
		}	
	}