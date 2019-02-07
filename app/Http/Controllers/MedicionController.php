<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\{Medicion, Cai, Provincia, Recomendacion, EstadoMedicion, FicheroRecomendacion, Chat};
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\{CrearMedicionRequest, SubirFicheroRecomendacion, ActualizarComentarioRequest, CrearLineaChatRequest, GuardarChatRequest, BuscarMedicionRequest};
use App\Servicios\Mapa;
use App\Exceptions\{RecomendacionException};
use App\Extensiones\Trazeable;

class MedicionController extends Controller
{
    use Trazeable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( BuscarMedicionRequest $formulario, Guard $auth )
    {       
        $user = $auth->user();

        $datos = [
            'estados'=>EstadoMedicion::all(),
            'provincias'=>Provincia::with('municipios')->get(),
            'cais'=> $user->cais,
            'mediciones'=>(new Medicion)->with(['cai'])
                                        ->PorUsuario( $user )
                                        ->PorCai( $formulario->cai_id )
                                        ->PorEstado( $formulario->estado_id )
                                        ->PorAnno()
                                        ->orderBy('created_at', 'desc')
                                        ->get()
        ];

        return view('mediciones.listado', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Guard $auth )
    {
        $datos = ['cais'=>$auth->user()->cais, 'obj'=>null];
        return view('mediciones.crear', $datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearMedicionRequest $form, Mapa $servicio)
    {
        $servicio->procesar( $form->except('cai_id', '_token'), $form->cai_id );

        return redirect()->route('recomendar');
    }

    public function descargarMedicion( Medicion $medicion ) {         
        return response()->streamDownload(function () use($medicion) {
            echo base64_decode( $medicion->fichero );
        }, 'medicion.zip');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Medicion $medicion )
    {
        $this->authorize('delete', $medicion);

        $medicion->remove();
        return redirec()->route('recomendar');
    }
    
    // En el mismo show, poner un tab para el chat.
    public function chat( Medicion $medicion, Guard $auth )  {
        $medicion->load('chat');
        $user_id = $auth->user()->id;
        return view('mediciones.chat.chat', [
            'medicion'=>$medicion,
            'puedeComentar'=>$medicion->recomendacion->user_id == $user_id || $user_id == $medicion->user_id || trim($medicion->recomendacion->comentario) == '' 
        ]);   
    }

    public function guardarChat( Medicion $medicion, GuardarChatRequest $formulario, Guard $auth ) {
        $medicion->chat()->save(new Chat([
            'comentario'=>$formulario->comentario,
            'user_id'=>$auth->user()->id
        ]));
        return redirect()->route('chat', ['medicion'=>$medicion]);
    }

    public function show( Medicion $medicione, Guard $auth  ) {        
        
        return view('mediciones.show', [
            'medicion'=>$medicione, 
            'puedeEliminarFicheros'=>$medicione->estaAprobada(),
            'tieneRecomendacion'=> !is_null($medicione->recomendacion),
            'puedeSubirRecomendacion'=>optional($medicione->recomendacion->ficheros)->count()<10,
            'soyElRecomendante'=> ($auth->user()->id == optional($medicione->recomendacion)->user_id),
        ]);
    }

    public function update( Medicion $medicione, ActualizarComentarioRequest $formulario, Guard $auth ) {     
       
        if( is_null($medicione->recomendacion) ) {
            $recomendacion = new Recomendacion(['user_id'=>$auth->user()->id, 'comentario'=>$formulario->comentario]);
            $recomendacion->save();
            $medicione->recomendacion()->associate($recomendacion);
        }
        else {
            $medicione->recomendacion->comentario = trim($formulario->comentario);
            $medicione->recomendacion->save();
        }

        return redirect()->to('mediciones/'.$medicione->id); //->route('mediciones.show', ['medicione'=>$medicion->id]);
    }

    public function subirFicheroRecomendacion( Medicion $medicion, subirFicheroRecomendacion $formulario ) {
        
        if( $medicion->recomendacion == null ) return redirect()->route('mediciones.show', $medicion);
        if( $medicion->recomendacion->ficheros->count()>=10 ) return redirect()->route('mediciones.show', $medicion);

        // guardar el file en la bd.
        $ficheros = guardarFicheros( $formulario->only(['fichero']), 'ficheros_recomendacion' );

        $fichero_comprimido = comprimirFicheros( $ficheros, 'ficheros_recomendacion' );

        $medicion->recomendacion->ficheros()->save(new FicheroRecomendacion([
            'nombre_fichero'=>$formulario->fichero->getClientOriginalName(), 
            'fichero'=>base64_encode(file_get_contents( storage_path('app\\'.$fichero_comprimido) ))
        ]));

        return redirect()->route('mediciones.show', ['medicione'=>$medicion]);
    }

    public function eliminarFicheroRecomendacion( FicheroRecomendacion $fichero ) { 
        $medicion = $fichero->recomendacion->medicion;
        $fichero->delete();

        return redirect()->route('mediciones.show', ['medicione'=>$medicion]);
    }

    public function descargarRecomendacion( FicheroRecomendacion $fichero ) { 

        return response()->streamDownload(function () use($fichero) {
            echo base64_decode( $fichero->fichero );
        }, $fichero->nombre_fichero.'.zip');
    }

    protected function puedeRecomendar( Medicion $medicion, Guard $auth ) {         
        if( $medicion->estado_id == 3 )
            return false;

        if( $medicion->recomendacion !=null && ($auth->user()->id != $medicion->recomendacion->user_id) )
            return false;

        return true;
    }

    public function aprobar( Medicion $medicion ) { 
        $medicion->estado_id = 2;
        $medicion->save();

        $this->traza('Ha aprobado la medicion del cai: '.$medicion->cai->nombre);

        return redirect()->to('mediciones/'.$medicion->id);
    }

    public function rechazar( Medicion $medicion ) { 
        $medicion->estado_id = 3;
        $medicion->save();

        $this->traza('Ha rechazado la medicion del cai: '.$medicion->cai->nombre);

        return redirect()->to('mediciones');
    }
}