<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CredentialPagarme;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CredentialPagarmeController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('pagarme.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }
        $credentialPagarme = CredentialPagarme::first();

        return view('admin.blades.configPayment.index', compact('credentialPagarme'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                CredentialPagarme::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, CredentialPagarme $credentialPagarme)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
                if (!$request->filled('api_key')) {
                    unset($data['api_key']);
                }
                $credentialPagarme->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Item atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(CredentialPagarme $credentialPagarme)
    {
        //
    }
}
