<?php

    namespace App\Http\Middleware;

    use Closure;

    class RoleMiddleware
    {
        public function handle($request, Closure $next, $roles)
        {
            if (\Auth::guest())     {
                return redirect( '/ingresar' );
            }
            
            if (! $request->user()->hasAnyRole( explode('|', $roles) )) {
                abort(403);
            }
            
            /*if (! $request->user()->can($permission)) {
                abort(403);
            }*/

            return $next($request);
        }
    }