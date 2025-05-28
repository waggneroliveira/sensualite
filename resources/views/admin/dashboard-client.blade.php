@extends('admin.core.client')
@section('content')
    @php
        $imagePath = Auth::guard('cliente')->user()->path_image;

        if ($imagePath != null) {
            $imagePath = asset('storage/'.$imagePath);
        }else{
            $imagePath = asset('build/admin/images/userblock.png');
        }
    @endphp
    @include('admin.includes.header', [
        'titlePage' => 'Conversas',
        'userName' => collect(explode(' ', Auth::guard('cliente')->user()->name))->slice(0, 2)->implode(' '),        
        'userEmail' => Auth::guard('cliente')->user()->email,
        'messages' => '',
        'messageCount' => '3',
        'notifications' => '',
        'notificationsCount' => '4',
        'src' => $imagePath,
        'link' => route('admin.dashboard.client.edit', Auth::guard('cliente')->user()->id),
        'logout' => route('admin.dashboard.client.logout'),
    ])


    <div class="geex-content__wrapper">
        <div class="geex-content__section-wrapper">
            <div class="geex-content__section geex-content__section--transparent geex-content__todo">
                <div class="geex-content__todo__content tab-content custom-al" id="geex-todo-task-content">
                    <div class="tab-pane fade show active" id="geex-todo-task-content-important">
                        <div class="tab-content geex-transaction-content">
                            <div class="tab-pane fade show active" id="todo_grid_content" role="tabpanel" aria-labelledby="todo_grid_tab">
                                <div class="row g-40">
                                    @foreach ($companions as $companion)
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                            <!-- single contact grid area start -->
                                            <div class="single-contact-grid-area p-20">
                                                <div class="top-area">
                                                    <div class="avatar rounded-circle overflow-hidden" style="width: 60px;height:60px;">
                                                        @if (isset($companion->path_file_profile) && $companion->path_file_profile !== null)
                                                            <img src="{{asset('storage/' . $companion->path_file_profile)}}" alt="{{$companion->name}}" class="w-full">
                                                            @else
                                                            <img src="{{asset('build/admin/images/contact/03.png')}}" class="w-full">
                                                        @endif
                                                    </div>
                                                    <div class="action-area">
                                                        <div class="single">
                                                            <form method="post">
                                                                @csrf
                                                                @method('post')
                                                                <input type="hidden" name="companionId" value="{{ $companion->id }}">
                                                                
                                                                <span 
                                                                    type="button" 
                                                                    class="" 
                                                                    onclick="toggleLike({{ $companion->id }})" 
                                                                    id="like-button-{{ $companion->id }}"
                                                                    data-liked="{{ $likedByClients[$companion->id] ? 'true' : 'false' }}"
                                                                >
                                                                    {{ $likedByClients[$companion->id] ? '❤️' : '🤍' }}
                                                                </span>
                                                            </form>
                                                        </div>
                                                        
                                                        <div class="single geex-content__chat__header__filter__btn">
                                                            <i class="uil uil-ellipsis-v"></i>
                                                        </div>

                                                        <div class="geex-content__chat__header__filter__content">
                                                            <div class="d-flex flex-column">
                                                                @if (Auth::guard('cliente')->check())
                                                                    <a class="text-white p-2" style="cursor:pointer;" href="{{ route('admin.dashboard.client.chat', ['conversationId' => $companion->conversationId, 'userType' => $authUserType]) }}">
                                                                        Ver Chat
                                                                    </a>
                                                                @endif
                                                                
                                                                <a class="text-white p-2" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modal-detals-user-edit-{{$companion->id}}">Detalhes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="details-area">
                                                    <h4 class="name">{{ $companion->name }}</h4>
                                                    {{-- <span class="designation">UI Designer</span> --}}
                                                    <div class="contact-wrapper">
                                                        <a href="#" class="single-contact">
                                                            <i class="uil uil-bag"></i>
                                                            <p>Highspeed Studios</p>
                                                        </a>
                                                        <a href="#" class="single-contact">
                                                            <i class="uil uil-phone"></i>
                                                            <p>{{ $companion->phone }}</p>
                                                        </a>
                                                        <a href="#" class="single-contact">
                                                            <i class="uil uil-envelope"></i>
                                                            <p>{{ $companion->email }}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single contact grid area end -->
                                            <div class="modal fade" id="modal-detals-user-edit-{{$companion->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light">
                                                            <h4 class="modal-title" id="myCenterModalLabel">Detalhe da Acompanhante</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body p-4">                                                                  
                                                            @include('admin.blades.companion.dashboard.form-detals-user')                                                            
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    async function toggleLike(companionId) {
        const button = document.getElementById(`like-button-${companionId}`);
        const isLiked = button.getAttribute('data-liked') === 'true';
    
        try {
            const response = await fetch("{{ route('admin.dashboard.client.liked', ':companionId') }}".replace(':companionId', companionId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
    
            const data = await response.json();
    
            if (data.liked) {
                button.setAttribute('data-liked', 'true');
                button.textContent = '❤️'; // Ícone de curtida
            } else {
                button.setAttribute('data-liked', 'false');
                button.textContent = '🤍'; // Ícone de descurtida
            }
    
            // Exibe a mensagem de sucesso usando o toastr
            toastr.success(data.message);
        } catch (error) {
            console.error('Erro:', error);
            // Exibe a mensagem de erro usando o toastr
            toastr.error('Erro ao curtir/descurtir.');
        }
    }
</script>

    
    
    
@endsection
