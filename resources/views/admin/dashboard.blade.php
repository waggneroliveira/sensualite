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
        'src' => $imagePath,
        'messages' => '',
        'messageCount' => '',
        'notifications' => '',
        'notificationsCount' => '7',
        'messages' => '',
        'link' => route('admin.dashboard.user.edit', Auth::user()->id),
        'logout' => route('admin.dashboard.user.logout'),
    ])
    <div class="geex-content__wrapper">
        <div class="geex-content__section-wrapper">
            <div class="geex-content__summary">
                <div class="geex-content__summary__count flex-nowrap gap-3">
                    <div class="geex-content__summary__count__single primay-bg flex-fill p-15" style="width: 20%">
                        <div class="geex-content__summary__count__single__content">
                            <h4 class="geex-content__summary__count__single__title">{{isset($allCompanions) ? $allCompanions : ''}}</h4>
                            <p class="geex-content__summary__count__single__subtitle">Acompanhantes no sistema</p>
                            
                            <a href="{{route('admin.companion.index')}}" class="bt bg-transparent text-white" style="font-size: 12px"><b>Ver mais</b></a>
                        </div>
                        <div class="geex-content__summary__count__single__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M26.9908 5.10791C26.7542 4.84524 26.4229 4.68728 26.0699 4.66878C25.7168 4.65027 25.3709 4.77274 25.1081 5.00925L12.7148 16.1626L6.94277 10.3906C6.81978 10.2632 6.67265 10.1617 6.50998 10.0918C6.34731 10.0219 6.17235 9.98512 5.99531 9.98358C5.81827 9.98204 5.6427 10.0158 5.47884 10.0828C5.31497 10.1499 5.16611 10.2489 5.04091 10.3741C4.91572 10.4992 4.81672 10.6481 4.74968 10.812C4.68264 10.9758 4.6489 11.1514 4.65044 11.3285C4.65198 11.5055 4.68876 11.6804 4.75864 11.8431C4.82852 12.0058 4.93009 12.1529 5.05744 12.2759L11.7241 18.9426C11.9656 19.184 12.2905 19.3235 12.6319 19.3325C12.9732 19.3414 13.305 19.219 13.5588 18.9906L26.8921 6.99058C27.1548 6.75397 27.3127 6.42272 27.3312 6.06968C27.3498 5.71663 27.2273 5.37069 26.9908 5.10791Z" fill="#464255"/>
                                <path d="M25.1085 13.0093L12.7152 24.1626L6.94321 18.3906C6.69174 18.1478 6.35494 18.0134 6.00534 18.0164C5.65575 18.0195 5.32133 18.1597 5.07412 18.4069C4.82691 18.6541 4.68668 18.9885 4.68364 19.3381C4.68061 19.6877 4.815 20.0245 5.05788 20.276L11.7245 26.9426C11.966 27.1841 12.291 27.3236 12.6323 27.3325C12.9737 27.3415 13.3054 27.2191 13.5592 26.9906L26.8925 14.9906C27.1473 14.752 27.2983 14.423 27.3131 14.0742C27.3279 13.7255 27.2054 13.3848 26.9718 13.1254C26.7383 12.866 26.4123 12.7086 26.0639 12.6868C25.7155 12.6651 25.3725 12.7809 25.1085 13.0093Z" fill="#464255"/>
                            </svg>
                        </div>
                    </div>
                    <div class="geex-content__summary__count__single danger-bg flex-fill p-15" style="width: 20%">
                        <div class="geex-content__summary__count__single__content">
                            <h4 class="geex-content__summary__count__single__title">{{isset($pendingCompanions) ? $pendingCompanions : '0'}}</h4>
                            <p class="geex-content__summary__count__single__subtitle">Pagamentos Pendentes</p>

                            <form action="{{route('admin.companion.search')}}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_status" value="pending">
                                <button type="submit" style="outline: none; box-shadow: none;font-size: 12px" class="bt bg-transparent text-white"><b>Ver mais</b></button>
                            </form>
                        </div>
                        <div class="geex-content__summary__count__single__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M15.9997 1.33321C13.0989 1.33321 10.2632 2.19339 7.85132 3.80498C5.4394 5.41658 3.55953 7.7072 2.44945 10.3872C1.33936 13.0672 1.04891 16.0161 1.61483 18.8612C2.18075 21.7063 3.57761 24.3196 5.62878 26.3708C7.67995 28.4219 10.2933 29.8188 13.1384 30.3847C15.9834 30.9506 18.9324 30.6602 21.6124 29.5501C24.2924 28.44 26.583 26.5602 28.1946 24.1482C29.8062 21.7363 30.6664 18.9007 30.6664 15.9999C30.6618 12.1114 29.1151 8.38358 26.3655 5.63404C23.616 2.8845 19.8881 1.33779 15.9997 1.33321ZM15.9997 27.9999C13.6263 27.9999 11.3062 27.2961 9.33284 25.9775C7.35945 24.6589 5.82138 22.7848 4.91313 20.5921C4.00488 18.3994 3.76724 15.9866 4.23026 13.6588C4.69328 11.331 5.83617 9.19282 7.5144 7.51459C9.19263 5.83636 11.3308 4.69347 13.6586 4.23045C15.9864 3.76743 18.3992 4.00507 20.5919 4.91332C22.7846 5.82157 24.6587 7.35964 25.9773 9.33303C27.2959 11.3064 27.9997 13.6265 27.9997 15.9999C27.9958 19.1813 26.7303 22.2313 24.4807 24.4809C22.2311 26.7305 19.1811 27.996 15.9997 27.9999Z" fill="#464255"/>
                                <path d="M18.9433 7.55344C18.1839 7.05351 17.3108 6.75286 16.4046 6.67923C15.4984 6.60559 14.5882 6.76134 13.758 7.13211C12.8218 7.54836 12.0291 8.23143 11.4792 9.09587C10.9292 9.96031 10.6463 10.9677 10.666 11.9921V12.0001C10.6671 12.3537 10.8086 12.6925 11.0594 12.9417C11.3101 13.191 11.6497 13.3305 12.0033 13.3294C12.357 13.3284 12.6957 13.1869 12.945 12.9361C13.1943 12.6853 13.3337 12.3457 13.3327 11.9921C13.3191 11.4931 13.4503 11.0009 13.7106 10.5749C13.9709 10.149 14.3491 9.80763 14.7993 9.59211C15.224 9.3921 15.6928 9.30424 16.161 9.33692C16.6292 9.3696 17.0813 9.52172 17.474 9.77878C17.8246 10.0106 18.1154 10.3221 18.3227 10.6877C18.53 11.0533 18.6479 11.4627 18.6669 11.8826C18.6859 12.3025 18.6054 12.7209 18.4319 13.1037C18.2584 13.4865 17.9969 13.8229 17.6687 14.0854C16.756 14.7825 16.0122 15.6761 15.4923 16.7001C14.9725 17.7241 14.6901 18.852 14.666 20.0001C14.6666 20.1752 14.7017 20.3485 14.7693 20.51C14.8369 20.6715 14.9356 20.8182 15.0598 20.9416C15.1841 21.0649 15.3314 21.1626 15.4934 21.2291C15.6554 21.2955 15.8289 21.3294 16.004 21.3288C16.1791 21.3282 16.3524 21.2931 16.5139 21.2255C16.6754 21.1579 16.8221 21.0592 16.9454 20.935C17.0688 20.8107 17.1665 20.6634 17.233 20.5014C17.2994 20.3394 17.3333 20.1659 17.3327 19.9908C17.3582 19.2435 17.5512 18.5115 17.8974 17.8488C18.2435 17.186 18.734 16.6094 19.3327 16.1614C19.9879 15.6361 20.5098 14.9634 20.8559 14.1982C21.202 13.4329 21.3624 12.5968 21.3242 11.7578C21.286 10.9188 21.0502 10.1008 20.636 9.37015C20.2218 8.63954 19.6409 8.01708 18.9407 7.55344H18.9433Z" fill="#464255"/>
                                <path d="M16.0003 25.3335C16.7367 25.3335 17.3337 24.7365 17.3337 24.0001C17.3337 23.2637 16.7367 22.6668 16.0003 22.6668C15.2639 22.6668 14.667 23.2637 14.667 24.0001C14.667 24.7365 15.2639 25.3335 16.0003 25.3335Z" fill="#464255"/>
                            </svg>
                        </div>
                    </div>
                    <div class="geex-content__summary__count__single success-bg flex-fill p-15" style="width: 20%">
                        <div class="geex-content__summary__count__single__content">
                            <h4 class="geex-content__summary__count__single__title">{{isset($companionsApprovedCount) ? $companionsApprovedCount : '0'}}</h4>
                            <p class="geex-content__summary__count__single__subtitle">Perfis Aprovados</p>

                            <form action="{{route('admin.companion.search')}}" method="POST">
                                @csrf
                                <input type="hidden" name="companion_status_verification" value="approved">
                                <button type="submit" style="outline: none; box-shadow: none;font-size: 12px" class="bt bg-transparent text-white"><b>Ver mais</b></button>
                            </form>
                        </div>
                        <div class="geex-content__summary__count__single__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M15.9997 1.33335C13.0989 1.33335 10.2632 2.19353 7.85132 3.80513C5.4394 5.41672 3.55953 7.70734 2.44945 10.3873C1.33936 13.0673 1.04891 16.0163 1.61483 18.8613C2.18075 21.7064 3.57761 24.3197 5.62878 26.3709C7.67995 28.4221 10.2933 29.8189 13.1384 30.3849C15.9834 30.9508 18.9324 30.6603 21.6124 29.5502C24.2924 28.4402 26.583 26.5603 28.1946 24.1484C29.8062 21.7365 30.6664 18.9008 30.6664 16C30.6618 12.1116 29.1151 8.38372 26.3655 5.63418C23.616 2.88464 19.8881 1.33793 15.9997 1.33335ZM15.9997 28C13.6263 28 11.3062 27.2962 9.33284 25.9776C7.35945 24.6591 5.82138 22.7849 4.91313 20.5922C4.00488 18.3995 3.76724 15.9867 4.23026 13.6589C4.69328 11.3312 5.83617 9.19296 7.5144 7.51473C9.19263 5.8365 11.3308 4.69361 13.6586 4.23059C15.9864 3.76757 18.3992 4.00521 20.5919 4.91346C22.7846 5.82171 24.6587 7.35978 25.9773 9.33317C27.2959 11.3066 27.9997 13.6266 27.9997 16C27.9962 19.1815 26.7307 22.2317 24.4811 24.4814C22.2314 26.7311 19.1812 27.9965 15.9997 28Z" fill="#464255"/>
                                <path d="M21.7648 11.684L14.7061 18.1546L11.6088 15.0573C11.4858 14.93 11.3387 14.8284 11.176 14.7585C11.0133 14.6886 10.8384 14.6518 10.6613 14.6503C10.4843 14.6488 10.3087 14.6825 10.1449 14.7495C9.98099 14.8166 9.83212 14.9156 9.70693 15.0408C9.58174 15.166 9.48274 15.3148 9.41569 15.4787C9.34865 15.6426 9.31492 15.8181 9.31646 15.9952C9.318 16.1722 9.35478 16.3472 9.42466 16.5098C9.49453 16.6725 9.59611 16.8196 9.72346 16.9426L13.7235 20.9426C13.9664 21.1857 14.2939 21.3255 14.6374 21.3329C14.981 21.3404 15.3142 21.2149 15.5675 20.9826L23.5675 13.6493C23.8281 13.4103 23.9831 13.0775 23.9983 12.7241C24.0136 12.3708 23.8878 12.0259 23.6488 11.7653C23.4097 11.5047 23.077 11.3497 22.7236 11.3344C22.3703 11.3192 22.0254 11.4449 21.7648 11.684Z" fill="#464255"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.companion.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-user display-3"></i>
                                <h5 class="text-white text-center">Acompanhantes</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('assinatura.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.dashboard.plan.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-credit-card display-3"></i>
                                <h5 class="text-white text-center">Assinaturas</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('pacote.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.dashboard.package.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-box display-3"></i>
                                <h5 class="text-white text-center">Pacotes</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('notificacao.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.dashboard.notification.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-bell display-3"></i>
                                <h5 class="text-white text-center">Notificações</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('categoria.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.dashboard.category.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-puzzle-piece display-3"></i>
                                <h5 class="text-white text-center">Categorias das acompanhantes</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('anuncio.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-3">
                        <a nofollow href="{{route('admin.dashboard.announcement.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-tag display-3"></i>
                                <h5 class="text-white">Anuncios</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('ensaio.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-3">
                        <a nofollow href="{{route('admin.dashboard.galleryApprovalRequest')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-image-check display-3"></i>
                                <h5 class="text-white text-center">Aprovação de galeria</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('pagarme.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-3">
                        <a nofollow href="{{route('admin.dashboard.configPayment.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-setting display-3"></i>
                                <h5 class="text-white text-center">Configuração pagarme</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('grupo.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.dashboard.group.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-user-square display-3"></i>
                                <h5 class="text-white text-center">Grupos</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('usuario.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.dashboard.user.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-users-alt display-3"></i>
                                <h5 class="text-white text-center">Usuários</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif
                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('auditoria.visualizar'))
                    <div class="col-md-6 col-xl-2 mb-4">
                        <a nofollow href="{{route('admin.dashboard.audit.index')}}">
                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5 h-100">
                                <i class="uil-search-alt display-3"></i>
                                <h5 class="text-white text-center">Auditoria</h5>
                            </div>
                        </a>
                    </div> <!-- end col-->
                @endif

            </div> {{-- END row --}}
            <div class="geex-content__invoice">
                <div class="geex-content__invoice__list">
                    <div class="geex-content__todo__header">
                        <div class="geex-content__todo__header__title">
                            <h4>Últimos acompanhantes</h4>
                        </div>
                    </div>
                    <div class="tab-content geex-transaction-content">
                        <div class="tab-pane fade show active" id="invoice_list_content" role="tabpanel" aria-labelledby="invoice_list_tab">
                            <div class="geex-content__todo__list">
                                <div class="geex-content__todo__list__single text-center align-items-center gap-0 geex-content__todo__list__single--header">

                                    <div class="geex-content__todo__list__single__text justify-content-center">
                                        <span class="geex-content__todo__list__single__subtitle">Nome</span>
                                    </div>

                                    <div class="geex-content__todo__list__single__text justify-content-center">
                                        <span class="geex-content__todo__list__single__subtitle">Data</span>
                                    </div>

                                    <div class="geex-content__todo__list__single__text justify-content-center">
                                        <span class="geex-content__todo__list__single__subtitle">Assinatura</span>
                                    </div>

                                    <div class="geex-content__todo__list__single__text justify-content-center">
                                        <span class="geex-content__todo__list__single__subtitle">Status</span>
                                    </div>

                                    <div class="geex-content__todo__list__single__text justify-content-center">
                                        <span class="geex-content__todo__list__single__subtitle">Mais</span>
                                    </div>
                                </div>
                                @foreach ($newsCompanions as $companion)
                                    @foreach ($companion->subscribeds as $subscribed)                                        
                                        <div class="geex-content__todo__list__single text-center gap-0">
                                            <div class="geex-content__todo__list__single__author justify-content-start" style="width: 20%">                                                
                                                <img src="{{ $companion->path_file_profile ? asset('storage/' . $companion->path_file_profile) : asset('build/admin/images/userblock.png') }}" alt="{{$companion->name}}" 
                                                style="border-radius: 10px;width: 50px;height: 50px;object-fit: cover;object-position: top center;">                                               
                                                
                                                <span class="geex-content__todo__list__single__subtitle">{{$companion->name}}</span>
                                            </div>

                                            <div class="geex-content__todo__list__single__text justify-content-center align-items-center">
                                                <span class="geex-content__todo__list__single__subtitle">{{$companion->created_at->format('d/m/Y')}}</span>
                                            </div>

                                            <div class="geex-content__todo__list__single__text justify-content-center align-items-center">
                                                <span class="geex-content__todo__list__single__subtitle">{{$subscribed->plan->name}} - R${{ number_format($subscribed->plan->price, 2, ',', '.') }}</span>
                                            </div>

                                            <div class="geex-content__todo__list__single__text justify-content-center align-items-center">
                                                @switch($subscribed->status)
                                                    @case('paid')
                                                        <span class="geex-badge geex-badge--success-transparent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M12 1.00003C9.82441 1.00003 7.69767 1.64517 5.88873 2.85386C4.07979 4.06256 2.66989 5.78053 1.83733 7.79051C1.00477 9.8005 0.786929 12.0122 1.21137 14.146C1.6358 16.2798 2.68345 18.2398 4.22183 19.7782C5.76021 21.3166 7.72022 22.3642 9.85401 22.7887C11.9878 23.2131 14.1995 22.9953 16.2095 22.1627C18.2195 21.3301 19.9375 19.9202 21.1462 18.1113C22.3549 16.3024 23 14.1756 23 12C22.9966 9.0837 21.8365 6.28781 19.7744 4.22566C17.7122 2.1635 14.9163 1.00347 12 1.00003V1.00003ZM12 21C10.22 21 8.47992 20.4722 6.99987 19.4833C5.51983 18.4943 4.36628 17.0887 3.68509 15.4442C3.0039 13.7996 2.82567 11.99 3.17294 10.2442C3.5202 8.49839 4.37737 6.89474 5.63604 5.63607C6.89472 4.3774 8.49836 3.52023 10.2442 3.17296C11.99 2.8257 13.7996 3.00393 15.4442 3.68511C17.0887 4.3663 18.4943 5.51986 19.4832 6.9999C20.4722 8.47994 21 10.22 21 12C20.9974 14.3862 20.0483 16.6738 18.361 18.3611C16.6738 20.0483 14.3861 20.9974 12 21V21Z" fill="#00A389"/>
                                                                <path d="M16.3236 8.76298L11.0296 13.616L8.70659 11.293C8.61435 11.1975 8.504 11.1213 8.382 11.0689C8.25999 11.0165 8.12877 10.9889 7.99599 10.9877C7.86321 10.9866 7.73154 11.0119 7.60864 11.0622C7.48574 11.1124 7.37409 11.1867 7.2802 11.2806C7.18631 11.3745 7.11205 11.4861 7.06177 11.609C7.01149 11.7319 6.98619 11.8636 6.98734 11.9964C6.9885 12.1292 7.01608 12.2604 7.06849 12.3824C7.1209 12.5044 7.19708 12.6147 7.29259 12.707L10.2926 15.707C10.4748 15.8892 10.7204 15.9941 10.9781 15.9997C11.2357 16.0053 11.4856 15.9112 11.6756 15.737L17.6756 10.237C17.8711 10.0577 17.9873 9.8081 17.9987 9.54312C18.0102 9.27813 17.9159 9.01945 17.7366 8.82398C17.5573 8.62852 17.3077 8.51228 17.0427 8.50084C16.7777 8.4894 16.5191 8.58369 16.3236 8.76298V8.76298Z" fill="#00A389"/>
                                                            </svg>
                                                            Pago
                                                        </span>
                                                        @break
                                                    @case('pending')
                                                        <span class="geex-badge geex-badge--warning-transparent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fd7e14">
                                                                <path d="M12 1.00003C9.82441 1.00003 7.69767 1.64517 5.88873 2.85386C4.07979 4.06256 2.66989 5.78053 1.83733 7.79051C1.00477 9.8005 0.786929 12.0122 1.21137 14.146C1.6358 16.2798 2.68345 18.2398 4.22183 19.7782C5.76021 21.3166 7.72022 22.3642 9.85401 22.7887C11.9878 23.2131 14.1995 22.9953 16.2095 22.1627C18.2195 21.3301 19.9375 19.9202 21.1462 18.1113C22.3549 16.3024 23 14.1756 23 12C22.9966 9.0837 21.8365 6.28781 19.7744 4.22566C17.7122 2.1635 14.9163 1.00347 12 1.00003V1.00003ZM12 21C10.22 21 8.47992 20.4722 6.99987 19.4833C5.51983 18.4943 4.36628 17.0887 3.68509 15.4442C3.0039 13.7996 2.82567 11.99 3.17294 10.2442C3.5202 8.49839 4.37737 6.89474 5.63604 5.63607C6.89472 4.3774 8.49836 3.52023 10.2442 3.17296C11.99 2.8257 13.7996 3.00393 15.4442 3.68511C17.0887 4.3663 18.4943 5.51986 19.4832 6.9999C20.4722 8.47994 21 10.22 21 12C20.9974 14.3862 20.0483 16.6738 18.361 18.3611C16.6738 20.0483 14.3861 20.9974 12 21V21Z" fill="#fd7e14"/>
                                                                <path d="M16.3236 8.76298L11.0296 13.616L8.70659 11.293C8.61435 11.1975 8.504 11.1213 8.382 11.0689C8.25999 11.0165 8.12877 10.9889 7.99599 10.9877C7.86321 10.9866 7.73154 11.0119 7.60864 11.0622C7.48574 11.1124 7.37409 11.1867 7.2802 11.2806C7.18631 11.3745 7.11205 11.4861 7.06177 11.609C7.01149 11.7319 6.98619 11.8636 6.98734 11.9964C6.9885 12.1292 7.01608 12.2604 7.06849 12.3824C7.1209 12.5044 7.19708 12.6147 7.29259 12.707L10.2926 15.707C10.4748 15.8892 10.7204 15.9941 10.9781 15.9997C11.2357 16.0053 11.4856 15.9112 11.6756 15.737L17.6756 10.237C17.8711 10.0577 17.9873 9.8081 17.9987 9.54312C18.0102 9.27813 17.9159 9.01945 17.7366 8.82398C17.5573 8.62852 17.3077 8.51228 17.0427 8.50084C16.7777 8.4894 16.5191 8.58369 16.3236 8.76298V8.76298Z" fill="#fd7e14"/>
                                                            </svg>
                                                            Pendente
                                                        </span>
                                                        @break
                                                    @case('failed')
                                                        <span class="geex-badge geex-badge--danger-transparent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#dc3545">
                                                                <path d="M12 1.00003C9.82441 1.00003 7.69767 1.64517 5.88873 2.85386C4.07979 4.06256 2.66989 5.78053 1.83733 7.79051C1.00477 9.8005 0.786929 12.0122 1.21137 14.146C1.6358 16.2798 2.68345 18.2398 4.22183 19.7782C5.76021 21.3166 7.72022 22.3642 9.85401 22.7887C11.9878 23.2131 14.1995 22.9953 16.2095 22.1627C18.2195 21.3301 19.9375 19.9202 21.1462 18.1113C22.3549 16.3024 23 14.1756 23 12C22.9966 9.0837 21.8365 6.28781 19.7744 4.22566C17.7122 2.1635 14.9163 1.00347 12 1.00003V1.00003ZM12 21C10.22 21 8.47992 20.4722 6.99987 19.4833C5.51983 18.4943 4.36628 17.0887 3.68509 15.4442C3.0039 13.7996 2.82567 11.99 3.17294 10.2442C3.5202 8.49839 4.37737 6.89474 5.63604 5.63607C6.89472 4.3774 8.49836 3.52023 10.2442 3.17296C11.99 2.8257 13.7996 3.00393 15.4442 3.68511C17.0887 4.3663 18.4943 5.51986 19.4832 6.9999C20.4722 8.47994 21 10.22 21 12C20.9974 14.3862 20.0483 16.6738 18.361 18.3611C16.6738 20.0483 14.3861 20.9974 12 21V21Z" fill="#dc3545"/>
                                                                <path d="M16.3236 8.76298L11.0296 13.616L8.70659 11.293C8.61435 11.1975 8.504 11.1213 8.382 11.0689C8.25999 11.0165 8.12877 10.9889 7.99599 10.9877C7.86321 10.9866 7.73154 11.0119 7.60864 11.0622C7.48574 11.1124 7.37409 11.1867 7.2802 11.2806C7.18631 11.3745 7.11205 11.4861 7.06177 11.609C7.01149 11.7319 6.98619 11.8636 6.98734 11.9964C6.9885 12.1292 7.01608 12.2604 7.06849 12.3824C7.1209 12.5044 7.19708 12.6147 7.29259 12.707L10.2926 15.707C10.4748 15.8892 10.7204 15.9941 10.9781 15.9997C11.2357 16.0053 11.4856 15.9112 11.6756 15.737L17.6756 10.237C17.8711 10.0577 17.9873 9.8081 17.9987 9.54312C18.0102 9.27813 17.9159 9.01945 17.7366 8.82398C17.5573 8.62852 17.3077 8.51228 17.0427 8.50084C16.7777 8.4894 16.5191 8.58369 16.3236 8.76298V8.76298Z" fill="#dc3545"/>
                                                            </svg>
                                                            Falha
                                                        </span>
                                                        @break
                                                    @default                                                        
                                                @endswitch
                                            </div>
                                            <div class="geex-content__todo__list__single__text justify-content-center align-items-center">
                                                <form action="{{route('admin.companion.search')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="name" value="{{$companion->name}}">
                                                    <button type="submit" class="geex-btn geex-btn--primary w-auto justify-content-center">Ver</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach                                    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
    .bt{
        all: unset; 
        cursor: pointer; 
    }
    #panel-developer{
        display: none
    }
</style>
@endsection
