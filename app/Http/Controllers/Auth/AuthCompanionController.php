<?php

namespace App\Http\Controllers\Auth;

use App\Models\Companion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthCompanionController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['active'] = 1;
        if (!Auth::guard('acompanhante')->attempt($credentials)) {
            
            $companion = Companion::where('email', $request->email)->first();
            if (!$companion || $companion->active != 1) {
                return back()->withErrors([
                    'email' => 'E-mail inválido ou usuário inativo.',
                ]);
            }
            
            if (!Hash::check($request->password, $companion->password)) {
                return back()->withErrors([
                    'password' => 'Senha inválida.',
                ]);
            }
        }
        
        $companionAuthenticate = Auth::guard('acompanhante')->user();
        $companion = Companion::find($companionAuthenticate->id);

        activity()
            ->causedBy(Auth::guard('acompanhante')->user())
            ->performedOn($companion)
            ->event('login-companion')
            ->withProperties([
                'attributes' => [
                    'id' => $companionAuthenticate->id,
                    'name' => $companionAuthenticate->name,
                    'email' => $companionAuthenticate->email,
                    'active' => $companionAuthenticate->active,
                    'event' => 'login-companion',
                ]
            ])
            ->log('login-companion');

        session()->flash('success', 'Login realizado com sucesso!');

        return redirect()->intended('acompanhante/dashboard');
    }

    public function logout(Request $request)
    {
        $companionAuthenticate = Auth::guard('acompanhante')->user(); 
        $companion = Companion::select('id','name','email')->find($companionAuthenticate->id);
        
        activity()
            ->causedBy($companionAuthenticate)
            ->performedOn($companion)
            ->event('logout-companion')
            ->withProperties([
                'attributes' => [
                    'id' => $companionAuthenticate->id,
                    'name' => $companionAuthenticate->name,
                    'email' => $companionAuthenticate->email,
                    'event' => 'logout-companion',
                ]
            ])
            ->log('logout-companion');

        Auth::guard('acompanhante')->logout();
        
        session()->flash('success', 'Logout realizado com sucesso!');
        return redirect()->route('admin.dashboard.companion.painel');
    }
}
