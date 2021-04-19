<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminPusatMiddleware
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
            $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();

            if ( auth()->check() && $user->userRole->role->role == 'AdminPusat' ) {
                return $next($request);
            }

            return redirect('login')->with('status', [
                'enabled' => true,
                'type' => 'danger',
                'content' => 'Tidak boleh mengakses'
            ]);
        }
    }
}
