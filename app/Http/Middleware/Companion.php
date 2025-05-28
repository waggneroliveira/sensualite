<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Companion
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('acompanhante')->check()) {
            return redirect()->route('admin.dashboard.companion.painel');
        }

        return $next($request);
    }
}
