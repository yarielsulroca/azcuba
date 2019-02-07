<?php

namespace App\Http\Controllers\Auth;

use App\Extensiones\Trazeable;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, Trazeable;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * El usuario ha sido autenticado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {       
        // OK, ahora veamos si este usuario esta activo o no.
        if( $user->activo == false ) {
            $this->traza( sprintf('El usuario %s intento ingresar al sistema aun estando inactiva su cuenta', $user->name ) );
            
            // Deslogeo al user.
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            

            return redirect()->back()
                             ->withInput($request->only($this->username(), 'remember'))
                             ->withErrors(['email'=>'El usuario esta en proceso de verificación; contacte con el administrador para m&aacute;s informaci&oacute;n.']);
        }
        
       $this->traza( sprintf('El usuario %s ingreso al sistema', $user->name) );
    }
}