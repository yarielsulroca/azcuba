<?php

namespace App\Http\Controllers;

use App\Http\Requests\{SubirRecomendacion, CrearEditarUnidadRequest, BusquedaUnidadRequest};
use Illuminate\Http\Request;
use App\Entidades\{TipoUnidad, Unidad, Cai};

class UnidadController extends Controller
{
    /**
     * Guarda las recomendaciones para la unidad. 
     */ 
    public function guardarRecomendacion( SubirRecomendacion $formulario ) {
       $ruta = sprintf('unidades\\%s', $formulario->unidad_id);
       $fichero = sprintf('recomendacion-%s.%s', uniqid(), $formulario->fichero->extension());
       $formulario->fichero->storeAs($ruta, $fichero);

       return redirect()->to('/unidades');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( BusquedaUnidadRequest $formulario )
    {
        return view('unidad.listado', [
            'unidades'=>Unidad::porCai( $formulario->get('cai_id', -1) )->porTipo( $formulario->get('tipo_id', -1) )->with(['cai', 'tipo'])->where('nombre', 'like', '%'.$formulario->get('criteria', '').'%')->paginate(20),
            'tipos'=>TipoUnidad::all(),
            'cais'=>Cai::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidad.crear', [
            'obj'=>null,
            'tipos'=>TipoUnidad::all(),
            'cais'=>Cai::all()            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarUnidadRequest  $form
     * @return \Illuminate\Http\Response
     */
    public function store(CrearEditarUnidadRequest $form)
    {
        (new Unidad)->fill($form->all())->save();
        return redirect()->to('/unidades');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipUnidad  $unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidad $unidade)
    {
        return view('unidad.editar', [
            'obj'=>$unidade, 
            'tipos'=>TipoUnidad::orderBy('nombre')->get(), 
            'cais'=>Cai::orderBy('nombre')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarUnidadRequest  $form
     * @param  \App\Unidad  $Unidad
     * @return \Illuminate\Http\Response
     */
    public function update(CrearEditarUnidadRequest $form, Unidad $unidade)
    {
        $unidade->fill( $form->all() );
        $unidade->save();

        return redirect()->to('/unidades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidad  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidad $unidade)
    {
        $unidade->delete();

        return redirect()->to('/unidades');
    }
}