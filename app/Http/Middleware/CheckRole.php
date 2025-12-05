<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Buat perbandingan case-insensitive
        $userRole = strtolower(trim(Auth::user()->role));
        $neededRole = strtolower(trim($role));

        if ($userRole !== $neededRole) {
            abort(403, 'ANDA TIDAK PUNYA AKSES KE HALAMAN INI!');
        }

        return $next($request);
    }
}
