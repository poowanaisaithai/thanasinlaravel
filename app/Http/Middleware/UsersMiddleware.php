<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->check()){
            if (auth()->user()->role =='user'|| auth()->user()->role == 'admin'|| auth()->user()->role == 'supervisor'){
                return $next($request);

            }
        }
            return to_route('welcome');
    }
}
