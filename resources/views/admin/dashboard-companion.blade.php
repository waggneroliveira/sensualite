@extends('admin.core.companion')
@section('content')
    @php
        $user = Auth::guard('acompanhante')->user();
        $isCourtesy = Auth::guard('acompanhante')->user()->is_courtesy;
        $hasActiveSubscription = $user->hasActiveSubscription();
        $imagePath = Auth::guard('acompanhante')->user()->path_file_profile;
        if ($imagePath != null) {
            $imagePath = asset('storage/'.$imagePath);
        }else{
            $imagePath = 'build/admin/images/userblock.png';
        }
    @endphp

    @include('admin.includes.header', [
        'titlePage' => 'Dashboard',
        'userName' => collect(explode(' ', Auth::guard('acompanhante')->user()->name))->slice(0, 2)->implode(' '),
        'userEmail' => Auth::guard('acompanhante')->user()->email,
        'messages' => '',
        'messageCount' => '3',
        'notifications' => '',
        'notificationsCount' => '4',
        'messages' => '',
        'src' => $imagePath,
        'link' => route('admin.dashboard.companion.profile.index'),
        'logout' => route('admin.dashboard.companion.logout'),

    ])

    <div class="geex-content__wrapper">
        <div class="geex-content__section-wrapper">
            <div class="geex-content__summary mb-5">
                @if (!$hasActiveSubscription && $isCourtesy == 0)
                    <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
                        <i class="uil uil-exclamation-triangle fs-4"></i>
                        <div>
                            Não identificamos o pagamento da renovação da sua assinatura em nossa plataforma.
                            Por favor, acesse a área de <strong>Assinaturas</strong> e realize o pagamento.
                        </div>
                    </div>
                @endif

                <div class="geex-content__summary__count flex-nowrap gap-3">
                    <div class="geex-content__summary__count__single sec-bg flex-fill p-15" style="width: 20%">
                        <div class="geex-content__summary__count__single__content">
                            <h4 class="geex-content__summary__count__single__title">Ensaio Ativa</h4>
                            <p class="geex-content__summary__count__single__subtitle">{{isset($approvedGallery) && $approvedGallery != '' ? $approvedGallery->title : 'Nenhum ensaio ativo'}}</p>
                        </div>
                        <div class="geex-content__summary__count__single__icon">
                            <i class="uil-images"></i>
                        </div>
                    </div>
                    <div class="geex-content__summary__count__single body-bg flex-fill p-15" style="width: 20%">
                        <div class="geex-content__summary__count__single__content">
                            <h4 class="geex-content__summary__count__single__title">Pendente</h4>
                            <p class="geex-content__summary__count__single__subtitle">{{isset($pendingGallery) && $pendingGallery != '' ? $pendingGallery->title : 'Nenhum ensaio pendente'}}</p>
                        </div>
                        <div class="geex-content__summary__count__single__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M15.9997 1.33321C13.0989 1.33321 10.2632 2.19339 7.85132 3.80498C5.4394 5.41658 3.55953 7.7072 2.44945 10.3872C1.33936 13.0672 1.04891 16.0161 1.61483 18.8612C2.18075 21.7063 3.57761 24.3196 5.62878 26.3708C7.67995 28.4219 10.2933 29.8188 13.1384 30.3847C15.9834 30.9506 18.9324 30.6602 21.6124 29.5501C24.2924 28.44 26.583 26.5602 28.1946 24.1482C29.8062 21.7363 30.6664 18.9007 30.6664 15.9999C30.6618 12.1114 29.1151 8.38358 26.3655 5.63404C23.616 2.8845 19.8881 1.33779 15.9997 1.33321ZM15.9997 27.9999C13.6263 27.9999 11.3062 27.2961 9.33284 25.9775C7.35945 24.6589 5.82138 22.7848 4.91313 20.5921C4.00488 18.3994 3.76724 15.9866 4.23026 13.6588C4.69328 11.331 5.83617 9.19282 7.5144 7.51459C9.19263 5.83636 11.3308 4.69347 13.6586 4.23045C15.9864 3.76743 18.3992 4.00507 20.5919 4.91332C22.7846 5.82157 24.6587 7.35964 25.9773 9.33303C27.2959 11.3064 27.9997 13.6265 27.9997 15.9999C27.9958 19.1813 26.7303 22.2313 24.4807 24.4809C22.2311 26.7305 19.1811 27.996 15.9997 27.9999Z" fill="#464255"/>
                                <path d="M18.9433 7.55344C18.1839 7.05351 17.3108 6.75286 16.4046 6.67923C15.4984 6.60559 14.5882 6.76134 13.758 7.13211C12.8218 7.54836 12.0291 8.23143 11.4792 9.09587C10.9292 9.96031 10.6463 10.9677 10.666 11.9921V12.0001C10.6671 12.3537 10.8086 12.6925 11.0594 12.9417C11.3101 13.191 11.6497 13.3305 12.0033 13.3294C12.357 13.3284 12.6957 13.1869 12.945 12.9361C13.1943 12.6853 13.3337 12.3457 13.3327 11.9921C13.3191 11.4931 13.4503 11.0009 13.7106 10.5749C13.9709 10.149 14.3491 9.80763 14.7993 9.59211C15.224 9.3921 15.6928 9.30424 16.161 9.33692C16.6292 9.3696 17.0813 9.52172 17.474 9.77878C17.8246 10.0106 18.1154 10.3221 18.3227 10.6877C18.53 11.0533 18.6479 11.4627 18.6669 11.8826C18.6859 12.3025 18.6054 12.7209 18.4319 13.1037C18.2584 13.4865 17.9969 13.8229 17.6687 14.0854C16.756 14.7825 16.0122 15.6761 15.4923 16.7001C14.9725 17.7241 14.6901 18.852 14.666 20.0001C14.6666 20.1752 14.7017 20.3485 14.7693 20.51C14.8369 20.6715 14.9356 20.8182 15.0598 20.9416C15.1841 21.0649 15.3314 21.1626 15.4934 21.2291C15.6554 21.2955 15.8289 21.3294 16.004 21.3288C16.1791 21.3282 16.3524 21.2931 16.5139 21.2255C16.6754 21.1579 16.8221 21.0592 16.9454 20.935C17.0688 20.8107 17.1665 20.6634 17.233 20.5014C17.2994 20.3394 17.3333 20.1659 17.3327 19.9908C17.3582 19.2435 17.5512 18.5115 17.8974 17.8488C18.2435 17.186 18.734 16.6094 19.3327 16.1614C19.9879 15.6361 20.5098 14.9634 20.8559 14.1982C21.202 13.4329 21.3624 12.5968 21.3242 11.7578C21.286 10.9188 21.0502 10.1008 20.636 9.37015C20.2218 8.63954 19.6409 8.01708 18.9407 7.55344H18.9433Z" fill="#464255"/>
                                <path d="M16.0003 25.3335C16.7367 25.3335 17.3337 24.7365 17.3337 24.0001C17.3337 23.2637 16.7367 22.6668 16.0003 22.6668C15.2639 22.6668 14.667 23.2637 14.667 24.0001C14.667 24.7365 15.2639 25.3335 16.0003 25.3335Z" fill="#464255"/>
                            </svg>
                        </div>
                    </div>
                    <div class="geex-content__summary__count__single sec-bg flex-fill p-15" style="width: 20%">
                        <div class="geex-content__summary__count__single__content">
                            <h4 class="geex-content__summary__count__single__title">Seguidores</h4>
                            <p class="geex-content__summary__count__single__subtitle">{{ isset($follows[$user->id]) ? $follows[$user->id]->count() : '0' }} Seguidores</p>
                        </div>
                        <div class="geex-content__summary__count__single__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M15.9997 1.33322C13.0989 1.33322 10.2632 2.1934 7.85132 3.805C5.4394 5.41659 3.55953 7.70721 2.44945 10.3872C1.33936 13.0672 1.04891 16.0162 1.61483 18.8612C2.18075 21.7063 3.57761 24.3196 5.62878 26.3708C7.67995 28.422 10.2933 29.8188 13.1384 30.3847C15.9834 30.9506 18.9324 30.6602 21.6124 29.5501C24.2924 28.44 26.583 26.5602 28.1946 24.1482C29.8062 21.7363 30.6664 18.9007 30.6664 15.9999C30.6618 12.1115 29.1151 8.38359 26.3655 5.63405C23.616 2.88451 19.8881 1.3378 15.9997 1.33322ZM15.9997 27.9999C13.6263 27.9999 11.3062 27.2961 9.33284 25.9775C7.35945 24.6589 5.82138 22.7848 4.91313 20.5921C4.00488 18.3994 3.76724 15.9866 4.23026 13.6588C4.69328 11.331 5.83617 9.19283 7.5144 7.5146C9.19263 5.83637 11.3308 4.69348 13.6586 4.23046C15.9864 3.76744 18.3992 4.00508 20.5919 4.91333C22.7846 5.82158 24.6587 7.35965 25.9773 9.33304C27.2959 11.3064 27.9997 13.6265 27.9997 15.9999C27.9958 19.1813 26.7303 22.2313 24.4807 24.4809C22.2311 26.7305 19.1811 27.996 15.9997 27.9999Z" fill="#464255"/>
                                <path d="M16.0003 8.00001C15.6467 8.00001 15.3076 8.14048 15.0575 8.39053C14.8075 8.64058 14.667 8.97972 14.667 9.33334V18.6667C14.667 19.0203 14.8075 19.3594 15.0575 19.6095C15.3076 19.8595 15.6467 20 16.0003 20C16.354 20 16.6931 19.8595 16.9431 19.6095C17.1932 19.3594 17.3337 19.0203 17.3337 18.6667V9.33334C17.3337 8.97972 17.1932 8.64058 16.9431 8.39053C16.6931 8.14048 16.354 8.00001 16.0003 8.00001Z" fill="#464255"/>
                                <path d="M16.0003 23.9999C16.7367 23.9999 17.3337 23.403 17.3337 22.6666C17.3337 21.9302 16.7367 21.3332 16.0003 21.3332C15.2639 21.3332 14.667 21.9302 14.667 22.6666C14.667 23.403 15.2639 23.9999 16.0003 23.9999Z" fill="#464255"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="geex-content__section geex-content__section--transparent geex-content__todo">
                <div class="geex-content__todo__content tab-content custom-al" id="geex-todo-task-content">
                    <div class="tab-pane fade show active" id="geex-todo-task-content-important">
                        <div class="geex-content__todo__header custom-al">
                            <div class="d-flex flex-column col-12">
                                <div class="row">
                                    <div class="col-md-6 col-xl-2 mb-3">
                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            <a nofollow href="{{ route('admin.dashboard.companion.gallery.index') }}">
                                        @else
                                            <div style="pointer-events: none; opacity: 0.5; cursor: not-allowed;">
                                        @endif

                                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5">
                                                <i class="uil-images display-3"></i>
                                                <h5 class="text-white">Ensaios</h5>
                                            </div>

                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            </a>
                                        @else
                                            </div>
                                        @endif
                                    </div> <!-- end col -->

                                    {{-- Postagens --}}
                                    <div class="col-md-6 col-xl-2 mb-3">
                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            <a nofollow href="{{ route('admin.dashboard.companion.post.index') }}">
                                        @else
                                            <div style="pointer-events: none; opacity: 0.5; cursor: not-allowed;">
                                        @endif

                                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5">
                                                <i class="uil-image-check display-3"></i>
                                                <h5 class="text-white">Postagens</h5>
                                            </div>

                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            </a>
                                        @else
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Assinaturas --}}
                                    <div class="col-md-6 col-xl-2 mb-3">
                                        <a nofollow href="{{route('admin.dashboard.companion.plan')}}">
                                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5">
                                                <i class="uil uil-dollar-alt display-3"></i>
                                                <h5 class="text-white">Assinaturas</h5>
                                            </div>
                                        </a>
                                    </div> <!-- end col-->

                                    {{-- Perfil --}}
                                    <div class="col-md-6 col-xl-2 mb-3">
                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            <a nofollow href="{{ route('admin.dashboard.companion.profile.index') }}">
                                        @else
                                            <div style="pointer-events: none; opacity: 0.5; cursor: not-allowed;">
                                        @endif

                                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5">
                                                <i class="uil-user display-3"></i>
                                                <h5 class="text-white">Perfil</h5>
                                            </div>

                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            </a>
                                        @else
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Feedbacks --}}
                                    <div class="col-md-6 col-xl-2 mb-3">
                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            <a nofollow href="{{ route('admin.dashboard.feedback.index') }}">
                                        @else
                                            <div style="pointer-events: none; opacity: 0.5; cursor: not-allowed;">
                                        @endif

                                            <div class="d-flex flex-column gap-3 geex-btn geex-btn--primary justify-content-center py-5">
                                                <i class="uil-chat display-3"></i>
                                                <h5 class="text-white">Feedbacks</h5>
                                            </div>

                                        @if ($hasActiveSubscription || $isCourtesy == 1)
                                            </a>
                                        @else
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <h2 class="geex-content__header__title mt-5">Meus Contatos</h2>
                            </div>
                        </div>
                        <div class="tab-content geex-transaction-content">
                            <div class="tab-pane fade show active" id="todo_grid_content" role="tabpanel" aria-labelledby="todo_grid_tab">
                                <div class="row g-40">
                                    @foreach ($clients as $client)
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                            <!-- single contact grid area start -->
                                            <div class="single-contact-grid-area">
                                                <div class="top-area">
                                                    <div class="avatar">
                                                        <img src="{{asset('build/admin/images/contact/01.png')}}" alt="">
                                                    </div>
                                                    @if ($hasActiveSubscription || $isCourtesy == 1)
                                                        <div class="action-area">
                                                            <div class="single">
                                                                {{-- <i class="uil uil-heart"></i> --}}
                                                            </div>
                                                            <div class="single geex-content__chat__header__filter__btn">
                                                                <i class="uil uil-ellipsis-v"></i>
                                                            </div>
                                                            <div class="geex-content__chat__header__filter__content">
                                                                @if (Auth::guard('acompanhante')->check())
                                                                    <a class="text-white p-2" style="cursor:pointer;" href="{{ route('admin.dashboard.companion.chat', ['conversationId' => $client->conversationId]) }}">
                                                                        Ver Chat
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="details-area">
                                                    <h4 class="name">{{$client->name}}</h4>
                                                    <div class="contact-wrapper">
                                                        <a href="#" class="single-contact">
                                                            <i class="uil uil-bag"></i>
                                                            <p>Highspeed Studios</p>
                                                        </a>
                                                        <a href="#" class="single-contact">
                                                            <i class="uil uil-phone"></i>
                                                            <p>+012 345 689</p>
                                                        </a>
                                                        <a href="#" class="single-contact">
                                                            <i class="uil uil-envelope"></i>
                                                            <p>{{$client->email}}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single contact grid area end -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="geex-content__modal__form">
                <div class="geex-content__modal__form__header">
                    <h3 class="geex-content__modal__form__title">Adicionar Novo Contato</h3>
                    <button class="geex-content__modal__form__close">
                        <i class="uil-times"></i>
                    </button>
                </div>
                <form class="geex-content__modal__form__wrapper">
                    <div class="geex-content__modal__form__item">
                        <input type="text" name="geex-content__modal__form__name" class="geex-content__modal__form__input" placeholder="Name" />
                    </div>
                    <div class="geex-content__modal__form__item">
                        <input type="text" name="geex-content__modal__form__name" class="geex-content__modal__form__input" placeholder="Designation" />
                    </div>
                    <div class="geex-content__modal__form__item">
                        <input type="text" name="geex-content__modal__form__name" class="geex-content__modal__form__input" placeholder="Studio Name" />
                    </div>
                    <div class="geex-content__modal__form__item">
                        <input type="text" name="geex-content__modal__form__name" class="geex-content__modal__form__input" placeholder="Phone Number" />
                    </div>
                    <div class="geex-content__modal__form__item">
                        <input type="text" name="geex-content__modal__form__name" class="geex-content__modal__form__input" placeholder="Email Address" />
                    </div>
                    <div class="geex-content__modal__form__item">
                        <button type="submit" class="geex-content__modal__form__submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
