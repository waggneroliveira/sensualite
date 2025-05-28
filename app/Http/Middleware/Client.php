<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Client 
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('cliente')->check()) {
            return redirect()->route('admin.dashboard.client.painel');
        }

        return $next($request);
    }
}

