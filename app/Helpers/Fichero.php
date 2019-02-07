<?php

	use ZanySoft\Zip\Zip;
	use Carbon\Carbon;
	use Illuminate\Support\Facades\Storage;

	if( !function_exists('guardarFicheros')) { 
		/**
		 * Guarda en disco los ficheros subidos en el formulario
		 * @param  array $request Datos del formulario
		 * @param  string Nombre del directorio temporal donde se guardaran los files.
		 * @return string Fichero con extension .mdb subido
		 */
		function guardarFicheros( array $request, string $directorioTemporal = 'temporal' ) { 
			$ficheros = [];
			$fecha = uniqid( (new Carbon)->format('Ymd_His') );

			foreach( $request as $key=>$value ) {				
				$ficheros[$key] = $request[$key]->storeAs($directorioTemporal, sprintf('%s.%s',uniqid(strtotime('now')), $value->getClientOriginalExtension()));	
			}

			return $ficheros;
		}		
	}

	if( !function_exists('comprimirFicheros')) { 
		/**
		 * Crea un fichero comprimido con todos los ficheros subidos
		 * @param  array  $ficheros Listado de caminos de los distintos ficheros
		 * @param  string Nombre del directorio temporal donde se guardaran los files.
		 * @return string Camino del fichero comprimido
		 */
		function comprimirFicheros( array $ficheros, $directorioTemporal = 'temporal' ) {
			$fichero_comprimido = sprintf('%s\\', $directorioTemporal).uniqid(strtotime('now')).'.zip';
			
			$zip = Zip::create(storage_path('app\\'.$fichero_comprimido)); 
			
			foreach( $ficheros as $fichero ) {
				$zip->add( storage_path('app\\'.$fichero) );
			}

			$zip->close();

			return $fichero_comprimido;
		}
	}

	if( !function_exists('extraerFichero')) { 
		function extraerFichero($fichero, $directorioTemporal = 'temporal') {
			$zip = Zip::open($fichero);
			$zip->extract( $directorioTemporal );
			return $zip->listFiles();
		}
	}

	if( !function_exists('eliminarFicheros')) { 
		/**
		 * Elimina un listado de archivos dado
		 * @param  array  $ficheros Ficheros a eliminar
		 * @return void
		 */
		function eliminarFicheros( array $ficheros ) {
			Storage::delete( $ficheros );
		}
	}

	// if( !function_exists('eliminarFicheros')) { 
	// 	function nombreAleatorio () { 
	// 		return uniqid( (new Carbon)->format('Ymd_His') );
	// 	}
	// }
