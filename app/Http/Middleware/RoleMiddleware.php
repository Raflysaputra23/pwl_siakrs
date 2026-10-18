<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();
        if(!in_array($user->role, $roles)) {
            return redirect()->guest(route("dashboard"))->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}
