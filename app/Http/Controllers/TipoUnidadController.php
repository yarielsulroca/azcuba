<?php

namespace App\Http\Controllers;

use App\Entidades\TipoUnidad;
use Illuminate\Http\Request;
use App\Http\Requests\{CrearEditarTipoUnidadRequest, BusquedaRequest };

class TipoUnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( BusquedaRequest $formulario )
    {
        return view('tipounidad.listado', ['tipos'=>TipoUnidad::filtrar( $formulario->all() )->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipounidad.crear', ['obj'=>null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarTipoUnidadRequest  $form
     * @return \Illuminate\Http\Response
     */
    public function store(CrearEditarTipoUnidadRequest $form)
    {
        (new TipoUnidad)->fill($form->all())->save();

        return redirect()->to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoUnidad $tipo_unidad)
    {
        return view('tipounidad.editar', ['obj'=>$tipo_unidad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarTipoUnidadRequest  $form
     * @param  \App\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function update(CrearEditarTipoUnidadRequest $form, TipoUnidad $tipo_unidad)
    {
        $tipo_unidad->fill( $form->all() );
        $tipo_unidad->save();

        return redirect()->route('tipo-unidad.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoUnidad  $tipoUnidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoUnidad $tipo_unidad)
    {
        $tipo_unidad->delete();

        return redirect()->to('/');
    }
}