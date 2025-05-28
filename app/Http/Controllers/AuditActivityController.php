<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class AuditActivityController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('auditoria.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }

        $activities = Activity::with('causer')->orderBy('created_at', 'DESC')->get();

        return view('admin.blades.audit.index', [
            'activities' => $activities,
            'user' => $user,
        ]);
    }

    public function show(Activity $activitie)
    {
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('auditoria.visualizar')){
            return view('admin.error.403');
        }

        $modelName = $activitie->subject_type;
        return view('admin.blades.audit.show')->with([
            'activitie'=>$activitie,
            'modelName'=>$modelName
        ]);
    }

    public function markAsRead($id)
    {
        $auditoria = Activity::findOrFail($id);
        $auditoria->is_read = true;
        $auditoria->save();

        return response()->json(['status' => 'success']);
    }
    public function markAllAsRead()
    {
        // Obter o usuário autenticado
        $user = auth()->user();

        // Marcar todas as notificações como lidas
        $is_read = Activity::where('causer_id', $user->id)
            ->update(['is_read' => true]); // Atualize o campo correspondente que marca como lido

        if (!$is_read) {
            Activity::where('is_read', false)->update(['is_read' => true]);
        }
        return response()->json(['status' => 'success']);
    }
}
