<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkUserType
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        if (Auth::check() && Auth::user()->getType() === $type) {
            return $next($request);
        }
        return back()->with('error', 'Vous n\'êtes pas habilité à accéder à cette page');

    }
}
