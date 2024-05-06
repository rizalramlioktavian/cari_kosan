<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userRole): Response
    {
        if(Auth::user()->role == $userRole){
            return $next($request);
        }

        // return response()->json(['Maaf anda tidak memiliki akses untuk melakukan aksi ini', 403]);
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('home');
        }
    }
}
