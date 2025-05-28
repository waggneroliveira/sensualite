<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::sorting()->get();
        return view('admin.blades.notification.index', compact('notifications'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $notificationDuration = $request->duration * 86400; // 1 dia em segundos
        $data['duration'] = $notificationDuration;
        try {
            DB::beginTransaction();
                Notification::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com successo!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, Notification $notification)
    {
        $data = $request->all();
        $notificationDuration = $request->duration * 86400; // 1 dia em segundos
        $data['duration'] = $notificationDuration;
        try {
            DB::beginTransaction();
                $notification->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Item atualizado com successo!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        Session::flash('success', 'Item deletado com successo!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar', 'usuario.remover'])) {
            return view('admin.error.403');
        }
    
        foreach ($request->deleteAll as $userId) {
            $notification = Notification::find($userId);
    
            if ($notification) {
                // Log para verificar os dados do usuário
                \Log::info('Dados do usuário antes da exclusão:', [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'type' => $notification->type,
                ]);
    
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($notification)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $notification->id,
                            'title' => $notification->title,
                            'message' => $notification->message,
                            'type' => $notification->type,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $userId não encontrado.");
            }
        }
    
        $deleted = Notification::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '. 'Itens deletados.']);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $notification = Notification::find($id);
    
            if($notification) {
                $notification->sorting = $sorting;
                $notification->save();

                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($notification)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'title' => $notification->title,
                            'sorting' => $sorting,
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
