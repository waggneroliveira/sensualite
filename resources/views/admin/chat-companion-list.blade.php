<ul class="nav nav-tabs geex-content__chat__sidebar__tab mb-20" role="tablist">
    <span class="geex-content__chat__sidebar__tab__title">Meus Contatos</span>
    @foreach ($conversations as $conversation)
        <li class="nav-item" role="presentation">
            <a href="{{ route('admin.dashboard.companion.chat', ['conversationId' => $conversation->id]) }}" class="{{ request()->routeIs('admin.dashboard.client.chat') && request('conversationId') == $conversation->id ? 'navi-link' : 'not-navi-link' }}">
                <div class="geex-chat-tab-single"> {{-- nav-link unread --}}    
                    <div class="geex-chat-tab-single__img rounded-circle overflow-hidden" style="width: 90px;height:60px;">
                        @if ($userblock && $userblock->blocked_id == $authUserId && $userblock->blocker_id == $conversation->client->id)                                            
                            <img src="{{asset('build/admin/images/userblock.png')}}" class="userblock" alt="avatar" style="object-fit: contain;width: 100%;height: 100%;"/>
                        @else
                            <img
                                src="{{ $conversation->client->path_image ? asset('storage/' . $conversation->client->path_image) : asset('build/admin/images/userblock.png') }}"
                                style="object-fit: contain;width: 100%;height: 100%;"
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
