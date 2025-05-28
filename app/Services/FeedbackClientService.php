<?php
namespace App\Services;

use App\Repositories\FeedbackClientRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackClientService
{
    protected $feedbackRepository;

    public function __construct(FeedbackClientRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function saveFeedback($request)
    {
        if (!Auth::guard('cliente')->check()) {
            return [
                'status' => 'error',
                'message' => 'Faça o login para poder enviar o feedback.',
                'showLoginModal' => true
            ];
        }

        if (!$request->rating) {
            return [
                'status' => 'error',
                'message' => 'Não foi possível enviar o feedback. A avaliação é obrigatória.'
            ];
        }

        $clientId = Auth::guard('cliente')->user()->id;
        $data = $request->all();
        $data['companion_id'] = $request->id;
        $data['client_id'] = $clientId;

        try {
            DB::beginTransaction();
                $this->feedbackRepository->create($data);
            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Feedback enviado com sucesso!'
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'status' => 'error',
                'message' => 'Não foi possível enviar o feedback.'
            ];
        }
    }
}
