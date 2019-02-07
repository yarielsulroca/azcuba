<?php
	namespace App\Servicios;

	use Illuminate\Contracts\Auth\Guard;
	use ZanySoft\Zip\Zip;
	use Illuminate\Support\Facades\Storage;
	use App\Entidades\{Medicion, Cai, Temporal};
	use Carbon\Carbon;
	use App\Extensiones\Trazeable;

	/**
	 * Clase que contiene todo lo referente a la subida de fichero de mapas de mapInfo
	 */
	class Mapa { 

		use Trazeable;

		protected $usuario;

		/**
		 * Constructor
		 */
		public function __construct( Guard $auth ) {
			$this->usuario = $auth->user();
		}

		/**
		 * Gestiona el proceso completo de subida de ficheros de mapInfo
		 * @param  array $request Datos del formulario
		 * @return void
		 */
		public function procesar( array $form, $cai_id ) { 
			$ficheros = guardarFicheros( $form, 'mapas' );
			$fichero_comprimido = comprimirFicheros( $ficheros, 'mapas' );

			$datos = $this->extraerInformacion( storage_path('app\\'.$ficheros['mdb']) );
			$this->insertarContenidoDeAccessEnDB( $datos );
			$this->procesarInformacionTemporal();
			
			$this->guardarMedicion($cai_id, $fichero_comprimido);
			eliminarFicheros( array_merge($ficheros, ['zip'=>$fichero_comprimido]) );
		}		

		protected function guardarMedicion( $cai_id, $fichero_comprimido ) {
			
			$medicion = (new Medicion)->fill([
				'estado_id'=>1, 
				'cai_id'=>$cai_id,
				'user_id'=>$this->usuario->id,
				'fichero'=>base64_encode(file_get_contents( storage_path('app\\'.$fichero_comprimido) ))
			]);
			
			$medicion->save();
			$medicion->recomendacion()->save( new Recomendacion(['comentario'=>'']) );

			$this->traza( sprintf('Creo un registro de medicion para el cai: %s', ''));
		}

		
		/**
		 * Abre y consulta la informacion del fichero access
		 * @param  string $fichero Camino en el hdd del fichero access que se quiere abrir.
		 * @throws Exception SI no tienes instalado el driver de ODBC para PHP
		 * @throws Exception SI el fichero pasado por parametro no existe o no se puede abrir por alguna razon.
		 * @return array
		 */
		protected function extraerInformacion( $fichero ) {

			$uname = explode(" ", php_uname());
			$os = $uname[0];
			
			if($os=='Windows') {
			    $driver = '{Microsoft Access Driver (*.mdb)}'; 
			}
			elseif($os=='Linux') { 
			    $driver = 'MDBTools';
			}
			else { 
			 	throw new Exception("No tienes instalado el driver odbc para el interprete de PHP.", 1);
			}

			$fuente = "odbc:Driver=$driver;DBQ=$fichero";

			$conexion = new \PDO( $fuente );
			$result = $conexion->query('select * from '.utf8_decode('caña'))->fetchAll( \PDO::FETCH_ASSOC ); // Esta por ver el nombre de la tabla.

			return $result;
		}		

		/**
		 * Inserta el contenido del fichero access en una tabla temporal de la bd.
		 * @param  array  $datos Datos a insertar
		 * @return void
		 */
		protected function insertarContenidoDeAccessEnDB( array $datos ) { 
			$final = [];
			
			// Preprocesamiento para los caracteres raros y demas.
			foreach ($datos as $value) {				
				$final[] = [
					"cod_empresa" => $value['COD_EMPRESA'],
				    "unidad" => $value['UNIDAD'],
				    "lote" => $value['LOTE'],
				    "bloque" => $value['BLOQUE'],
				    "campo" => $value['CAMPO'],
				    "area" => $value[utf8_decode('ÁREA')],
				    "area_guard" => $value['AREA_GUARD'],
				    "est_actual" => $value['EST_ACTUAL'],				    
				    "uso_actual" => utf8_encode($value['USO_ACTUAL']),
				    "uso_propue" => utf8_encode($value['USO_PROPUE']),
				    "tenedor" => utf8_encode($value['TENEDOR']),
				    "municipio" => utf8_encode($value['MUNICIPIO'])
				];
			}

			// Insertando toda la data temporal en la tabla az_medicion_temporal			
			Temporal::insert( $final );
		}

		/**
		 * Manda a ejecutar un procedimiento almacenado en la base de datos, que procesa toda la informacion
		 * de la tabla temporal de la base de datos.
		 * 
		 * @return bool
		 */
		protected function procesarInformacionTemporal() : bool {
			// Esto aqui . ( crear 2 implementaciones, con procedimiento y sin procedimiento.... no se que es mejor.... )
			// not yet la llamada, el proc ya esta. ! 
			// llamar al procecimiento

			$resultado = sprintf('CALL sp_procesar_informacion( %s )', $this->usuario->id);
			return false;
		}
		

		public function guardarRecomendacion ( Medicion $medicion, array $formulario ) { 
			$recomendacion = array_get('id', $formulario, 0)>0 
				? Recomendacion::find( array_get('id', $formulario) )
				: new Recomendacion(['user_id'=>$this->usuario->id]);

			$nombre_temporal = nombreAleatorio();
			file_put_contents($nombre_temporal, base64_decode( $medicion->recomendaciones->first()->fichero ));	
			$ficheros_actuales = extraerFichero( $nombre_temporal, 'recomendaciones');	
			
			$ficheros = guardarFicheros( $formulario->only('ficheros'), 'recomendaciones' );
			$fichero_comprimido = comprimirFicheros( $ficheros, 'recomendaciones' );
			$recomendacion->ficheros = base64_encode(file_get_contents( storage_path('app\\'.$fichero_comprimido) ));

			$medicion->recomendaciones()->save( $recomendacion );			
		}
	}