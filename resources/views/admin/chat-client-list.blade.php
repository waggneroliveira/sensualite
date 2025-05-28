<ul class="nav nav-tabs geex-content__chat__sidebar__tab mb-20" role="tablist">
    <span class="geex-content__chat__sidebar__tab__title">Meus Contatos</span>
    @foreach ($conversations as $conversation)
        <li class="nav-item" role="presentation">
            <a href="{{ route('admin.dashboard.client.chat', ['conversationId' => $conversation->id]) }}"
               class="{{ request()->routeIs('admin.dashboard.client.chat') && request('conversationId') == $conversation->id ? 'navi-link' : 'not-navi-link' }}">
                <div class="geex-chat-tab-single">
                    <div class="geex-chat-tab-single__img rounded-circle overflow-hidden" style="width: 90px;height:60px;">
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
