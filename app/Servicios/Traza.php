<?php

	namespace App\Servicios;

	use App\Entidades\User;
	use App\Entidades\Traza as TrazaModelo;
	
	class Traza {
		/**
		 * Escribe una traza en el sistema
		 *
		 * @param string $texto
		 * @param User   $user		 
		 * @return void
		 */
	    public static function escribir( $texto, User $user = null  ) {
			try { 
				(new TrazaModelo)->fill(['texto'=>$texto, 'user_id'=>is_null($user)?:$user->id])->save();			
			}
			catch( Exception $e ) {
				\Log::error('No se pudo guardar la traza debido a un error: '.$e->getMessage());
			}
		}
	}