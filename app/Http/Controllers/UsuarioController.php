<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CrearEditarUsuarioRequest;
use App\Entidades\{User, Cai};
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuarios.listado', [
            'usuarios'=>User::with('roles')->paginate(20)            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cais = Cai::all();
        return view('usuarios.crear', [
            'roles'=>Role::all(),
            'cais'=>$cais->chunk( $cais->count() / 3 ),
            'obj'=>null            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarUsuarioRequest  $form
     * @return \Illuminate\Http\Response
     */
    public function store(CrearEditarUsuarioRequest $form)
    {
        $user = (new User)->fill($form->all());
        $user->password = bcrypt($user->password);
        // Asignacion de los cai(s)
        $user->save();
        $user->cais()->attach( $form->cai_id );
        $user->assignRole( \Spatie\Permission\Models\Role::find( $form->role_id ) );

        return redirect()->to('/usuario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return view('usuarios.editar', [
            'obj'=>$usuario, 
            'roles'=>Role::all(),
            'cais'=>Cai::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CrearEditarUsuarioRequest  $form
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearEditarUsuarioRequest $formulario, User $usuario)
    {
        $usuario->fill( $formulario->all() );
        $usuario->activo = $formulario->has('activo') ? true : false;
        $usuario->save();

        return redirect()->to('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->to('/usuario');
    }
}