<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        if (auth()->check()){
            $user = DB::table('users as u')
                ->join('role_user as ru', 'u.id','=','ru.user_id')
                ->join('roles as r', 'r.id', '=', 'ru.role_id')
                ->where('u.id', Auth::user()->id)
                ->select('r.name as role')
                ->first();

            if ( auth()->check() && $user->role == "admin" ) {
                return $next($request);
            }
        }

        return redirect('/');

    }
}
