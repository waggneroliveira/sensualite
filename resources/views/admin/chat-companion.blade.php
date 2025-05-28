@extends('admin.core.companion')
@section('content')
    @php
        $name = isset($authUserType) ? Auth::guard('acompanhante')->user()->name : null;
        $email = isset($authUserType) ? Auth::guard('acompanhante')->user()->email : null;
        // $image = isset($authUserType) ? Auth::guard('acompanhante')->user()->path_file_profile : null;

        $imagePath = Auth::guard('acompanhante')->user()->path_file_profile;
        if ($imagePath != null) {
            $imagePath = asset('storage/'.$imagePath);
        }else{
            $imagePath = 'build/admin/images/userblock.png';
        }
    @endphp

    @include('admin.includes.header', [
        'titlePage' => 'Ensaios',
        'userName' => collect(explode(' ', Auth::guard('acompanhante')->user()->name))->slice(0, 2)->implode(' '),        
        'userEmail' => Auth::guard('acompanhante')->user()->email,
        'messages' => '',
        'messageCount' => '3',
        'notifications' => '',
        'notificationsCount' => '4',
        'logout' => route('admin.dashboard.companion.logout'),
        'src' => $imagePath,
        'link' => route('admin.dashboard.companion.profile.index'),
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
                                <input type="text" name="conversation_companion" id="conversation_companion" placeholder="Search" class="geex-content__header__btn" />
                                <i class="uil uil-search"></i>
                            </form>
                        </div>
                    </div>
                    <div id="conversation-list">
                        <ul class="nav nav-tabs geex-content__chat__sidebar__tab mb-20" role="tablist">
                            <span class="geex-content__chat__sidebar__tab__title">Meus Contatos</span>
                            @foreach ($conversations as $conversation)
                                <li class="nav-item" role="presentation">
                                    <a href="{{ route('admin.dashboard.companion.chat', ['conversationId' => $conversation->id]) }}" class="{{ request()->routeIs('admin.dashboard.client.chat') && request('conversationId') == $conversation->id ? 'navi-link' : 'not-navi-link' }}">
                                        <div class="geex-chat-tab-single w-100"> {{-- nav-link unread --}}    
                                            <div class="geex-chat-tab-single__img rounded-circle overflow-hidden" style="width: 90px;height:60px;">
                                                @php
                                                    $clientId = $conversation->client->id;
                                                    $companionId = $conversation->companion->id;
                                                @endphp

                                                @if ($userblock && $userblock->blocked_id == $authUserId && $userblock->blocker_id == $conversation->client->id)
                                                    <img src="{{ asset('build/admin/images/userblock.png') }}" class="userblock" alt="avatar" />
                                                @else
                                                    <img
                                                        src="{{ $conversation->client->path_image ? asset('storage/' . $conversation->client->path_image) : asset('build/admin/images/userblock.png') }}"
                                                        style="aspect-ratio: 1/1; object-fit: cover;"
                                                        alt="{{ $conversation->client->name }}"
                                                    />
                                                @endif
                                            </div>

                                            <div class="geex-chat-tab-single__content">
                                                <div class="geex-chat-tab-single__message">
                                                    @if (Auth::guard('acompanhante')->check())
                                                        <h4 class="geex-chat-tab-single__title">{{$conversation->client->name}}</h4>
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
                                    <div class="geex-content__chat__header__img rounded-circle overflow-hidden">                                        
                                        @php
                                            $clientId = $conversationUnique->client->id;
                                            $companionId = $conversationUnique->companion->id;

                                            $clientBlockedByCompanion = \App\Models\UserBlock::where('blocker_id', $clientId)
                                                ->where('blocker_type', 'cliente')
                                                ->where('blocked_id', $companionId)
                                                ->where('blocked_type', 'acompanhante')
                                                ->exists();
                                        @endphp

                                        @if (Auth::guard('acompanhante')->check() && $authUserType == 'acompanhante')
                                            @if (!$clientBlockedByCompanion)
                                                <img src="{{ $conversationUnique->client->path_image ? asset('storage/' . $conversationUnique->client->path_image) : asset('build/admin/images/userblock.png') }}" style="width: 75px; height: 65px; aspect-ratio: 1/1; object-fit: cover;" alt="avatar" />
                                            @else
                                                <img src="{{ asset('build/admin/images/userblock.png') }}" style="width: 75px; height: 65px; aspect-ratio: 1/1; object-fit: cover;" alt="avatar bloqueado" />
                                            @endif
                                        @endif

                                    </div>
                                    <div class="geex-content__chat__header__content">
                                        <div class="geex-content__chat__header__text">
                                            @if (Auth::guard('acompanhante')->check() && $authUserType == 'acompanhante')
                                                <h4 class="geex-content__chat__header__title">{{ $conversationUnique->client->name }} </h4>
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
                                                           
                                                            {{-- Verifica se o cliente FOI bloqueado pela acompanhante --}}
                                                            @php
                                                                $blockedByCompanion = \App\Models\UserBlock::where('blocker_id', $companionId)
                                                                    ->where('blocker_type', 'acompanhante')
                                                                    ->where('blocked_id', $clientId)
                                                                    ->where('blocked_type', 'cliente')
                                                                    ->first();
                                                            @endphp
                                                            {{-- Verifica se o cliente BLOQUEOU a acompanhante --}}
                                                            @php
                                                                $blockedByClient = \App\Models\UserBlock::where('blocker_id', $clientId)
                                                                    ->where('blocker_type', 'cliente')
                                                                    ->where('blocked_id', $companionId)
                                                                    ->where('blocked_type', 'acompanhante')
                                                                    ->first();
                                                            @endphp
                                                            
                                                            @if ($blockedByClient)
                                                                <p class="text-danger">Você foi bloqueado(a) por este usuário.</p>

                                                            @else                                                               
                                                                @if ($blockedByCompanion)
                                                                    <form action="{{ route('admin.dashboard.chat.desblockUser', ['userblock' => $blockedByCompanion->id]) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" style="outline: none; box-shadow: none;" class="bt bg-transparent text-white">
                                                                            Desbloquear usuário
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <form action="{{ route('admin.dashboard.chat.blocked-companion', ['blocked_id' => $clientId, 'blocker_id' => $companionId]) }}" method="POST">
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
                                    @foreach ($conversationUnique->messages as $message)  
                                        @php
                                            // Identifica quem está logado e define o tipo e ID
                                            if (Auth::guard('acompanhante')->check()) {
                                                $loggedUserId = Auth::guard('acompanhante')->user()->id;
                                                $loggedUserType = 'acompanhante';
                                            } else {
                                                $loggedUserId = null;
                                                $loggedUserType = null;
                                            }
                                            $lastMessageId = $conversationUnique->lastMessage->id ?? null;
                                        @endphp

                                        <div class="geex-content__chat__list__single 
                                            {{ isset($loggedUserId, $loggedUserType) && $message->sender_id === $loggedUserId && $message->sender_type === $loggedUserType ? 'active' : '' }}">

                                            @if (!$clientBlockedByCompanion)
                                                <div class="geex-content__chat__list__single__img" style="height: 50px;width: 50px;overflow: hidden; border-radius: 18px;">
                                                    @if ($message->sender_type == 'acompanhante')
                                                        <img src="{{ $imagePath }}" alt="avatar" />
                                                    @elseif ($message->sender_type == 'cliente')
                                                        <img src="{{ $conversationUnique->client->path_image ? asset('storage/' . $conversationUnique->client->path_image) : asset('build/admin/images/userblock.png') }}" alt="avatar" />
                                                    @else
                                                        <img src="{{ asset('build/admin/images/userblock.png') }}" alt="avatar" />
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
                                                <span class="geex-content__chat__list__single__msg {{ $message->id == $lastMessageId ? 'latest' : '' }}">                                                        
                                                    @if ($conversationUnique->lastMessage->message == '[image]' && $message->is_one_time_view != null)
                                                        {{-- Container do conteúdo temporário --}}
                                                        <div id="message-temporary-{{$message->id}}" class="message-temporary text-start" data-id="{{$message->id}}">
                                                            <span title="Conteúdo temporário" style="font-size: 12px">⏳ Visualização única</span>  
                                                            <span class="image-false position-relative d-block m-auto mt-4"
                                                                style="filter:blur(4px);width:198px;height:254px; background: rgba(255, 255, 255, 0.1);"></span>                                                              
                                                        </div>                                                            
                                                    @endif

                                                    @if($conversationUnique->lastMessage->message != '[image]' && $message->is_one_time_view != null)
                                                        {{ $message->message }}
                                                        {{-- Container do conteúdo temporário --}}
                                                        <div id="message-temporary-{{$message->id}}" class="message-temporary text-start" data-id="{{$message->id}}">
                                                            <span title="Conteúdo temporário" style="font-size: 12px">⏳ Visualização única</span>  
                                                            <span class="image-false position-relative d-block m-auto mt-4"
                                                                style="filter:blur(4px);width:198px;height:254px; background: rgba(255, 255, 255, 0.1);"></span>                                                              
                                                        </div>
                                                        @else
                                                            {{ $message->message }}
                                                    @endif    
                                                    
                                                </span>
                                                <span class="hours">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <form action="
                                    {{ route('admin.dashboard.companion.chat.send', ['conversationId' => $conversationUnique->id]) }}" 
                                    method="POST" 
                                    enctype="multipart/form-data"
                                >
                                    @csrf

                                    <div class="geex-content__chat__send">
                                        <div class="geex-content__chat__send__input">
                                            <input placeholder="Type your message..." name="message" id="chat">
                                        </div>

                                        <div class="clip-file" style="position: relative;">
                                            {{-- Preview da imagem selecionada --}}
                                            <div id="image-preview" style="position: absolute; top: -94px; left: -14px; width: 60px; height: 85px; border-radius: 6px; overflow: hidden; display: none; border: 2px solid #ccc;">
                                                <img src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>

                                            <span class="uil uil-paperclip"></span>
                                            <input type="file" id="image-input" name="is_one_time_view" accept="image/*">
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
        // Evitar envio de formulário no enter
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('conversation_companion');
            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        });
        //Pesquisa das conversas da acompanhante
        $(document).ready(function () {
            $('#conversation_companion').on('keyup', function () {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('admin.conversations.companion.filter') }}",
                    type: "GET",
                    data: {
                        conversation_companion: query
                    },
                    success: function (data) {
                        $('#conversation-list').html(data);
                    },
                    error: function () {
                        console.error("Erro ao filtrar as conversas");
                    }
                });
            });
        });

        // Rolagem do chat ao recarregar página
        document.addEventListener('DOMContentLoaded', () => {
            const chatContainer = document.getElementById('chat-container');
            if (chatContainer) {
                // Garante que o scroll vá até o fim assim que o DOM estiver pronto
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
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

        //Mostrar imagem carregada
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('image-input');
            const previewContainer = document.getElementById('image-preview');
            const previewImg = previewContainer.querySelector('img');

            input.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        previewContainer.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                } else {
                    previewImg.src = '';
                    previewContainer.style.display = 'none';
                }
            });
        });
    </script>

    <style>
        .clip-file {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 45px;
            cursor: pointer;
        }

        .clip-file .uil-paperclip {
            font-size: 32px;
            color: #a3a3a3;
            position: relative;
            z-index: 1;
            pointer-events: none;
        }

        .clip-file input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

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
