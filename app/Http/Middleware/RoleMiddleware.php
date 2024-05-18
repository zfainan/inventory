<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roles = explode(',', $role);

        $jabatan = auth()->user()->petugas->jabatan;
        $granted = false;

        foreach ($roles as $value) {
            if ($jabatan === $value) {
                $granted = true;
                break;
            }
        }

        if (! $granted) {
            return abort(403, 'You don\'t have permission to access this feature.');
        }

        return $next($request);
    }
}
