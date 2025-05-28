@extends('admin.core.admin')
@section('content')
    @php
        $hasActiveSubscription = null;
        $imagePath = Auth::user()->path_image;
        if ($imagePath != null) {
            $imagePath = asset('storage/'.$imagePath);
        }else{
            $imagePath = asset('build/admin/images/userblock.png');
        }
    @endphp

    @include('admin.includes.header', [
        'titlePage' => 'Dashboard',
        'userName' => collect(explode(' ', Auth::user()->name))->slice(0, 2)->implode(' '),        
        'userEmail' => Auth::user()->email,
        'messages' => '',
        'messageCount' => '3',
        'notifications' => '',
        'notificationsCount' => '4',
        'messages' => '',
        'src' => $imagePath,
        'link' => route('admin.dashboard.user.edit', Auth::user()->id),
        'logout' => route('admin.dashboard.user.logout'),
    ])

    <div class="row justify-content-between mb-3">
    <!-- Botão de Filtro -->
    <div class="position-relative d-inline-block">
        <div class="d-flex flex-column justify-content-between align-items-start">
            <div class="d-flex flex-row justify-content-center align-items-center w-100 gap-3 mb-4">
                <div class="geex-content__summary__count__single warning-bg flex-fill p-15" style="width: 25%">
                    <div class="geex-content__summary__count__single__content">
                        <h4 class="geex-content__summary__count__single__title">{{isset($companionsPendingCount) ? $companionsPendingCount : '0'}}</h4>
                        <p class="geex-content__summary__count__single__subtitle">Entrevistas pendentes</p>
                    </div>
                    <div class="geex-content__summary__count__single__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M15.9997 1.33322C13.0989 1.33322 10.2632 2.1934 7.85132 3.805C5.4394 5.41659 3.55953 7.70721 2.44945 10.3872C1.33936 13.0672 1.04891 16.0162 1.61483 18.8612C2.18075 21.7063 3.57761 24.3196 5.62878 26.3708C7.67995 28.422 10.2933 29.8188 13.1384 30.3847C15.9834 30.9506 18.9324 30.6602 21.6124 29.5501C24.2924 28.44 26.583 26.5602 28.1946 24.1482C29.8062 21.7363 30.6664 18.9007 30.6664 15.9999C30.6618 12.1115 29.1151 8.38359 26.3655 5.63405C23.616 2.88451 19.8881 1.3378 15.9997 1.33322ZM15.9997 27.9999C13.6263 27.9999 11.3062 27.2961 9.33284 25.9775C7.35945 24.6589 5.82138 22.7848 4.91313 20.5921C4.00488 18.3994 3.76724 15.9866 4.23026 13.6588C4.69328 11.331 5.83617 9.19283 7.5144 7.5146C9.19263 5.83637 11.3308 4.69348 13.6586 4.23046C15.9864 3.76744 18.3992 4.00508 20.5919 4.91333C22.7846 5.82158 24.6587 7.35965 25.9773 9.33304C27.2959 11.3064 27.9997 13.6265 27.9997 15.9999C27.9958 19.1813 26.7303 22.2313 24.4807 24.4809C22.2311 26.7305 19.1811 27.996 15.9997 27.9999Z" fill="#464255"/>
                            <path d="M16.0003 8.00001C15.6467 8.00001 15.3076 8.14048 15.0575 8.39053C14.8075 8.64058 14.667 8.97972 14.667 9.33334V18.6667C14.667 19.0203 14.8075 19.3594 15.0575 19.6095C15.3076 19.8595 15.6467 20 16.0003 20C16.354 20 16.6931 19.8595 16.9431 19.6095C17.1932 19.3594 17.3337 19.0203 17.3337 18.6667V9.33334C17.3337 8.97972 17.1932 8.64058 16.9431 8.39053C16.6931 8.14048 16.354 8.00001 16.0003 8.00001Z" fill="#464255"/>
                            <path d="M16.0003 23.9999C16.7367 23.9999 17.3337 23.403 17.3337 22.6666C17.3337 21.9302 16.7367 21.3332 16.0003 21.3332C15.2639 21.3332 14.667 21.9302 14.667 22.6666C14.667 23.403 15.2639 23.9999 16.0003 23.9999Z" fill="#464255"/>
                        </svg>
                    </div>
                </div>
                <div class="geex-content__summary__count__single success-bg flex-fill p-15" style="width: 25%">
                    <div class="geex-content__summary__count__single__content">
                        <h4 class="geex-content__summary__count__single__title">{{isset($companionsApprovedCount) ? $companionsApprovedCount : '0'}}</h4>
                        <p class="geex-content__summary__count__single__subtitle">Perfis aprovados</p>
                    </div>
                    <div class="geex-content__summary__count__single__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M15.9997 1.33335C13.0989 1.33335 10.2632 2.19353 7.85132 3.80513C5.4394 5.41672 3.55953 7.70734 2.44945 10.3873C1.33936 13.0673 1.04891 16.0163 1.61483 18.8613C2.18075 21.7064 3.57761 24.3197 5.62878 26.3709C7.67995 28.4221 10.2933 29.8189 13.1384 30.3849C15.9834 30.9508 18.9324 30.6603 21.6124 29.5502C24.2924 28.4402 26.583 26.5603 28.1946 24.1484C29.8062 21.7365 30.6664 18.9008 30.6664 16C30.6618 12.1116 29.1151 8.38372 26.3655 5.63418C23.616 2.88464 19.8881 1.33793 15.9997 1.33335ZM15.9997 28C13.6263 28 11.3062 27.2962 9.33284 25.9776C7.35945 24.6591 5.82138 22.7849 4.91313 20.5922C4.00488 18.3995 3.76724 15.9867 4.23026 13.6589C4.69328 11.3312 5.83617 9.19296 7.5144 7.51473C9.19263 5.8365 11.3308 4.69361 13.6586 4.23059C15.9864 3.76757 18.3992 4.00521 20.5919 4.91346C22.7846 5.82171 24.6587 7.35978 25.9773 9.33317C27.2959 11.3066 27.9997 13.6266 27.9997 16C27.9962 19.1815 26.7307 22.2317 24.4811 24.4814C22.2314 26.7311 19.1812 27.9965 15.9997 28Z" fill="#464255"/>
                            <path d="M21.7648 11.684L14.7061 18.1546L11.6088 15.0573C11.4858 14.93 11.3387 14.8284 11.176 14.7585C11.0133 14.6886 10.8384 14.6518 10.6613 14.6503C10.4843 14.6488 10.3087 14.6825 10.1449 14.7495C9.98099 14.8166 9.83212 14.9156 9.70693 15.0408C9.58174 15.166 9.48274 15.3148 9.41569 15.4787C9.34865 15.6426 9.31492 15.8181 9.31646 15.9952C9.318 16.1722 9.35478 16.3472 9.42466 16.5098C9.49453 16.6725 9.59611 16.8196 9.72346 16.9426L13.7235 20.9426C13.9664 21.1857 14.2939 21.3255 14.6374 21.3329C14.981 21.3404 15.3142 21.2149 15.5675 20.9826L23.5675 13.6493C23.8281 13.4103 23.9831 13.0775 23.9983 12.7241C24.0136 12.3708 23.8878 12.0259 23.6488 11.7653C23.4097 11.5047 23.077 11.3497 22.7236 11.3344C22.3703 11.3192 22.0254 11.4449 21.7648 11.684Z" fill="#464255"/>
                        </svg>
                    </div>
                </div>
                <div class="geex-content__summary__count__single danger-bg flex-fill p-15" style="width: 25%">
                    <div class="geex-content__summary__count__single__content">
                        <h4 class="geex-content__summary__count__single__title">{{isset($companionsReprovedCount) ? $companionsReprovedCount : '0'}}</h4>
                        <p class="geex-content__summary__count__single__subtitle">Perfis Reprovados</p>
                    </div>
                    <div class="geex-content__summary__count__single__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M15.9997 1.33321C13.0989 1.33321 10.2632 2.19339 7.85132 3.80498C5.4394 5.41658 3.55953 7.7072 2.44945 10.3872C1.33936 13.0672 1.04891 16.0161 1.61483 18.8612C2.18075 21.7063 3.57761 24.3196 5.62878 26.3708C7.67995 28.4219 10.2933 29.8188 13.1384 30.3847C15.9834 30.9506 18.9324 30.6602 21.6124 29.5501C24.2924 28.44 26.583 26.5602 28.1946 24.1482C29.8062 21.7363 30.6664 18.9007 30.6664 15.9999C30.6618 12.1114 29.1151 8.38358 26.3655 5.63404C23.616 2.8845 19.8881 1.33779 15.9997 1.33321ZM15.9997 27.9999C13.6263 27.9999 11.3062 27.2961 9.33284 25.9775C7.35945 24.6589 5.82138 22.7848 4.91313 20.5921C4.00488 18.3994 3.76724 15.9866 4.23026 13.6588C4.69328 11.331 5.83617 9.19282 7.5144 7.51459C9.19263 5.83636 11.3308 4.69347 13.6586 4.23045C15.9864 3.76743 18.3992 4.00507 20.5919 4.91332C22.7846 5.82157 24.6587 7.35964 25.9773 9.33303C27.2959 11.3064 27.9997 13.6265 27.9997 15.9999C27.9958 19.1813 26.7303 22.2313 24.4807 24.4809C22.2311 26.7305 19.1811 27.996 15.9997 27.9999Z" fill="#464255"/>
                            <path d="M18.9433 7.55344C18.1839 7.05351 17.3108 6.75286 16.4046 6.67923C15.4984 6.60559 14.5882 6.76134 13.758 7.13211C12.8218 7.54836 12.0291 8.23143 11.4792 9.09587C10.9292 9.96031 10.6463 10.9677 10.666 11.9921V12.0001C10.6671 12.3537 10.8086 12.6925 11.0594 12.9417C11.3101 13.191 11.6497 13.3305 12.0033 13.3294C12.357 13.3284 12.6957 13.1869 12.945 12.9361C13.1943 12.6853 13.3337 12.3457 13.3327 11.9921C13.3191 11.4931 13.4503 11.0009 13.7106 10.5749C13.9709 10.149 14.3491 9.80763 14.7993 9.59211C15.224 9.3921 15.6928 9.30424 16.161 9.33692C16.6292 9.3696 17.0813 9.52172 17.474 9.77878C17.8246 10.0106 18.1154 10.3221 18.3227 10.6877C18.53 11.0533 18.6479 11.4627 18.6669 11.8826C18.6859 12.3025 18.6054 12.7209 18.4319 13.1037C18.2584 13.4865 17.9969 13.8229 17.6687 14.0854C16.756 14.7825 16.0122 15.6761 15.4923 16.7001C14.9725 17.7241 14.6901 18.852 14.666 20.0001C14.6666 20.1752 14.7017 20.3485 14.7693 20.51C14.8369 20.6715 14.9356 20.8182 15.0598 20.9416C15.1841 21.0649 15.3314 21.1626 15.4934 21.2291C15.6554 21.2955 15.8289 21.3294 16.004 21.3288C16.1791 21.3282 16.3524 21.2931 16.5139 21.2255C16.6754 21.1579 16.8221 21.0592 16.9454 20.935C17.0688 20.8107 17.1665 20.6634 17.233 20.5014C17.2994 20.3394 17.3333 20.1659 17.3327 19.9908C17.3582 19.2435 17.5512 18.5115 17.8974 17.8488C18.2435 17.186 18.734 16.6094 19.3327 16.1614C19.9879 15.6361 20.5098 14.9634 20.8559 14.1982C21.202 13.4329 21.3624 12.5968 21.3242 11.7578C21.286 10.9188 21.0502 10.1008 20.636 9.37015C20.2218 8.63954 19.6409 8.01708 18.9407 7.55344H18.9433Z" fill="#464255"/>
                            <path d="M16.0003 25.3335C16.7367 25.3335 17.3337 24.7365 17.3337 24.0001C17.3337 23.2637 16.7367 22.6668 16.0003 22.6668C15.2639 22.6668 14.667 23.2637 14.667 24.0001C14.667 24.7365 15.2639 25.3335 16.0003 25.3335Z" fill="#464255"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-between align-items-end">
                <div class="d-flex justify-content-start gap-5">
                    <a href="#" class="col-lg-2 d-flex justify-content-start gap-2 align-items-center" id="toggleFilter">
                        <i class="display-4 uil uil-filter"></i>
                        Filtros
                    </a>
            
                    @if (Route::currentRouteName() === 'admin.companion.search')
                        <a href="{{route('admin.companion.index')}}" class="ms-5 d-flex justify-content-start gap-2 align-items-center">
                            <i class="display-4 uil uil-times-circle"></i>
                            Limpar filtro
                        </a>
                    @endif
                </div>
                <div class="caption rounded-4 p-2 ps-3" style="background: #FFF; border-radius: 5px; width: 400px">
                    <h5 class="text-dark mb-2">Legenda</h4>
                    <ul>
                        <li class="text-dark d-flex justify-content-start align-items-center gap-2" style="font-size: 12px;">
                            <i class="uil uil-check-circle fs-4 text-success" style="font-size: 18px !important;"></i>
                            Usuário com entrevista concluída e aprovado no sistema
                        </li>
                        <li class="text-dark d-flex justify-content-start align-items-center gap-2" style="font-size: 12px;">
                            <i class="uil uil-exclamation-circle fs-4 text-warning" style="font-size: 18px !important;"></i>
                            Usuário com entrevista pendente
                        </li>
                        <li class="text-dark d-flex justify-content-start align-items-center gap-2" style="font-size: 12px;">
                            <i class="uil uil-times-circle fs-4 text-danger" style="font-size: 18px !important;"></i>
                            Usuário com entrevista concluída e reprovado no sistema
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- PERMISSÕES DE ACOMPANHANTES -->
        @php
            $canAprovar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.aprovar perfil');
            $canReprovar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.reprovar perfil');
            $canCortesia = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.conceder cortesia');
            $canStatusPagamento = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.mudar status de pagamento');
            $canAtivarDesativar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.ativar desativar acompanhante');
            $canTopLove = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.adicionar remover acompanhante do top love');
        @endphp
    </div>

        <div class="col-lg-2">
            {{-- <button class="geex-btn geex-btn--primary w-100"> Cadastrar Novo Plano </button> --}}
        </div>
    </div>
    <div class="row g-40">
        @foreach ($companions as $companion)
            @php
                $latestSubscribed = $companion->subscribeds->last();                
                $isActive = $companion->active == 1;
                $is_courtesy = $companion->is_courtesy == 1;
                $statusVerification = $companion->companion_status_verification;
                $imageClass = $isActive ? '' : 'img-opaca ';
                $imageSrc = $companion->path_file_profile 
                    ? asset('storage/' . $companion->path_file_profile) 
                    : asset('build/admin/images/userblock.png');
            @endphp
            
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="single-contact-grid-area">
                    <div class="top-area">
                        <div class="avatar overflow-hidden rounded-circle {{ $imageClass }}" style="width: 70px; height: 70px;">
                            <img src="{{ $imageSrc }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        
                        @if ($companion->is_courtesy == 1)                            
                            <span class="badge bg-info d-flex align-items-center gap-1">
                                <i class="uil uil-gift"></i> Cortesia
                            </span>
                        @endif

                        <div class="action-area">
                            @if ($canAprovar || $canReprovar)                                
                                <div class="single geex-content__chat__header__filter__btn {{ $companion->active == 0 ? 'disabled' : '' }}">
                                    <i class="uil uil-ellipsis-v"></i>
                                </div>                            
                            @endif
    
                            <div class="geex-content__chat__header__filter__content text-center" style="padding: 20px 10px;font-size: 14px;">                                
                                @if ($statusVerification !== 'approved' && $canAprovar)
                                    <form action="{{ route('admin.companion.statusVerificationUpdate', ['companion' => $companion->id]) }}" method="post" class="text-center mt-0">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="companion_status_verification" value="approved">
                                        <button 
                                            type="submit" 
                                            class="geex-badge--success-transparent p-2 w-100" 
                                            style="border-color: transparent; border-radius: 8px;    font-size: 12px;" 
                                            title="Aprovar perfil"
                                        >
                                            Aprovar perfil
                                        </button>
                                    </form>
                                @endif

                                @if ($statusVerification !== 'rejected' && $canReprovar)
                                    <form action="{{ route('admin.companion.statusVerificationUpdate', ['companion' => $companion->id]) }}" method="post" class="text-center mt-3">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="companion_status_verification" value="rejected">
                                        <button 
                                            type="submit" 
                                            class="geex-badge--danger-transparent p-2 w-100" 
                                            style="border-color: transparent; border-radius: 8px; font-size:12px"  
                                            title="Reprovar perfil"
                                        >
                                            Reprovar perfil
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="details-area {{ $imageClass }} position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="name mb-0">{{ $companion->name }}</h4>
                            
                            @switch($companion->companion_status_verification)
                                @case('approved')
                                    <i class="hover uil uil-check-circle text-success" style="font-size: 30px;"></i>
                                    <div class="msg-user approved alert alert-success d-flex align-items-center gap-2" role="alert">
                                        <i class="uil uil-exclamation-circle fs-4"></i>
                                        <div>
                                            Este usuário está <strong>aprovado</strong> no Sistema. 
                                        </div>
                                    </div>  
                                    @break
                                @case('rejected')                                    
                                    <i class="hover uil uil-times-circle text-danger" style="font-size: 30px;"></i> 
                                    <div class="msg-user repproved alert alert-danger d-flex align-items-center gap-2" role="alert">
                                        <i class="uil uil-exclamation-circle fs-4"></i>
                                        <div>
                                            Este usuário foi <strong>reprovado</strong> no Sistema. 
                                        </div>
                                    </div>  
                                    @break
                                @default
                                <i class="hover uil uil-exclamation-circle text-warning" style="font-size: 30px;"></i> 
                                <div class="msg-user alert alert-warning d-flex align-items-center gap-2" role="alert">
                                    <i class="uil uil-exclamation-circle fs-4"></i>
                                    <div>
                                        Este usuário está com aprovação <strong>pendente</strong> no Sistema. 
                                    </div>
                                </div>    
                            @endswitch

                        </div>

                        <div class="form-check mb-0 mt-3 w-100">
                            @if($canCortesia)
                            <form data-id="{{ $companion->id }}" action="{{ route('admin.companion.courtesyUpdate', ['companion' => $companion->id]) }}" method="post">
                                @csrf
                                @method('put')
                                <input 
                                    class="form-check-input {{ $companion->active == 0 ? 'disabled' : '' }}" 
                                    type="checkbox"  
                                    name="is_courtesy"
                                    value="1"
                                    id="is_courtesy_{{ $companion->id }}"
                                    {{ $companion->is_courtesy == 0 ? 'required' : '' }} 
                                    {{ $companion->is_courtesy == 1 ? 'checked' : '' }}
                                >
                                <label class="form-check-label {{ $companion->active == 0 ? 'disabled' : '' }}" for="is_courtesy_{{ $companion->id }}" style="font-size: 11px;">
                                    Conceder acesso por cortesia (sem necessidade de assinatura)
                                </label>
                                <button type="submit" class="geex-btn geex-btn--primary w-auto justify-content-center mt-2 {{ $companion->active == 0 ? 'disabled' : '' }}" style="font-size: 13px;padding: 3px 14px;">
                                    {{isset($companion->is_courtesy) && $companion->is_courtesy == 1 ? 'Desativar cortesia' : 'Conceder cortesia'}}
                                </button>
                            </form>
                            @endif
                        </div>

                        <!-- Modal de alerta -->
                        <div class="modal fade" data-id="{{ $companion->id }}" id="courtesyModal_{{ $companion->id }}" tabindex="-1" aria-labelledby="courtesyModalLabel_{{ $companion->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content rounded-3 border-warning shadow">
                                    <div class="modal-body text-center p-4">
                                        <div class="text-warning mb-3" style="font-size: 4rem;">
                                            <i class="uil uil-exclamation-triangle"></i>
                                        </div>
                        
                                        <h4 class="modal-title mb-2 text-dark" id="courtesyModalLabel_{{ $companion->id }}">
                                            Ação necessária
                                        </h4>
                        
                                        <p class="text-dark mb-4 courtesy-modal-body">
                                            <!-- Conteúdo será preenchido via JS -->
                                        </p>
                        
                                        <button type="button" class="btn btn-warning text-white px-4" data-bs-dismiss="modal">
                                            <i class="uil uil-check-circle me-1"></i> Entendi
                                        </button>
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-wrapper">
                            <a href="#" class="single-contact">
                                <i class="uil uil-phone"></i>
                                <p>{{ $companion->phone }}</p>
                            </a>
                            <a href="#" class="single-contact">
                                <i class="uil uil-envelope"></i>
                                <p>{{ $companion->email }}</p>
                            </a>
                            <a href="#" class="single-contact">
                                @switch($companion->gender)
                                    @case('trans')
                                        <i class="mdi mdi-gender-transgender"></i>
                                        @break
                                    @case('feminino')
                                        <i class="mdi mdi-gender-female"></i>
                                        @break
                                    @default
                                        <i class="mdi mdi-gender-male"></i>
                                        
                                @endswitch                                
                                <p>{{ ucfirst($companion->gender) }}</p>
                            </a>

                            @if ($latestSubscribed && $canStatusPagamento)
                                <a href="#" class="single-contact">
                                    <i class="uil uil-dollar-alt"></i>
                                    <p>
                                        {{ number_format($latestSubscribed->plan->price ?? 0, 2, ',', '.') }} - Plano {{ $latestSubscribed->plan->name ?? 'Desconhecido' }}
                                    </p>
                                </a>
        
                                <h5 class="mb-3 text-center">Status do Pagamento</h5>
                                @switch($latestSubscribed->status)
                                    @case('paid')
                                    @case('pending')
                                    @case('failed')
                                    @case('expired')
                                        <form action="{{ route('admin.subscribed.update', ['subscribed' => $latestSubscribed->id]) }}" method="POST" class="payment-status-form">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="companion_id" value="{{$companion->id }}">
                                            <div class="content-payment-status text-center mb-3"> 
                                                <div class="mb-0">
                                                    <div class="select position-relative">
                                                        <select class="form-select" name="status" onchange="this.form.submit()">
                                                            <option disabled selected>Selecione o status</option>
                                                            <option value="paid">Pago</option>
                                                            <option value="pending">Pendente</option>
                                                            <option value="expired">Expirado</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        @php
                                            switch ($latestSubscribed->status) {
                                                case 'paid':
                                                    $statusClass = 'geex-badge--success-transparent';
                                                    break;
                                                case 'pending':
                                                    $statusClass = 'geex-badge--warning-transparent';
                                                    break;
                                                case 'expired':
                                                case 'failed':
                                                    $statusClass = 'geex-badge--danger-transparent';
                                                    break;
                                                default:
                                                    $statusClass = 'geex-badge--secondary-transparent';
                                                    break;
                                            }
                                        @endphp

                                        <span class="geex-badge {{ $statusClass }}">
                                            @php
                                                switch ($latestSubscribed->status) {
                                                    case 'paid':
                                                        $statusTitle = 'Pago';
                                                        break;
                                                    case 'pending':
                                                        $statusTitle = 'Pendente';
                                                        break;
                                                    case 'expired':
                                                        $statusTitle = 'Expirado';
                                                        break;
                                                    case 'failed':
                                                        $statusTitle = 'Falha';
                                                        break;
                                                    default:
                                                }
                                            @endphp
                                            {{ $statusTitle }}
                                            <div class="open-edit">
                                                <i class="uil uil-edit"></i>
                                            </div>
                                        </span>

                                        @break
                                @endswitch

                            @elseif(!$latestSubscribed)
                                <a class="single-contact">
                                    <i class="uil uil-dollar-alt"></i>
                                    <p>Sem plano</p>
                                </a>
                                <span class="geex-badge geex-badge--primary-transparent">Sem assinatura</span>
                            @endif

                            @if($canAtivarDesativar)
                            <form action="{{ route('admin.companion.update.activeCompanionUpdate', ['companion' => $companion->id]) }}" method="post" class="text-center mt-3">
                                @csrf
                                @method('put')
                            
                                <input type="hidden" name="active" value="{{ $isActive ? 0 : 1 }}">
                            
                                <button 
                                    type="submit" 
                                    class="geex-btn geex-btn--primary w-100 justify-content-center pt-2 pb-2" 
                                    title="{{ $isActive ? 'Desativar acompanhante' : 'Ativar acompanhante' }}"
                                    style="font-size: 13px;padding: 15px;"
                                >
                                    {{ $isActive ? 'Desativar acompanhante' : 'Ativar acompanhante' }}
                                </button>                                
                            </form>
                            @endif
                            @if($canTopLove)
                            <form id="top-love-form-{{ $companion->id }}" action="{{ route('admin.companion.update.topLove', ['companion' => $companion->id]) }}" method="post" class="mt-3">
                                @csrf
                                @method('PUT') 
                                <input type="hidden" name="top_love" value="0">
                                <div class="d-flex justify-content-start align-items-center gap-2 mt-3">
                                    <input 
                                        type="checkbox" 
                                        id="top_love_{{ $companion->id }}" 
                                        name="top_love" 
                                        value="1" 
                                        class="{{ $companion->active == 0 ? 'disabled' : '' }}" 
                                        {{ isset($companion->top_love) && $companion->top_love == 1 ? 'checked' : '' }}
                                        {{ $companion->active == 0 ? 'disabled' : '' }}
                                        onchange="document.getElementById('top-love-form-{{ $companion->id }}').submit();"
                                    >
                                    <label 
                                        class="form-check-label {{ $companion->active == 0 ? 'disabled' : '' }}" 
                                        for="top_love_{{ $companion->id }}" 
                                        style="font-size: 11px;">
                                        {!! isset($companion->top_love) && $companion->top_love == 0 
                                            ? 'Destacar acompanhante no <b>Top Love</b>' 
                                            : 'Remover acompanhante do <b>Top Love</b>' !!}
                                    </label>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    <style>
        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }

        input.is-invalid {
            border: 2px solid red !important;
            box-shadow: 0 0 4px red;
        }

        .highlight-error {
            outline: 2px solid red;
            outline-offset: 2px;
            box-shadow: 0 0 5px red;
            border-radius: 3px;
        }
        .msg-user{
            position: absolute;
            top: -50px;
            left: 0;
            font-size: 10px;
            padding: 3px;
            transition: opacity 0.3s ease;
            opacity: 0;
        }
        .msg-user.approved::after{
            content:"";
            border-top: 10px solid #ccf1d1;
        }
        .msg-user.repproved::after{
            content:"";   
            border-top: 10px solid #ffcfcf;
        }
        .msg-user::after{
            content: "";
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 10px solid #fee8ce;
            position: absolute;
            bottom: -9px;
            right: 7px;
            transition: opacity 0.3s ease;
            opacity: 0;
        }
        .hover:hover + .msg-user,
        .hover:hover + .msg-user::after {
            opacity: 1;
        }

        #paymentStatusModify{
            background: #222222;
            color: #FFF;
            position: relative;
        }
        .select::before{
            content: "";
            background: #f14c90;
            height: 35px;
            width: 35px;
            position: absolute;
            top: 0;
            right: 0px;
            z-index: 1;
            border-radius: 0 0.25rem 0.25rem 0;
            pointer-events: none;
        }
        .select select{
            background: #222222;
            color: #FFF;
        }
        .select::after{
            content: "";
            width: 0;
            height: 0;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 10px solid #FFF;
            position: absolute;
            right: 11px;
            top: 50%;
            z-index: 2;
            transform: translate(0px, -2px);
            pointer-events: none;
        }
        .content-payment-status {
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            height: 0;
            overflow: hidden;
            bottom: 87px;
            left: 50%;
            transform: translate(-50%, 0px);
            background: #222222;
            width: 213px;
            padding: 0px;
            position: absolute;
        }

        .content-payment-status.show {
            opacity: 1;
            pointer-events: auto;
            height: auto;
            margin-top: 0px;
            transition: opacity 0.3s ease;
        }

        .bt{
            all: unset; 
            cursor: pointer; 
        }
        .img-opaca {
            opacity: 0.5;
        }
    </style>
    <script>
        document.getElementById('toggleFilter').addEventListener('click', function (e) {
            e.preventDefault();
            const dropdown = document.getElementById('filterDropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });
    
        document.getElementById('closeFilter').addEventListener('click', function () {
            document.getElementById('filterDropdown').style.display = 'none';
        });
    
        // Se quiser fechar clicando fora:
        window.addEventListener('click', function (e) {
            const filter = document.getElementById('filterDropdown');
            if (!filter.contains(e.target) && e.target.id !== 'toggleFilter') {
                filter.style.display = 'none';
            }
        });

        //Abrir conteudo do pagamento
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.open-edit');

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    // Sobe até o card atual (pai comum dos elementos)
                    const card = button.closest('.single-contact-grid-area');
                    
                    // Busca dentro do card o content-payment-status correspondente
                    const content = card.querySelector('.content-payment-status');

                    if (content) {
                        content.classList.toggle('show');
                    }
                });
            });
        });

        //Evitar envio da cortesia sem dearmacar o checkbox
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form[data-id]');

            forms.forEach(form => {
                const id = form.getAttribute('data-id');
                const checkbox = form.querySelector('input[name="is_courtesy"]');
                const button = form.querySelector('button[type="submit"]');

                // Monitorando o evento de clique no checkbox
                checkbox.addEventListener('click', function () {
                    // Verifica se o checkbox está marcado ou desmarcado
                    if (checkbox.checked) {
                        // Se estiver marcado, remove a borda vermelha (caso haja erro)
                        checkbox.classList.remove('is-invalid');
                    } else {
                        // Se não estiver marcado, mantém a borda vermelha (caso necessário)
                        checkbox.classList.add('is-invalid');
                    }
                });

                form.addEventListener('submit', function (e) {
                    const buttonLabel = button?.textContent.trim().toLowerCase();

                    const isTryingToEnable = buttonLabel.includes('ativar cortesia') || buttonLabel.includes('conceder cortesia');
                    const isTryingToDisable = buttonLabel.includes('desativar cortesia');

                    let errorMessage = '';

                    // Validação apenas para a desativação da cortesia
                    if (isTryingToDisable && checkbox.checked) {
                        errorMessage = 'Para remover a cortesia, desmarque a caixinha antes de confirmar.';
                    }

                    // Se houver erro, exibe o modal e bloqueia o envio
                    if (errorMessage) {
                        e.preventDefault(); // Cancela o submit

                        const modal = document.querySelector(`#courtesyModal_${id}`);
                        const modalBody = modal?.querySelector('.courtesy-modal-body');

                        if (modal && modalBody) {
                            modalBody.textContent = errorMessage;
                            const bootstrapModal = new bootstrap.Modal(modal);
                            bootstrapModal.show();

                            // Adiciona borda vermelha ao checkbox se necessário
                            checkbox.classList.add('is-invalid');
                        }
                    } else {
                        // Limpa a borda vermelha quando não houver erro
                        checkbox.classList.remove('is-invalid');
                    }
                });
            });
        });

        //Submeter formulario top-love
        document.addEventListener('DOMContentLoaded', function() {
            // Seleciona todos os checkboxes cujo id começa com "top_love_"
            const checkboxes = document.querySelectorAll('input[id^="top_love_"]');
            
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const form = checkbox.closest('form');
                    if (form) {
                        form.submit();
                    }
                });
            });
        });
    </script>    
@endsection
