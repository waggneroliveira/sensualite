<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CompanionRepository;

class SolicitationforGallery extends Controller
{
    public function index(){
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('ensaio.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }
        $solicitations = Gallery::with(['galleryFile', 'companion'])
        ->whereNotNull('requested_at')
        ->whereNull('approved_at')
        ->whereNull('rejected_at')
        ->where('status', 'pending')
        ->get();    

        return view('admin.blades.solicitation.index', compact('solicitations'));
    }

    public function approve($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->status = 'approved';
        $gallery->approved_at = now();
        $gallery->rejected_at = null;
        $gallery->rejection_reason = null;
        $gallery->save();

        return redirect()->route('admin.dashboard.galleryApprovalRequest')->with('success', 'Galeria aprovada.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $gallery = Gallery::findOrFail($id);
        $gallery->status = 'rejected';
        $gallery->rejected_at = now();
        $gallery->rejection_reason = $request->reason;
        $gallery->approved_at = null;
        $gallery->save();

        return redirect()->route('admin.dashboard.galleryApprovalRequest')->with('success', 'Galeria rejeitada.');
    }
}
