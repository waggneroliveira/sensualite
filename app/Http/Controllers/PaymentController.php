<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Subscribed;
use Illuminate\Http\Request;
use App\Services\PagarmeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    protected PagarmeService $pagarmeService;

    public function __construct(PagarmeService $pagarmeService)
    {
        $this->pagarmeService = $pagarmeService;
    }

    public function createCheckout(Request $request)
    {
        $authUser = Auth::guard('acompanhante')->user()->id;
        $plan_id = $request->plan_id;

        $response = $this->pagarmeService->createPaymentLink($request, $authUser);
        
        if ($response->successful()) {

            try {
                DB::beginTransaction();
                    Subscribed::create([
                        'companion_id' => $authUser, 
                        'plan_id' => $plan_id,
                        'status' => 'pending',
                        'order_code' => $response['order_code']
                    ]);
                DB::commit();
            } catch (\Exception $e) {
                Session::flash('error','Não foi possível criar assinatura!');
                return redirect()->back();
            }
            $paymentLink = $response->json();
            return redirect($paymentLink['url']);
        } else {
            return back()->with('error', 'Erro ao criar o link de pagamento: ' . $response->body());
        }
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        $orderCode = $payload['data']['code'] ?? null;
        $status = $payload['data']['status'] ?? null;

        if (!$orderCode || !$status) {
            return response()->json(['error' => 'Dados incompletos'], 400);
        }

        // Verifica se existe no banco e atualiza status
        $assinatura = Subscribed::where('order_code', $orderCode)->first();

        if ($assinatura) {
            $assinatura->update([
                'status' => $status,    
                'last_pagarme_webhook_at' => now(),            
            ]);
        } else {
            return response()->json(['error' => 'Não foi possível encontrar a assinatura']);
        }

        return response()->json(['success' => true]);
    }    
}
