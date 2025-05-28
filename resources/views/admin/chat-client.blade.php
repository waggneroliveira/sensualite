@extends('admin.core.client')
@section('content')
    @php
        $name = Auth::guard('cliente')->user()->name;
        $email = Auth::guard('cliente')->user()->email;
        $imagePath = Auth::guard('cliente')->user()->path_image;
        
        if ($imagePath != null) {
            $imagePath = asset('storage/'.$imagePath);
        }else{
            $imagePath = asset('build/admin/images/userblock.png');
        }
    @endphp

    @include('admin.includes.header', [
        'titlePage' => 'Ensaios',
        'userName' => collect(explode(' ', Auth::guard('cliente')->user()->name))->slice(0, 2)->implode(' '),        
        'userEmail' => Auth::guard('cliente')->user()->email,
        'messages' => '',
        'messageCount' => '3',
        'notifications' => '',
        'notificationsCount' => '4',
        'logout' => route('admin.dashboard.client.logout'),
        'src' => $imagePath,
        'link' => '',
    ])
    <div class="geex-content__wrapper">
        <div class="geex-content__section-wrapper">
            <div class="geex-content__section geex-content__section--transparent geex-content__chat">
                <button class="geex-btn geex-content__chat__toggle">
                    <i class="uil-bars"></i> Chat List
                </button>

                <div class="geex-content__chat__sidebar">
                    <div class="geex-content__chat__sidebar__searchform w-100">
                        <div class="geex-content__chat__sidebar__searchform__search w-100">
                            <form action="" method="post">
                                @csrf
                                <input type="text" name="conversation_client" id="conversation_client" placeholder="Search" class="geex-content__header__btn" />
                                <i class="uil uil-search"></i>
                            </form>
                        </div>
                    </div>

                    <div id="conversation-list">
                        <ul class="nav nav-tabs geex-content__chat__sidebar__tab mb-20" role="tablist">
                            <span class="geex-content__chat__sidebar__tab__title">Meus Contatos</span>
                            @foreach ($conversations as $conversation)
                                <li class="nav-item" role="presentation">
                                    <a href="{{ route('admin.dashboard.client.chat', ['conversationId' => $conversation->id]) }}"
                                    class="{{ request()->routeIs('admin.dashboard.client.chat') && request('conversationId') == $conversation->id ? 'navi-link' : 'not-navi-link' }}">
                                        <div class="geex-chat-tab-single">
                                            <div class="geex-chat-tab-single__img rounded-circle overflow-hidden" style="width: 90px;height:60px;">
                                                @php
                                                    $clientId = $conversation->client->id;
                                                    $companionId = $conversation->companion->id;
                                                @endphp

                                                @if ($userblock && $userblock->blocked_id == $authUserId && $userblock->blocker_id == $conversation->companion->id)
                                                    <img src="{{ asset('build/admin/images/userblock.png') }}" class="userblock" alt="avatar" />
                                                @else
                                                    <img
                                                        src="{{ $conversation->companion->path_file_profile ? asset('storage/' . $conversation->companion->path_file_profile) : asset('build/admin/images/userblock.png') }}"
                                                        style="aspect-ratio: 1/1; object-fit: cover;"
                                                        alt="{{ $conversation->companion->name }}"
                                                    />
                                                @endif
                                            </div>
                                            <div class="geex-chat-tab-single__content">
                                                <div class="geex-chat-tab-single__message">
                                                    @if (Auth::guard('cliente')->check())
                                                        <h4 class="geex-chat-tab-single__title">{{ $conversation->companion->name }}</h4>
                                                    @endif
                                                    <span class="geex-chat-tab-single__subtitle">
                                                        @if (!($userblock && $userblock->blocked_id == $authUserId && $userblock->blocker_id == $conversation->id))
                                                            {{ isset($conversation->lastMessage) ? substr(strip_tags($conversation->lastMessage->message), 0, 30) : '' }}...
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @if (isset($conversationUnique) && $conversationUnique !== null)
                    <div class="tab-content geex-content__chat__content">
                        <div class="tab-pane fade show active">
                            <div class="geex-content__chat__content">
                                <div class="geex-content__chat__header">
                                    <div class="geex-content__chat__header__img rounded-circle overflow-hidden" style="width: 75px;height:65px;">
                                        @php
                                            $clientId = $conversationUnique->client->id;
                                            $companionId = $conversationUnique->companion->id;

                                            $companionBlockedByClient = \App\Models\UserBlock::where('blocker_id', $companionId)
                                                ->where('blocker_type', 'acompanhante')
                                                ->where('blocked_id', $clientId)
                                                ->where('blocked_type', 'cliente')
                                                ->exists();
                                        @endphp

                                        @if (Auth::guard('cliente')->check() && $authUserType == 'cliente')
                                            @if (!$companionBlockedByClient)
                                                {{-- NÃO BLOQUEADO: mostra imagem da acompanhante --}}
                                                <img src="{{ $conversationUnique->companion->path_file_profile ? asset('storage/' . $conversationUnique->companion->path_file_profile) : asset('build/admin/images/userblock.png') }}" style="width: 90px; height: 80px; aspect-ratio: 1/1; object-fit: cover;" alt="{{ $conversationUnique->companion->name }}" />
                                            @else
                                                {{-- BLOQUEADO: mostra imagem bloqueada --}}
                                                <img src="{{ asset('build/admin/images/userblock.png') }}" style="width: 90px; height: 80px; aspect-ratio: 1/1; object-fit: cover;" alt="avatar" />
                                            @endif
                                        @endif
                                    </div>
                                    <div class="geex-content__chat__header__content">
                                        <div class="geex-content__chat__header__text">
                                            @if (Auth::guard('cliente')->check() && $authUserType == 'cliente')
                                                <h4 class="geex-content__chat__header__title">{{ $conversationUnique->companion->name }} </h4>                                                
                                            @endif
                                        </div>
                                        <ul class="geex-content__chat__header__filter">

                                            <li>
                                                <a href="#" class="geex-content__chat__header__filter__btn">
                                                    <i class="uil-ellipsis-v"></i>
                                                </a>
                                                <div class="geex-content__chat__header__filter__content">
                                                    <ul class="geex-content__chat__header__filter__content__list">

                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                            @php
                                                                $clientId = $conversationUnique->client->id;
                                                                $companionId = $conversationUnique->companion->id;
                                                            @endphp
                                                            
                                                            {{-- Verifica se a ACOMPANHANTE FOI BLOQUEADA pelo CLIENTE --}}
                                                            @php
                                                                $blockedByClient = \App\Models\UserBlock::where('blocker_id', $clientId)
                                                                    ->where('blocker_type', 'cliente')
                                                                    ->where('blocked_id', $companionId)
                                                                    ->where('blocked_type', 'acompanhante')
                                                                    ->first();
                                                            @endphp

                                                            {{-- Verifica se a ACOMPANHANTE BLOQUEOU o CLIENTE --}}
                                                            @php
                                                                $blockedByCompanion = \App\Models\UserBlock::where('blocker_id', $companionId)
                                                                    ->where('blocker_type', 'acompanhante')
                                                                    ->where('blocked_id', $clientId)
                                                                    ->where('blocked_type', 'cliente')
                                                                    ->first();
                                                            @endphp

                                                            @if ($blockedByCompanion)
                                                                <p class="text-danger">Você foi bloqueado(a) por este usuário.</p>
                                                            @else                                                               

                                                                @if ($blockedByClient)
                                                                    <form action="{{ route('admin.dashboard.chat.desblockUser', ['userblock' => $blockedByClient->id]) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" style="outline: none; box-shadow: none;" class="bt bg-transparent text-white">
                                                                            Desbloquear usuário
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ route('admin.dashboard.chat.blocked-client', ['blocked_id' => $companionId, 'blocker_id' => $clientId]) }}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" style="outline: none; box-shadow: none;" class="bt bg-transparent text-white">
                                                                            Bloquear usuário
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div id="chat-container" class="geex-content__chat__list">
                                    @if (!($userblock && $userblock->blocked_id == $authUserId && $userblock->blocker_id == $conversationUnique->id))                                        
                                        @foreach ($conversationUnique->messages as $message)  
                                            @php
                                                // Identifica quem está logado e define o tipo e ID
                                                if (Auth::guard('cliente')->check()) {
                                                    $loggedUserId = Auth::guard('cliente')->user()->id;
                                                    $loggedUserType = 'cliente';
                                                } else {
                                                    $loggedUserId = null;
                                                    $loggedUserType = null;
                                                }
                                                $lastMessageId = $conversationUnique->lastMessage->id ?? null;
                                            @endphp

                                            <div class="geex-content__chat__list__single 
                                                {{ isset($loggedUserId, $loggedUserType) && $message->sender_id === $loggedUserId && $message->sender_type === $loggedUserType ? 'active' : '' }}">

                                                @if (!$companionBlockedByClient)                                                    
                                                    <div class="geex-content__chat__list__single__img" style="height: 50px; width: 50px; overflow: hidden; border-radius: 18px;">
                                                        @if ($message->sender_type == 'acompanhante')
                                                            <img src="{{ $conversationUnique->companion->path_file_profile ? asset('storage/' . $conversationUnique->companion->path_file_profile) : asset('build/admin/images/userblock.png') }}" alt="avatar" />
                                                        @elseif ($message->sender_type == 'cliente')
                                                            <img src="{{ $imagePath }}" alt="avatar" />
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="geex-content__chat__list__single__img" style="height: 50px;width: 50px;overflow: hidden; border-radius: 18px;">
                                                        @if ($message->sender_type == 'acompanhante')
                                                                <img src="{{ asset('build/admin/images/userblock.png') }}" style="aspect-ratio: 1/1; object-fit: contain;" alt="avatar" />
                                                            @elseif ($message->sender_type == 'cliente')
                                                                <img src="{{ $imagePath }}" alt="avatar" />
                                                        @endif                                                        
                                                    </div>
                                                @endif

                                                
                                                <div class="geex-content__chat__list__single__text">
                                                    <span {{ $message->id == $lastMessageId ? 'id=end' : '' }}  class="geex-content__chat__list__single__msg {{ $message->id == $lastMessageId ? 'latest' : '' }}">
                                                        @if ($conversationUnique->lastMessage->message == '[image]' && $message->is_one_time_view != null)
                                                            <div id="message-temporary-{{$message->id}}" class="message-temporary text-start" data-id="{{$message->id}}">
                                                                <span title="Conteúdo temporário" style="font-size: 12px">⏳ Visualização única</span>  
                                                                <span class="image-false position-relative d-block m-auto mt-4"
                                                                    style="filter:blur(4px);width:198px;height:254px; background: rgba(255, 255, 255, 0.1);"></span>                                                              
                                                            </div>

                                                            {{-- Modal com imagem --}}
                                                            <div id="modal-temporary-{{$message->id}}" class="modal-temporary-image" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 9999; justify-content: center; align-items: center;">
                                                                <button class="modal-close" style="position: absolute; top: 20px; right: 20px; background: transparent; border: none; color: white; font-size: 2rem; cursor: pointer;">&times;</button>

                                                                <img data-src="{{ route('secure.image', ['id' => $message->id]) }}"
                                                                src=""
                                                                oncontextmenu="return false;"
                                                                draggable="false"
                                                                alt="Imagem temporária"
                                                                style="max-width: 90vw; max-height: 90vh; border-radius: 10px;">                                                                    
                                                            </div>                                                            
                                                        @endif 
                                                        @if($conversationUnique->lastMessage->message != '[image]' && $message->is_one_time_view != null)
                                                            {{ $message->message }}
                                                            <div id="message-temporary-{{$message->id}}" class="message-temporary text-start" data-id="{{$message->id}}">
                                                                <span title="Conteúdo temporário" style="font-size: 12px">⏳ Visualização única</span>  
                                                                <span class="image-false position-relative d-block m-auto mt-4"
                                                                    style="filter:blur(4px);width:198px;height:254px; background: rgba(255, 255, 255, 0.1);"></span>                                                              
                                                            </div>

                                                            {{-- Modal com imagem --}}
                                                            <div id="modal-temporary-{{$message->id}}" class="modal-temporary-image" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 9999; justify-content: center; align-items: center;">
                                                                <button class="modal-close" style="position: absolute; top: 20px; right: 20px; background: transparent; border: none; color: white; font-size: 2rem; cursor: pointer;">&times;</button>

                                                                <img data-src="{{ route('secure.image', ['id' => $message->id]) }}"
                                                                src=""
                                                                oncontextmenu="return false;"
                                                                draggable="false"
                                                                alt="Imagem temporária"
                                                                style="max-width: 90vw; max-height: 90vh; border-radius: 10px;">                                                                    
                                                            </div>
                                                            @else
                                                            {{ $message->message }}
                                                        @endif
                                                    </span>
                                                    <span class="hours">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                

                                <form action="{{ route('admin.dashboard.client.chat.send', ['conversationId' => $conversationUnique->id ]) }}" method="POST">
                                    @csrf
                                    <div class="geex-content__chat__send">
                                        <div class="geex-content__chat__send__input">
                                            <input placeholder="Type your message..." name="message" id="chat" required>
                                        </div>
                                        <div class="geex-content__chat__send__action">
        
                                            <button type="submit" class="btn-send">
                                                <i class="uil uil-message"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>                         

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Rolagem do chat ao recarregar página
        document.addEventListener('DOMContentLoaded', () => {
            const chatContainer = document.getElementById('chat-container');
            if (chatContainer) {
                // Garante que o scroll vá até o fim assim que o DOM estiver pronto
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        });

        // Evitar envio de formulário no enter
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('conversation_client');
            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        });
        //Pesquisa das conversas do cliente
        // $(document).ready(function () {
        //     $('#conversation_client').on('keyup', function () {
        //         let query = $(this).val();

        //         $.ajax({
        //             url: "{{ route('admin.conversations.client.filter') }}",
        //             type: "GET",
        //             data: {
        //                 conversation_client: query
        //             },
        //             success: function (data) {
        //                 $('#conversation-list').html(data);
        //             },
        //             error: function () {
        //                 console.error("Erro ao filtrar as conversas". data);
        //             }
        //         });
        //     });
        // });
        $(document).ready(function () {
    $('#conversation_client').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('admin.conversations.client.filter') }}",
            type: "GET",
            data: {
                conversation_client: query
            },
            success: function (data) {
                $('#conversation-list').html(data);
            },
            error: function (xhr) {
                if (xhr.status === 403) {
                    alert(xhr.responseJSON?.message || 'Conversa bloqueada. Desbloqueie para continuar.');
                } else {
                    console.error("Erro ao filtrar as conversas:", xhr);
                }
            }
        });
    });
});


        document.addEventListener("DOMContentLoaded", function () {
            // Seleciona todas as abas de conversa
            const chatTabs = document.querySelectorAll(".nav-link");
            
            chatTabs.forEach(tab => {
                tab.addEventListener("click", function (event) {
                    event.preventDefault();
                    
                    // Remove a classe 'active' de todas as abas
                    chatTabs.forEach(t => t.classList.remove("active"));
                    
                    // Adiciona a classe 'active' na aba clicada
                    this.classList.add("active");
                    
                    // Obtém o ID da aba clicada
                    const targetId = this.getAttribute("data-bs-target");
                    
                    // Esconde todos os conteúdos do chat
                    document.querySelectorAll(".tab-pane").forEach(content => {
                        content.classList.remove("show", "active");
                    });
                    
                    // Exibe o conteúdo do chat correspondente
                    document.querySelector(targetId).classList.add("show", "active");
                });
            });     
        });

        //Modal para imagem de visualização única
        document.addEventListener('DOMContentLoaded', () => {
            const temporaries = document.querySelectorAll('.message-temporary');

            temporaries.forEach(temp => {
                temp.addEventListener('click', function () {
                    const messageId = this.dataset.id;
                    const modal = document.getElementById(`modal-temporary-${messageId}`);

                    if (modal) {
                        const img = modal.querySelector('img');
                        if (img) {
                            img.src = img.dataset.src; // define o src dinamicamente
                        }

                        modal.style.display = 'flex';
                    }
                });
            });

            const modals = document.querySelectorAll('.modal-temporary-image');
            modals.forEach(modal => {
                modal.addEventListener('click', function (e) {
                    if (e.target.tagName !== 'IMG' && e.target.className !== 'modal-close') {
                        this.style.display = 'none';
                    }
                });

                const closeBtn = modal.querySelector('.modal-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        const img = modal.querySelector('img');
                        if (img) {
                            img.src = ''; // limpa o src para forçar remoção
                        }

                        modal.style.display = 'none';

                        // Se quiser garantir que a imagem nunca mais seja acessada:
                        setTimeout(() => {
                            window.location.reload();
                        }, 100);
                    });
                }
            });
        });
    </script>

    <style>
        .navi-link, .not-navi-link{
            background-color: #3B3741;
            padding: 16px 26px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            gap: 12px;
            width: 100%;
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }
        .not-navi-link{
            background-color: transparent;
        }
        .hours{
            color: #A3A3A3;
            font-size: 11px;
        }
        .bt{
            all: unset; 
            cursor: pointer; 
        }
        .userblock{
            width: 100%; 
            height:100%;
            aspect-ratio: 1/1;
            object-fit: contain;
        }
    </style>

@endsection
