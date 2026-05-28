<?php

namespace App\Http\Middleware;
namespace App\Http\Controllers\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //   dd(auth()->user());
         if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (auth()->user()->role != 'admin') {
            abort(403,'Admin only');
        }

        return $next($request);

        //  if(
        //     auth()->check()

        //     &&

        //     auth()->user()->role=='admin'
        // )
        // {
        //     return $next($request);
        // }

        // abort(403);

    }
    }