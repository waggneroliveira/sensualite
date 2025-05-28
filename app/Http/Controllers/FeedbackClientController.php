<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeedbackClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Services\SubscriptionStatusService;

class FeedbackClientController extends Controller
{
    public function index()
    {
        //Verifica assinatura antes de acessar a pagina
        $hasActiveSubscription = (new SubscriptionStatusService())->getExpiredSubscriptions();
        $isCourtesy = Auth::guard('acompanhante')->user()->is_courtesy;
        if (!$hasActiveSubscription && $isCourtesy == 0) {
            return abort(403, 'Sua assinatura está pendente. Atualize sua conta para continuar aproveitando nossos serviços. Caso já tenha realizado o pagamento, desconsidere esta mensagem. Assim que confirmado, seu acesso será restabelecido.');
        }
        $authfeedbackClient = Auth::guard('acompanhante')->user()->id;
        $feedbacks = FeedbackClient::where('companion_id', $authfeedbackClient)->sorting()->get();

        return view('admin.blades.feedback.index', compact('feedbacks'));
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, FeedbackClient $feedbackClient, $id)
    {
        try {
            DB::beginTransaction();
                $feedbackClient = FeedbackClient::find($id);
                $active = $request->active?1:0;
                $like = $request->like?1:0;

                $feedbackClient->update([
                    'response' => $request->input('response'),
                    'active' => $active,
                    'like' => $like,
                ]);

                DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }

    public function destroy(FeedbackClient $feedbackClient)
    {
        $feedbackClient->delete();

        Session::flash('success', 'Item deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        foreach ($request->deleteAll as $feedbackClientId) {
            $feedbackClient = FeedbackClient::find($feedbackClientId);

            if ($feedbackClient) {
                // Log para verificar os dados do usuário
                \Log::info('Dados do usuário antes da exclusão:', [
                    'id' => $feedbackClient->id,
                    'client_id' => $feedbackClient->client_id,
                    'client_id' => $feedbackClient->client_id,
                    'surname' => $feedbackClient->surname,
                    'message' => $feedbackClient->message,
                    'sorting' => $feedbackClient->sorting,
                    'rating' => $feedbackClient->rating,
                    'city' => $feedbackClient->city,
                ]);

                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($feedbackClient)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $feedbackClientId,
                            'client_id' => $feedbackClient->client_id,
                            'client_id' => $feedbackClient->client_id,
                            'surname' => $feedbackClient->surname,
                            'message' => $feedbackClient->message,
                            'sorting' => $feedbackClient->sorting,
                            'rating' => $feedbackClient->rating,
                            'city' => $feedbackClient->city,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $feedbackClientId não encontrado.");
            }
        }

        $deleted = FeedbackClient::whereIn('id', $request->deleteAll)->delete();

        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '. 'Itens deletados.']);
        }

        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $feedbackClient = FeedbackClient::find($id);

            if($feedbackClient) {
                $feedbackClient->sorting = $sorting;
                $feedbackClient->save();

                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($feedbackClient)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'client_id' => $feedbackClient->client_id,
                            'client_id' => $feedbackClient->client_id,
                            'surname' => $feedbackClient->surname,
                            'message' => $feedbackClient->message,
                            'sorting' => $feedbackClient->sorting,
                            'rating' => $feedbackClient->rating,
                            'city' => $feedbackClient->city,
                            'event' => 'order_updated',
                        ]
                    ])
                    ->log('order_updated');
            } else {
                \Log::warning("Item com ID $id não encontrado.");
            }
        }

        return Response::json(['status' => 'success']);
    }
}
