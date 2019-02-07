<?php

namespace App\Http\Controllers;

use App\Entidades\{Cai, Provincia, Municipio};
use Illuminate\Http\Request;
use \App\Http\Requests\{CrearEditarCaiRequest, BusquedaCaiRequest};

class CaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( BusquedaCaiRequest $formulario )
    {
        return view('cai.listado', [
            'cais'=>Cai::with(['municipio.provincia'])
                ->where('nombre', 'like', '%'.$formulario->criteria.'%')
                ->where('codigo', 'like', '%'.$formulario->codigo.'%')
                ->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincia = Provincia::findOrNew( old('provincia_id') );

        return view('cai.crear', [
            'obj'=>null,
            'provincias'=>Provincia::all(),
            'municipios'=>$provincia->municipios
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarTipoUnidadRequest  $form
     * @return \Illuminate\Http\Response
     */
    public function store(CrearEditarCaiRequest $form)
    {
        (new Cai)->fill($form->all())->save();

        return redirect()->to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Cai $cai)
    {
        $provincia_id = $cai->municipio->provincia_id;
        return view('cai.editar', [
            'obj'=>$cai,            
            'provincias'=>Provincia::all(),
            'provincia_id'=>$provincia_id,
            'municipios'=>Provincia::find( $provincia_id )->municipios
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarTipoUnidadRequest  $form
     * @param  \App\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function update(CrearEditarCaiRequest $form, Cai $cai)
    {
        $cai->fill( $form->all() );
        $cai->save();

        return redirect()->to('/cai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cai $cai)
    {
        $cai->delete();

        return redirect()->to('/cai');
    }

    /**
     * 
     */
    public function data( Provincia $provincia = null, Municipio $municipio = null ){
        return "";
    }
}