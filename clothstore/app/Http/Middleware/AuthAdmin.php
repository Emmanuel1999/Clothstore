<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token =$request->header('ADMIN_KEY');
        if($token != 'qwertyuiop'){
            return response()->json([
                'message' => 'Admin Key is Missing!'
            ]);
        }
        return $next($request);
    }
}
