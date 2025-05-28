<?php

namespace App\Http\Controllers;

use App\Models\Subscribed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribedController extends Controller
{

    public function update(Request $request, Subscribed $subscribed)
    {
        
        $data = $request->only(['status']);
        $data['last_pagarme_webhook_at'] = now();
    
        try {
            DB::beginTransaction();
                $subscribed->fill($data)->save();
            DB::commit();
    
            session()->flash('success', 'Status atualizado com sucesso!');
            return redirect()->route('admin.companion.index');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao atualizar assinatura: ' . $e->getMessage());
    
            session()->flash('error', 'Erro ao atualizar assinatura!');
            return redirect()->back();
        }
    }
}
