<?php

namespace App\Http\Controllers;

use App\Models\Liked;
use App\Models\Client;
use App\Models\Companion;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\FeedbackClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Helpers\HelperArchive;

class ClientController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/clientClient/';
    public function index(Request $request)
    {       
        $authUserType = Auth::guard('cliente')->check() ? 'cliente' : null;
 
        $companionId = $request->companionId;
        $clientId = Auth::guard('cliente')->user()->id;
        $companions = Companion::join('conversations', 'conversations.companion_id', 'companions.id')
        ->select([
            'companions.id',
            'companions.name',
            'companions.email',
            'companions.active',
            'companions.phone',
            'companions.go_out_with', 
            'companions.age', 
            'companions.type', 
            'companions.body_type', 
            'companions.height', 
            'companions.weight',
            'companions.shoe_size', 
            'companions.eye_color', 
            'companions.availability', 
            'companions.meeting_places', 
            'companions.path_file_profile', 
            'companions.path_file_horizontal_cover', 
            'companions.path_file_vertical_cover', 
            'companions.rate', 
            'companions.payment_methods', 
            'companions.available_for_travel',
            'conversations.client_id', 
            'conversations.companion_id',
            'conversations.id as conversationId'
        ])
        ->where('conversations.client_id', '=', $clientId)
        ->distinct()
        ->get();
        $feedbackClients = FeedbackClient::where('client_id', $clientId)->get();

        $likedByClients = [];

        $conversations = Conversation::where('client_id', $clientId)
        ->whereIn('companion_id', $companions->pluck('id'))
        ->pluck('companion_id')
        ->toArray();

        foreach ($companions as $companion) {
            // Verifica se o cliente já curtiu o acompanhante
            $likedByClients[$companion->id] = Liked::where('companion_id', $companion->id)
                ->where('client_id', $clientId)
                ->exists();
        }

        return view('admin.dashboard-client', compact('authUserType', 'companions', 'likedByClients', 'companionId', 'feedbackClients', 'conversations'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|min:8',
            'policy_term' => 'accepted',
        ]);

        try {
            DB::beginTransaction();
    
            $data = $request->all();

            $data['active'] = 1;
            $data['password'] = Hash::make($request->password);
            $data['policy_term'] = true;
    
            Client::create($data);
    
            DB::commit();
    
            Session::flash('success', 'Cadastro realizado com sucesso!');
            return redirect()->back();
            
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('error', 'Erro ao registrar cadastro!');
            return redirect()->back();
        }
    }
    
    
    public function edit(Client $client)
    {   
        return view('admin.blades.client.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->except('password','path_image');
        $helper = new HelperArchive();
        
        $request->validate([
            'path_image' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);

        $path_image = null;
        if ($request->hasFile('path_image')) {
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
        }

        try {
            DB::beginTransaction();
                if ($path_image) {
                    $data['path_image'] = $this->pathUpload . $path_image;
                    if ($client->path_image) { 
                        Storage::delete($client->path_image);
                    }
                    $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                }

                if (isset($request->delete_path_image) && !$path_image) {
                    if ($client->path_image) {
                        Storage::delete($client->path_image);
                    }
                    $data['path_image'] = null;
                }

                if ($request->filled('password')) {
                    $data['password'] = Hash::make($request->password);
                } else {
                    unset($data['password']);
                }

                $client->fill($data)->save();
            DB::commit();
            Session::flash('success','Cadastrado atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error','Erro ao atualizar cadastro!');
            return redirect()->back();
        }
    }

    public function destroy(Client $client)
    {
        Storage::delete(isset($client->path_image) ? $client->path_image : '');
        $client->delete();
        Session::flash('success','Item deletado com sucesso!');
        return redirect()->back();
    }
}
