<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Entidades\{Traza, User};
    use App\Http\Requests\BusquedaTrazaRequest;

    class TrazaController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index( BusquedaTrazaRequest $formulario )
        {
            return view('trazas.listado', [
                'users'=>User::all(),
                'trazas'=>Traza::with('usuario')
                            ->where('texto', 'like', '%'.$formulario->criteria.'%')
                            ->when($formulario->user_id>0, function($query) use($formulario) { return $query->where('user_id', $formulario->user_id); } )
                            ->paginate(20)
            ]);
        }
    }