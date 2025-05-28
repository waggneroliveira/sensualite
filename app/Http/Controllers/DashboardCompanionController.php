<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Follow;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCompanionController extends Controller
{
    public function index(){
        $authUserType = Auth::guard('acompanhante')->check() ? 'acompanhante' : null;

        $companionId = Auth::guard('acompanhante')->user()->id;
        $clients = Client::join('conversations', 'conversations.client_id', 'clients.id')
        ->select([
            'clients.id',
            'clients.name',
            'clients.email',
            'clients.active', 
            'conversations.id as conversationId',
            'conversations.client_id', 
            'conversations.companion_id as companionId',
        ])
        ->where('conversations.companion_id', '=', $companionId)
        ->distinct()
        ->get();
        
        $follows = Follow::where('companion_id', $companionId)
        ->get()
        ->groupBy('companion_id');

        $followCounts = Follow::where('companion_id', $companionId)
        ->get()
        ->groupBy('companion_id')
        ->map(fn($follows) => $follows->count());
        
        $latestGalleries = [
            'pending' => Gallery::where('status', 'pending')->latest()->first(),
            'approved' => Gallery::where('status', 'approved')->latest()->first(),
        ];

        $pendingGallery = $latestGalleries['pending'];
        $approvedGallery = $latestGalleries['approved'];                

        return view('admin.dashboard-companion', compact('clients','authUserType', 'follows', 'followCounts', 'pendingGallery', 'approvedGallery'));
    }
}
