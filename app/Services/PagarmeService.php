<?php

namespace App\Services;

use App\Models\CredentialPagarme;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PagarmeService
{
    protected string $apiUrl;
    protected string $apiKey;
    protected string $apiUrlGetStatus;

    public function __construct()
    {
        $credentialPagarme = CredentialPagarme::first();

        $this->apiUrl = $credentialPagarme->api_url_payment_link;
        $this->apiKey = $credentialPagarme->api_key;
        $this->apiUrlGetStatus = $credentialPagarme->api_url_get_payment_status;
    }

    public function createPaymentLink(Request $request, $user)
    {
        $apiKey = $this->apiKey;  
        $plan = Plan::findOrFail($request->plan_id);
        $user = Auth::guard('acompanhante')->user();
    
        $body = [
            'is_building' => false,
            'type' => 'order',
            'payment_settings' => [
                'accepted_payment_methods' => ['credit_card', 'pix'],
                'statement_descriptor' => 'Love Prive',
                'credit_card_settings' => [
                    'operation_type' => 'auth_and_capture',
                    'installments' => [
                        [
                            'number' => 1,
                            'total' => (int) $plan->price * 100,
                        ]
                    ],
                ],
                'pix_settings' => [
                    'expires_in' => 86400,
                ],
                'customer_settings' => [
                    'customer' => [
                        'code' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'type' => 'individual',
                    ],
                ],
            ],
            'cart_settings' => [
                'shipping_cost' => 0,
                'items' => [
                    [
                        'name' => 'Plano ' . $plan->name,
                        'amount' => (int) $plan->price * 100,
                        'description' => $plan->description,
                        'quantity' => 1,
                        'default_quantity' => 1,
                    ]
                ],
            ]
        ];
    
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($apiKey . ':'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, $body);
    
        return $response;
    }
    
    public function getPaymentStatus($orderCode)
    {
        $apiKey = $this->apiKey;
        
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($apiKey . ':'),
            'Accept' => 'application/json',
        ])->get("{$this->apiUrlGetStatus}/{$orderCode}");
        
        if ($response->successful()) {
            $order = $response->json();
    
            return [
                'status' => $order['status'], 
                'order_id' => $order['id'],
                'amount' => $order['amount'] / 100, 
                'created_at' => $order['created_at'],
                'charges' => $order['charges'],
            ];
        }
    
        return [
            'error' => true,
            'status_code' => $response->status(),
            'message' => $response->body(),
        ];
    }
    
}
