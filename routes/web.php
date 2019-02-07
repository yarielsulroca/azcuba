<?php

/**
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Auth::routes();

$router->group(['middleware' => ['auth']], function () use($router) {

	$router->get('/', 'HomeController@index')->name('home');

	$router->get('backup', ['as'=>'backup', 'uses'=>'BackupController@index']);	

	$router->group(['middleware' => ['role:Administrador']], function () use($router) {
		$router->resource('tipo-unidad', 'TipoUnidadController', ['except'=> ['show']]);
		$router->resource('municipios', 'MunicipioController', ['only'=> ['index']]);
		$router->resource('unidades', 'UnidadController', ['except'=> ['show']]);
		$router->resource('cai', 'CaiController', ['except'=> ['show']]);
		$router->resource('usuario', 'UsuarioController');
		$router->resource('trazas', 'TrazaController', ['only'=> ['index']]);
		$router->resource('periodos', 'PeriodoController', ['except'=>'show']);
	});
	
	$router->resource('mediciones', 'MedicionController', ['except'=>'edit']);
	
	$router->get('medicion/{medicion}/descargar-ficheros', ['as'=>'medicion.descarga', 'uses'=>'MedicionController@descargarMedicion']);


	$router->post('medicion/{medicion}/subir-fichero', ['as'=>'subirFicheroRecomendacion', 'uses'=>'MedicionController@subirFicheroRecomendacion']);
	$router->get('medicion/descargar-recomendaciones/{fichero}', ['as'=>'medicion.descarga.recomendacion', 'uses'=>'MedicionController@descargarRecomendacion']);
	$router->delete('eliminar-fichero-recomendacion/{fichero}', ['as'=>'eliminar.fichero.recomendacion', 'uses'=>'MedicionController@eliminarFicheroRecomendacion']);

	$router->get('provincia/{provincia}/municipios', ['as'=>'municipios', 'uses'=>'MunicipioController@porProvincia']);
	$router->get('provincia/{provincia?}/municipio/{municipio?}/cais', ['as'=>'cais', 'uses'=>'CaiController@data']);

	$router->get('medicion/{medicion}/chat', ['as'=>'chat', 'uses'=>'MedicionController@chat']);
	$router->post('medicion/{medicion}/chat', ['as'=>'chat.store', 'uses'=>'MedicionController@guardarChat']);

	$router->get('medicion/{medicion}/aprobar', ['as'=>'medicion.aprobar', 'uses'=>'MedicionController@aprobar']);
	$router->get('medicion/{medicion}/rechazar', ['as'=>'medicion.rechazar', 'uses'=>'MedicionController@rechazar']);
});



// Para reportes
// $router->get('estadistica-de-area', 'ReporteController@reporte1')