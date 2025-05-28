<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Companion;
use App\Models\UserBlock;
use Illuminate\Support\Str;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\UserBlockService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class ChatController extends Controller
{
    protected $pathUpload = 'admin/uploads/imagesUnic/companion/';

    protected $userBlockService;

    public function __construct(UserBlockService $userBlockService)
    {
        $this->userBlockService = $userBlockService;
    }

    public function blockClient(Request $request)
    {
        $result = $this->userBlockService->blockUserClient($request->blocked_id, $request->blocker_id);
        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }
    public function blockCompanion(Request $request)
    {
        $result = $this->userBlockService->blockUserCompanion($request->blocked_id, $request->blocker_id);
        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    //Desbloquear usuário
    public function desblockUser(UserBlock $userblock)
    {
        if (!$userblock) {
            return redirect()->back()->with('error', 'Bloqueio não encontrado.');
        }

        $userblock->delete();
        
        return redirect()->back()->with('success', 'Usuário desbloqueado com sucesso!');
    }
    
    // Cliente inicia a conversa com a acompanhante
    public function startConversation(Request $request)
    {
        $request->validate([
            'companion_id' => 'required|exists:companions,id',
        ]);

        $clientId = Auth::guard('cliente')->id();

        if (!$clientId) {
            return redirect()->back()->with('error', 'Apenas clients podem iniciar conversas.');
        }
        try {
            DB::beginTransaction();
                $conversation = Conversation::firstOrCreate([
                    'client_id' => $clientId,
                    'companion_id' => $request->companion_id,
                    'hash' => Str::uuid(),
                ]);
            DB::commit();

            $conversation = Conversation::findOrFail($conversation->id);
            $clientActive = Auth::guard('cliente')->user()->active;
    
            if ($clientActive !== 1) {
                return redirect()->back()->with('error', 'Usuário inativo ou inexistente.');
            }if($conversation->restrict !== 0){
                return redirect()->back()->with('error', 'Você não pode mandar mensagem para esta pessoa.');
            }else{
                try {
                    DB::beginTransaction();
                        Message::create([
                            'conversation_id' => $conversation->id,
                            'sender_id' => $conversation->id,
                            'message' => $request->message,
                            'sender_type' => 'cliente',
                        ]);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Você não pode mandar mensagem para esta pessoa.');
                }
            }
    
            return redirect()->route('admin.dashboard.client.chat', ['conversationId' => $conversation->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Você não pode mandar mensagem para esta pessoa.');
        }
    }

    // Cliente e acompanhante podem enviar mensagens
    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Encontrar a conversa
        $conversation = Conversation::findOrFail($conversationId);

        // Identificar o remetente
        if (Auth::guard('cliente')->check()) {
            $senderId = Auth::guard('cliente')->id();
            $senderType = 'cliente';
            $receiverId = $conversation->companion->id;
            $receiverType = 'acompanhante';
        } else {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }

        // Verifica se o ACOMPANHANTE BLOQUEOU O CLIENTE
        $blockedByReceiver = UserBlock::where('blocker_id', $receiverId)
            ->where('blocker_type', $receiverType)
            ->where('blocked_id', $senderId)
            ->where('blocked_type', $senderType)
            ->exists();

        if ($blockedByReceiver) {
            return redirect()->back()->with('error', 'Você não pode enviar mensagem para este usuário.');
        }

        // 2. Verifica se o CLIENTE BLOQUEOU O ACOMPANHANTE
        $blockedBySender = UserBlock::where('blocker_id', $senderId)
            ->where('blocker_type', $senderType)
            ->where('blocked_id', $receiverId)
            ->where('blocked_type', $receiverType)
            ->exists();

        if ($blockedBySender) {
            return redirect()->back()->with('error', 'Desbloqueie este usuário para permitir o envio de mensagens.');
        }

        // Criar a mensagem
        Message::create([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'message' => $request->message,
            'sender_type' => $senderType,
        ]);
    
        return redirect()->route('admin.dashboard.client.chat', ['conversationId' => $conversationId]);
    }

    public function filterConversationsClient(Request $request)
    {
        $search = $request->input('conversation_client');

        $authUserId = Auth::guard('cliente')->id();
        
        $conversations = Conversation::with('companion')
            ->whereHas('companion', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->where('client_id', $authUserId)
            ->get();

        foreach ($conversations as $conversation) {
            $conversation->lastMessage = $conversation->messages->first();
        }
        // Identificar o remetente
        if (Auth::guard('cliente')->check()) {
            $senderId = Auth::guard('cliente')->id();
            $senderType = 'cliente';
            $receiverType = 'acompanhante';
        } else {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }
    
        // Verificar se o remetente bloqueou o destinatário
        $userblock = UserBlock::leftJoin('companions', 'user_blocks.blocked_id', '=', 'companions.id')
        ->leftJoin('clients', 'user_blocks.blocked_id', '=', 'clients.id')
        ->select([
            'user_blocks.id',
            'user_blocks.blocker_id',
            'user_blocks.blocker_type',
            'user_blocks.blocked_id',
            'user_blocks.blocked_type',
            'clients.id as clientId',
            'companions.id as companionsId',
        ])
        ->where('user_blocks.blocker_id', $senderId)
        ->where('user_blocks.blocker_type', '<>', $receiverType)
        ->first();
        
        return view('admin.chat-client-list', compact('conversations', 'userblock', 'authUserId'));
    }
 
    public function sendMessageCompanion(Request $request, $conversationId)
    {
        $data = $request->except('is_one_time_view');
        $helper = new HelperArchive();
        
        $request->validate([
            'message' => ['nullable','string'],
            'is_one_time_view' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif,svg,jfif'],
        ]);
        
        $is_one_time_view = null;

        if ($request->hasFile('is_one_time_view')) {
            $is_one_time_view = $helper->renameArchiveUpload($request, 'is_one_time_view');
        }
        if ($is_one_time_view) {
            $data['is_one_time_view'] = $this->pathUpload . $is_one_time_view;
        }
 
        // Encontrar a conversa
        $conversation = Conversation::findOrFail($conversationId);

        // Identificar o remetente
        if (Auth::guard('acompanhante')->check()) {
            $senderId = Auth::guard('acompanhante')->id();
            $senderType = 'acompanhante';
            $receiverId = $conversation->client->id;
            $receiverType = 'cliente';
        } else {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }

        // 1. Verifica se o CLIENTE BLOQUEOU A ACOMPANHANTE
        $blockedByReceiver = UserBlock::where('blocker_id', $receiverId)
            ->where('blocker_type', $receiverType)
            ->where('blocked_id', $senderId)
            ->where('blocked_type', $senderType)
            ->exists();

        if ($blockedByReceiver) {
            return redirect()->back()->with('error', 'Você não pode enviar mensagem para este usuário.');
        }

        // 2. Verifica se a ACOMPANHANTE BLOQUEOU O CLIENTE
        $blockedBySender = UserBlock::where('blocker_id', $senderId)
            ->where('blocker_type', $senderType)
            ->where('blocked_id', $receiverId)
            ->where('blocked_type', $receiverType)
            ->exists();

        if ($blockedBySender) {
            return redirect()->back()->with('error', 'Desbloqueie este usuário para permitir o envio de mensagens.');
        }

        // Criar a mensagem
         Message::create([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'message' => $request->message ?? '[image]',
            'sender_type' => $senderType,
            'is_one_time_view' => isset($is_one_time_view) ? $this->pathUpload . $is_one_time_view : null,
        ]);

        if ($is_one_time_view) {
            $request->file('is_one_time_view')->storeAs($this->pathUpload, $is_one_time_view);
        }
        return redirect()->route('admin.dashboard.companion.chat', ['conversationId' => $conversationId]);
    }
    public function filterConversationsCompanion(Request $request)
    {
        $search = $request->input('conversation_companion');

        $authUserId = Auth::guard('acompanhante')->id();

        $conversations = Conversation::with('client')
            ->whereHas('client', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->where('companion_id', $authUserId)
            ->get();

        foreach ($conversations as $conversation) {
            $conversation->lastMessage = $conversation->messages->first();
        }
        // Identificar o remetente
        if (Auth::guard('acompanhante')->check()) {
            $senderId = Auth::guard('acompanhante')->id();
            $senderType = 'acompanhante';
            $receiverType = 'cliente';
        } else {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }
    
        // Verificar se o remetente bloqueou o destinatário
        $userblock = UserBlock::leftJoin('companions', 'user_blocks.blocked_id', '=', 'companions.id')
        ->leftJoin('clients', 'user_blocks.blocked_id', '=', 'clients.id')
        ->select([
            'user_blocks.id',
            'user_blocks.blocker_id',
            'user_blocks.blocker_type',
            'user_blocks.blocked_id',
            'user_blocks.blocked_type',
            'clients.id as clientId',
            'companions.id as companionsId',
        ])
        ->where('user_blocks.blocker_id', $senderId)
        ->where('user_blocks.blocker_type', '<>', $receiverType)
        ->first();
        
        return view('admin.chat-companion-list', compact('conversations', 'userblock', 'authUserId'));
    }
    public function getMessagesCompanion($conversationId)
    {
        $userType = 'acompanhante';

        // Identifica o usuário autenticado corretamente
        if (Auth::guard($userType)->check()) {
            $authUserId = Auth::guard($userType)->id();
            $authUserType = $userType;       
        } else {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }
       
        $companions = Companion::active()->get();
    
        // Obtém todas as conversas entre o cliente e seus acompanhantes
        $query = Conversation::with([
            'companion',
            'client',
            'messages' => function ($query) {
                $query->latest()->limit(1); // Obtém apenas a última mensagem
            }
        ]);
    
        // Filtra conforme o tipo de usuário autenticado
        
        if ($authUserType) {
            $query->where('companion_id', $authUserId)
            ->whereIn('client_id', $companions->pluck('id'));
        } 
    
        $conversations = $query->get();

        foreach ($conversations as $conversation) {
            $conversation->lastMessage = $conversation->messages->first();
        }
        
        // Busca a conversa específica
        $conversationUnique = Conversation::with(['companion', 'client', 'messages'])
            ->where('id', $conversationId)
            ->where(function ($query) use ($authUserType, $authUserId) {
                if ($authUserType) {
                    $query->where('companion_id', $authUserId);
                } 
            })
            ->first();
    
        if (!$conversationUnique) {
            return redirect()->back()->with('error', 'Conversa não encontrada.');
        }
    
        $conversationUnique->lastMessage = $conversationUnique->messages->last();
    
        // Define o outro usuário na conversa
        $blockedUser = $authUserType === 'acompanhante' ? $conversationUnique->client : $conversationUnique->companion;
        $blockedUser->blocked_type = $authUserType === 'acompanhante' ? 'cliente' : 'acompanhante';
    
        // Verifica bloqueios
        $userblock = UserBlock::where(function ($query) use ($authUserId) {
            $query->where('blocker_id', $authUserId)
                ->orWhere('blocked_id', $authUserId);
        })->first();
    
        return view('admin.chat-companion', compact('conversationUnique', 'conversations', 'blockedUser', 'userblock', 'authUserType', 'authUserId'));
    }
    

    // Client e acompanhante podem visualizar mensagens na conversa
    public function getMessages($conversationId)
    {
        $userType = 'cliente';

        // Identifica o usuário autenticado corretamente
        if (Auth::guard($userType)->check()) {
            $authUserId = Auth::guard($userType)->id();
            $authUserType = $userType;       
        } else {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }

        $companions = Companion::active()->get();
    
        // Obtém todas as conversas entre o cliente e seus acompanhantes
        $query = Conversation::with([
            'companion',
            'client',
            'messages' => function ($query) {
                $query->latest()->limit(1); // Obtém apenas a última mensagem
            }
        ]);
    
        // Filtra conforme o tipo de usuário autenticado        
        if ($authUserType) {
            $query->where('client_id', $authUserId)
                  ->whereIn('companion_id', $companions->pluck('id'));
        } 
        // else {
        //     $query->where('companion_id', $authUserId)
        //           ->whereIn('client_id', $companions->pluck('id'));
        // }
    
        $conversations = $query->get();
        // dd($userType, $authUserType, $conversations);
        foreach ($conversations as $conversation) {
            $conversation->lastMessage = $conversation->messages->first();
        }
    
        // Busca a conversa específica
        $conversationUnique = Conversation::with(['companion', 'client', 'messages'])
            ->where('id', $conversationId)
            ->where(function ($query) use ($authUserType, $authUserId) {
                if ($authUserType) {
                    $query->where('client_id', $authUserId);
                } 
                // else {
                //     $query->where('companion_id', $authUserId);
                // }
            })
            ->first();
    
        if (!$conversationUnique) {
            return redirect()->back()->with('error', 'Conversa não encontrada.');
        }
    
        $conversationUnique->lastMessage = $conversationUnique->messages->last();
    
        // Define o outro usuário na conversa
        $blockedUser = $authUserType === 'cliente' ? $conversationUnique->companion : $conversationUnique->client;
        $blockedUser->blocked_type = $authUserType === 'cliente' ? 'acompanhante' : 'cliente';
    
        // Verifica bloqueios
        $userblock = UserBlock::where(function ($query) use ($authUserId) {
            $query->where('blocker_id', $authUserId)
                ->orWhere('blocked_id', $authUserId);
        })->first();
    
        return view('admin.chat-client', compact('conversationUnique', 'conversations', 'blockedUser', 'userblock', 'authUserType', 'authUserId'));
    }
    
    

    // acompanhantes veem as conversas que foram iniciadas pelos clientes
    public function listConversations()
    {
        $userId = Auth::guard('acompanhante')->id();

        $userId = Auth::guard('cliente')->check() ? Auth::guard('cliente')->id() : Auth::guard('acompanhante')->id();
        $userType = Auth::guard('cliente')->check() ? 'cliente' : 'acompanhante';

        // Busca conversas, mas exclui aquelas onde o usuário foi bloqueado
        $conversations = Conversation::with('messages')
            ->whereDoesntHave('messages', function ($query) use ($userId, $userType) {
                $query->whereIn('sender_id', function ($subQuery) use ($userId, $userType) {
                    $subQuery->select('blocked_id')
                            ->from('user_blocks')
                            ->whereColumn('blocked_id', 'sender_id')
                            ->where('blocked_type', $userType)
                            ->where('blocker_id', $userId);
                });
            })
            ->get();

        return view('admin.chat-client', compact('conversations', 'conversation'));
    }

    public function showSecureImage($id)
    {
        $message = Message::findOrFail($id);

        if (!Auth::guard('cliente')->check()) {
            abort(403);
        }

        $filePath = storage_path('app/public/' . $message->is_one_time_view);

        if (!file_exists($filePath)) {
            abort(404);
        }

        // Cria response com headers que impedem cache
        $response = Response::file($filePath, [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT'
        ]);

        // Agendar exclusão após envio
        register_shutdown_function(function () use ($message, $filePath) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $message->update(['is_one_time_view' => null]);
        });

        return $response;
    }

}
