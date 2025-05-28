<?php

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthClientController extends Controller
{
    public function authenticate(Request $request)
    {        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'clientPage' => 'required|string',
        ]);
    
        $key = 'login-attempts:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) { // Limita 5 tentativas
            throw ValidationException::withMessages([
                'email' => 'Muitas tentativas de login. Tente novamente em alguns minutos.'
            ]);
        }
    
        if (!Auth::guard('cliente')->attempt($request->only('email', 'password') + ['active' => 1])) {
            RateLimiter::hit($key, 60); // Bloqueia por 60 segundos
            return back()->withErrors(['email' => 'Credenciais inválidas.'])->onlyInput('email');
        }
    
        RateLimiter::clear($key); // Reseta contagem após login bem-sucedido     

        $clientAuthenticate = Auth::guard('cliente')->user();
        $client = Client::find($clientAuthenticate->id);

        activity()
            ->causedBy(Auth::guard('cliente')->user())
            ->performedOn($client)
            ->event('login-client')
            ->withProperties([
                'attributes' => [
                    'id' => $clientAuthenticate->id,
                    'name' => $clientAuthenticate->name,
                    'email' => $clientAuthenticate->email,
                    'active' => $clientAuthenticate->active,
                    'event' => 'login-client',
                ]
            ])
            ->log('login-client');

        session()->flash('success', 'Login realizado com sucesso!');

        // Verifica se o login veio da página do cliente (site público)
        if ($request->clientPage === 'true') {
            return redirect()->back()->with('success', 'Login realizado com sucesso!');
        }
        // Se não for do site público, redireciona para o painel do cliente
        return redirect()->intended('cliente/dashboard');
    }



    public function logout(Request $request)
    {
        $clientAuthenticate = Auth::guard('cliente')->user(); 
        $client = Client::select('id','name','email')->find($clientAuthenticate->id);
        
        activity()
            ->causedBy($clientAuthenticate)
            ->performedOn($client)
            ->event('logout-client')
            ->withProperties([
                'attributes' => [
                    'id' => $clientAuthenticate->id,
                    'name' => $clientAuthenticate->name,
                    'email' => $clientAuthenticate->email,
                    'event' => 'logout-client',
                ]
            ])
            ->log('logout-client');

        Auth::guard('cliente')->logout();
        
        session()->flash('success', 'Logout realizado com sucesso!');
        return redirect()->route('admin.dashboard.client.painel');
    }

    public function logoutClient(Request $request){
        $clientAuthenticate = Auth::guard('cliente')->user(); 

        Auth::guard('cliente')->logout();

        return redirect()->back();
    }
}
