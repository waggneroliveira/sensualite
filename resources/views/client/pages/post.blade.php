@extends('client.core.client')

@section('content')
    <section id="section-post" class="section-post">
        <div class="section-post__banner">
            <img src="{{asset('storage/'. $companion->path_file_horizontal_cover)}}" alt="">
        </div>
        <div class="section-post__box">
            <div class="section-post__box__left">
                <div class="section-post__box__left__top">
                    <div class="section-post__box__left__head">
                        <div class="section-post__box__left__head__image">
                            <img src="{{asset('storage/'. $companion->path_file_profile)}}" alt="">
                        </div>
                        <h3 class="section-post__box__left__head__title">{{ $companion->name}}</h3>
                        <h4 class="section-post__box__left__head__subtitle">{{'@'.isset($companion->mention)?$companion->mention:''}}</h4>
                        <div class="section-post__box__left__head__information">
                            <h3 class="section-post__box__left__head__information__year">{{ $companion->age}} anos</h3>
                            <h4 class="section-post__box__left__head__information__city">{{ ucfirst(strtolower($companion->city)) }}-Ba</h4>
                        </div>
                        <div class="section-post__box__left__head__information__additional">
                            <div class="section-post__box__left__head__information__additional__item">
                                <h3 class="section-post__box__left__head__information__additional__item__title">{{ isset($follows[$companion->id]) ? $follows[$companion->id]->count() : '0' }}</h3>
                                <h4 class="section-post__box__left__head__information__additional__item__subtitle">Seguidores</h4>
                            </div>
                            <div class="section-post__box__left__head__information__additional__item">
                                <h3 class="section-post__box__left__head__information__additional__item__title count-like-post">{{ isset($likeds[$companion->id]) ? $likeds[$companion->id]: '' }}</h3>
                                <h4 class="section-post__box__left__head__information__additional__item__subtitle">Curtidas</h4>
                            </div>
                            <div class="section-post__box__left__head__information__additional__item">
                                <h3 class="section-post__box__left__head__information__additional__item__title">{{ $publishes ?? '0' }}</h3>
                                <h4 class="section-post__box__left__head__information__additional__item__subtitle">Publicações</h4>
                            </div>
                        </div>
                        <div class="section-post__box__left__head__paragraph"> {!!$companion->description!!} </div>
                        <div class="section-post__box__left__head__button">
                            <div class="section-post__box__left__head__button__seguir">
                                <form action="{{route('admin.client.follow', $companion->id)}}" method="post">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="companionId" value="{{ $companion->id }}">
                                    <button type="submit" class="follow-companion section-post__box__left__head__button__seguir__cta">
                                        <!-- Verificação do estado do coração (curtido ou não) -->
                                        @if (!empty($followByClient)) 
                                        Seguindo
                                        @else
                                        Seguir
                                        @endif
                                        
                                    </button>
                                </form>    
                                
                                <form action="{{route('admin.dashboard.client.liked', $companion->id)}}" method="POST">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="companionId" value="{{ $companion->id }}">
                                    
                                    <button type="submit" class="liked-companion"
                                        data-id="{{ $companion->id }}"
                                        data-liked="{{ isset($likedByClient[$companion->id]) && $likedByClient[$companion->id] ? '1' : '0' }}">
                                        <!-- Verificação do estado do coração (curtido ou não) -->                                        
                                        @if (isset($likedByClient[$companion->id]) && $likedByClient[$companion->id]) 
                                            <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                                <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                            </svg>
                                        @else
                                            <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                            <a href="#" class="section-post__box__left__head__button__cta">Ver Reviews</a>
                        </div>
                    </div>
                    <div class="section-post__box__left__profile">
                        <div class="section-post__box__left__profile__head">
                            <h3 class="section-post__box__left__profile__head__title">Perfil</h3>
                        </div>
                        <div class="section-post__box__left__profile__information">
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Saio com:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">{{ $companion->go_out_with}}</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Idade:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">{{ $companion->age}} anos</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Tipo:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">{{ $companion->type}}</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Biotipo:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">{{ $companion->body_type}}</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Altura:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">{{ $companion->height}}m</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Peso:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">{{ $companion->weight}} kg</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Pés:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">35</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Olhos:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">{{$companion->eye_color}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="section-post__box__left__specialties">
                        <div class="section-post__box__left__specialties__head">
                            <h3 class="section-post__box__left__specialties__head__title">Categorias e Especialidades</h3>
                        </div>
                        <div class="section-post__box__left__specialties__item"> 
                            @foreach ($companion->categories as $category) 
                                <a href="{{ route('client.escort.category', $category->slug) }}" class="section-post__box__left__specialties__item__cta">{{$category->title}}</a>
                                
                            @endforeach
                        </div>
                    </div>
                    <div class="section-post__box__left__service">
                        <div class="section-post__box__left__service__head">
                            <h3 class="section-post__box__left__service__head__title">Atendimento</h3>
                        </div> 
                        <div class="section-post__box__left__service__information">
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Horário:</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">{{ $companion->availability}}</h4>
                            </div>
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Atendo em:</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">{{ $companion->meeting_places}}</h4>
                            </div>
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Cachê:</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">R$ {{ number_format($companion->rate, 2, ',', '.') }}/hora</h4>
                            </div>
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Disponível para Viagem?</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">{{ $companion->available_for_travel ? 'Sim' : 'Não'}}</h4>
                            </div>
                        </div>
                    </div>
                    @if (Auth::guard('cliente')->check())
                        @if (!$conversationExists)
                            <!-- Botão para abrir o Lightbox -->
                            <div class="section-post__box__left__button">
                                <a href="#" class="section-post__box__left__button__cta" id="openLightbox">Entre em Contato</a>
                            </div>

                            <!-- Lightbox -->
                            <div id="contactLightbox" class="lightbox">
                                <div class="lightbox-content">
                                    <span class="close-lightbox">&times;</span>
                                    <h5>Entre em Contato</h5>
                                    <span>Digite sua mensagem e clique em enviar, você será redirecionado para continuar a conversa.</span>
                                    <form id="contactForm" action="{{route('admin.dashboard.client.chat.start')}}" method="post">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="companion_id" value="{{$companion->id}}">
                                        <div class="mb-3">
                                            <label for="chat-message" class="form-label">Mensagem</label>
                                            <textarea class="form-control" id="chat-message" name="message" rows="4" placeholder="Digite sua mensagem aqui." required></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary" id="closeLightbox">Cancelar</button>
                                            <button type="submit" class="btn btn-primary ms-2">Enviar</button>
                                        </div>
                                        <p>As mensagens trocadas por meio deste formulário são confidenciais e acessíveis apenas pela pessoa anunciada e por quem envia a mensagem. Prezamos pelo sigilo e respeito mútuo em todas as interações.</p>
                                    </form>
                                </div>
                            </div>
                            @else
                            <div class="section-post__box__left__button">
                                <a href="{{ route('admin.dashboard.client.chat', ['conversationId' => $conversationId]) }}" class="section-post__box__left__button__cta">Ver conversa</a>
                            </div>
                        @endif
                    @endif

                    <!-- CSS para estilizar o Lightbox -->
                    <style>
                        /* Fundo escuro transparente */
                        .lightbox {
                            display: none;
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: rgba(0, 0, 0, 0.7);
                            justify-content: center;
                            align-items: center;
                            z-index: 1000;
                        }

                        /* Conteúdo do Lightbox */
                        .lightbox-content {
                            background: linear-gradient(180deg, #000 45.21%, #4D182E 115.7%);
                            padding: 20px;
                            border-radius: 10px;
                            width: 400px;
                            text-align: center;
                            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
                            position: relative;
                        }

                        /* Botão de fechar */
                        .close-lightbox {
                            position: absolute;
                            top: 10px;
                            right: 15px;
                            font-size: 40px !important;
                            cursor: pointer;
                        }

                        /* Animação de fade-in */
                        .lightbox.show {
                            display: flex;
                            animation: fadeIn 0.3s ease-in-out;
                        }

                        @keyframes fadeIn {
                            from { opacity: 0; transform: scale(0.95); }
                            to { opacity: 1; transform: scale(1); }
                        }
                    </style>

                    <!-- JavaScript para controlar o Lightbox -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const lightbox = document.getElementById('contactLightbox');
                            const openBtn = document.getElementById('openLightbox');
                            const closeBtn = document.querySelector('.close-lightbox');
                            const closeLightbox = document.getElementById('closeLightbox');

                            // Abrir Lightbox
                            openBtn.addEventListener('click', function (e) {
                                e.preventDefault();
                                lightbox.classList.add('show');
                            });

                            // Fechar Lightbox
                            closeBtn.addEventListener('click', function () {
                                lightbox.classList.remove('show');
                            });

                            closeLightbox.addEventListener('click', function () {
                                lightbox.classList.remove('show');
                            });

                            // Fechar ao clicar fora
                            window.addEventListener('click', function (e) {
                                if (e.target === lightbox) {
                                    lightbox.classList.remove('show');
                                }
                            });

                            // Enviar formulário
                            // document.getElementById('contactForm').addEventListener('submit', function (event) {
                            //     event.preventDefault();
                            //     alert('Mensagem enviada com sucesso!');
                            //     lightbox.classList.remove('show');
                            //     document.getElementById('message').value = '';
                            // });
                        });
                    </script>

                </div>

                {{-- Anúncios para a Posição Companion --}}
                @if(isset($ads['companion_left']) && $ads['companion_left']->isNotEmpty())
                    @foreach($ads['companion_left'] as $index => $ad)
                        <div class="announcement-two" data-index="{{ $index }}">
                            <a href="">
                                <img src="{{ asset('storage/' . $ad->path_image) }}" alt="Anúncio Companion">
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="section-post__box__right">
                <div class="section-post__box__right__gallery">
                    @foreach ($companion->gallery as $gallery)
                        @foreach ($gallery->galleryFile->filter(fn($file) => $file->active == 1) as $galleryFile)                            
                            <div class="section-post__box__right__gallery__item">
                                <a href="#lightbox-escorts-{{$galleryFile->id}}" data-fancybox="lightbox-escorts">
                                    <div class="section-post__box__right__gallery__item__image">
                                        <img src="{{asset('storage/'. $galleryFile->file)}}" alt="">
                                    </div>
                                </a>
                                <div id="lightbox-escorts-{{$galleryFile->id}}" class="lightbox-escorts" style="display: none;">
                                    <img src="{{asset('build/client/images/lightbox-escorts.png')}}" class="lightbox-escorts__firula" alt="">
                                    <div class="lightbox-escorts__row">
                                        <div class="lightbox-escorts__row__image">
                                            <img src="{{asset('storage/'. $companion->path_file_profile)}}" alt="">
                                        </div>
                                        <div class="lightbox-escorts__row__information">
                                            <div class="lightbox-escorts__row__information__more">
                                                <h3 class="lightbox-escorts__row__information__more__title">{{$companion->name}}</h3>
                                                <h4 class="lightbox-escorts__row__information__more__hours"> {{$diffInHoursGallery}} </h4>
                                            </div>
                                            <p class="lightbox-escorts__row__information__description">{{'@'.isset($companion->mention)?$companion->mention:''}}</p>
                                        </div> 
                                    </div>
                                    <div class="lightbox-escorts__gallery">
                                        <img src="{{asset('storage/'. $galleryFile->file)}}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="section-post__box__right__head">
                    <div class="section-post__box__right__head__left">
                        <h3 class="section-post__box__right__head__left__title">Feed</h3>
                    </div>
                    <div class="section-post__box__right__head__right">
                        <ul>
                            <li>
                                <a href="#" class="tab-link active" data-target="section-feed">Postagens</a>
                            </li>
                            <li>
                                <a href="#" class="tab-link" data-target="midia">Mídia</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="section-feed" class="section-feed tab-content"> 
                    <div class="section-feed__box__right">
                        @foreach ($companion->post as $post)
                            <div class="section-feed__box__right__item">
                                <div class="section-feed__box__right__item__row">
                                    <div class="section-feed__box__right__item__row__image">
                                        <img src="{{asset('storage/'. $companion->path_file_profile)}}" alt="{{$companion->name}}">
                                    </div>
                                    <div class="section-feed__box__right__item__row__information">
                                        <div class="section-feed__box__right__item__row__information__more">
                                            <h3 class="section-feed__box__right__item__row__information__more__title">{{$companion->name}}</h3>
                                            <h4 class="section-feed__box__right__item__row__information__more__hours">{{ $timeDifferences[$post->id] ?? 'pouco tempo' }}</h4>
                                        </div>
                                        <p class="section-feed__box__right__item__row__information__description">{{'@'.isset($companion->mention)?$companion->mention:''}}</p>
                                    </div> 
                                </div>
                                <h2 class="section-feed__box__right__item__title">{!!$post->text!!}</h2>
                                <div class="section-feed__box__right__item__gallery {{ isset($post->apparence_type) ? 
                                    ($post->apparence_type == 'one' ? 'maximum' : 
                                    ($post->apparence_type == 'two' ? 'medium' : 
                                    ($post->apparence_type == 'threee' ? 'minimum' : ''))) 
                                    : '' 
                                }}">
                                    <div class="section-feed__box__right__item__gallery__swiper swiper">
                                        <div class="swiper-wrapper">                                            
                                            <!-- SLIDE I (Imagem) -->
                                            @foreach ($post->postFile->filter(fn($file) => $file->active == 1) as $pathFile){{-- O método filter(fn($file) => $file->active == 1) filtra apenas os arquivos onde active é 1. --}}
                                                @php
                                                    $mimeTypePath = $pathFile->file;
                                                    $galleryUrl = asset('storage/' . $mimeTypePath); 
                                                    $mimeType = Storage::mimeType($mimeTypePath);
                                                @endphp
                                                @if (str_starts_with($mimeType, 'image/'))
                                                    <div class="swiper-slide">
                                                        <div class="section-feed__box__right__item__gallery__image">
                                                            <a href="#lightbox-escort-{{$pathFile->id}}" data-fancybox="lightbox-escort">
                                                                <img src="{{ asset('storage/' . $pathFile->file) }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @elseif(str_starts_with($mimeType, 'video/'))
                                                    <div class="swiper-slide">
                                                        <div class="section-feed__box__right__item__gallery__video">
                                                            <a href="{{ $galleryUrl }}" data-fancybox="">
                                                                <img src="{{ asset('build/client/images/play.png') }}" class="play-icon">
                                                                @if ($companion->post->contains('apparence_type', 'one'))
                                                                    <img src="{{ asset('storage/'.$companion->path_file_horizontal_cover) }}" class="video-thumb">
                                                                @elseif ($companion->post->contains('apparence_type', 'two'))
                                                                    <img src="{{ asset('storage/'.$companion->path_file_profile) }}" class="video-thumb">
                                                                @else
                                                                    <img src="{{ asset('storage/'.$companion->path_file_vertical_cover) }}" class="video-thumb">
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div id="lightbox-escort-{{$pathFile->id}}" class="lightbox-escorts" style="display: none;">
                                                    <img src="{{asset('build/client/images/lightbox-escorts.png')}}" class="lightbox-escorts__firula" alt="">
                                                    <div class="lightbox-escorts__row">
                                                        <div class="lightbox-escorts__row__image">
                                                            <img src="{{asset('build/client/images/section-feed__emphasis__main.png')}}" alt="">
                                                        </div>
                                                        <div class="lightbox-escorts__row__information">
                                                            <div class="lightbox-escorts__row__information__more">
                                                                <h3 class="lightbox-escorts__row__information__more__title">{{$companion->name}}</h3>
                                                                <h4 class="lightbox-escorts__row__information__more__hours">{{ $timeDifferences[$post->id] ?? 'pouco tempo' }}</h4>
                                                            </div>
                                                            <p class="lightbox-escorts__row__information__description">{{'@'.isset($companion->mention)?$companion->mention:''}}</p>
                                                        </div> 
                                                    </div>
                                                    <div class="lightbox-escorts__gallery">
                                                        <img src="{{ asset('storage/' . $pathFile->file) }}" alt="{{$companion->name}}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="section-feed__box__right__item__like">
                                    <form action="{{ route('admin.client.likedPost', $post->id) }}" method="POST">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="postId" value="{{ $post->companion_id }}">
        
                                        <button type="submit" class="liked-companion">
                                            <!-- Verificação do estado do coração (curtido ou não) -->
                                            @if (isset($likedPostByClient[$post->id]) && $likedPostByClient[$post->id])
                                                <svg width="42" height="39" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                                    <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                                </svg>
                                            @else
                                                <svg width="42" height="39" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                                </svg>
                                            @endif
        
                                            <h3 class="section-feed__box__right__item__like__title">
                                                {{ $likedPostCounts[$post->id] ?? '' }}
                                            </h3> 
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="midia" class="section-post__box__right__midia tab-content" style="display: none;">                    
                    @foreach ($midiaGalleries as $galleryFileMidia) 
                        @foreach ($galleryFileMidia->postFile as $files)
                            @php
                                $mimeTypePath = $files->file;
                                $galleryUrl = asset('storage/' . $mimeTypePath); 
                                $mimeType = Storage::mimeType($mimeTypePath);
                            @endphp
                            @if (str_starts_with($mimeType, 'image/'))
                                <div class="section-post__box__right__midia__item">
                                    <div class="section-post__box__right__midia__item__image">
                                        <a href="{{asset('storage/' .$files->file)}}" data-fancybox="">
                                            <img src="{{asset('storage/' .$files->file)}}">
                                        </a>
                                    </div>
                                </div>
                            @elseif(str_starts_with($mimeType, 'video/'))
                                <div class="section-post__box__right__midia__item">
                                    <div class="section-post__box__right__midia__item__video">
                                        <a href="{{asset('storage/' .$files->file)}}" data-fancybox="">
                                            <img class="video-thumb" src="{{asset('storage/' .$files->file)}}">
                                            <img class="play-icon" src="{{ asset('build/client/images/play.png') }}">
                                        </a>
                                    </div>
                                </div>
                            @endif                            
                        @endforeach
                    @endforeach                    
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const tabs = document.querySelectorAll(".tab-link");
                        const sections = document.querySelectorAll(".tab-content");
                
                        tabs.forEach(tab => {
                            tab.addEventListener("click", function(e) {
                                e.preventDefault();
                
                                // Esconde todas as seções
                                sections.forEach(section => section.style.display = "none");
                                // Remove a classe ativa de todos os links
                                tabs.forEach(link => link.classList.remove("active"));
                                // Adiciona a classe ativa ao link clicado
                                this.classList.add("active");
                                // Exibe a seção correspondente
                                const target = document.getElementById(this.dataset.target);
                                if (target) {
                                    target.style.display = "flex";
                                }
                            });
                        });
                    });
                </script>                
            </div>
        </div>
        
        <div class="section-post__content">
            <div class="section-post__content__head">
                <h3 class="section-post__content__head__title">Reviews</h3>
                @if ($feedbacks->count() > 0)                    
                    <h4 class="section-post__content__head__subtitle">{{ $feedbacks->count() . ' Avaliações'}}</h4>
                @endif
            </div>
            @foreach ($feedbacks as $feedback)
                <div class="section-post__content__assessment">
                    <div class="section-post__content__assessment__top">
                        <div class="section-post__content__assessment__top__user">
                            <div class="section-post__content__assessment__top__user__left">
                                <div class="section-post__content__assessment__top__user__left__item">
                                    <div class="section-post__content__assessment__top__user__left__item__image">
                                        <img src="{{asset('build/client/images/usuario.png')}}" alt="">
                                    </div>
                                    <div class="section-post__content__assessment__top__user__left__item__information">
                                        <h3 class="section-post__content__assessment__top__user__left__item__information__title">{{$feedback->surname}}</h3>
                                        <h4 class="section-post__content__assessment__top__user__left__item__information__date">{{$feedback->created_at->format('d/m/Y')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="sectio-post__content__assessment__top__user__right">
                                <div class="section-post__content__assessment__top__user__right__item">
                                    @if (!empty($feedback->like))                                        
                                        <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                            <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                        </svg>
                                        @else
                                        <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                        </svg>
                                    @endif
                                    <div class="section-post__content__assessment__top__user__right__item__image">
                                        <img src="{{asset('storage/' .$companion->path_file_profile)}}" alt="{{$companion->name}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-post__content__assessment__top__service">
                            <h3 class="section-post__content__assessment__top__service__title">Atendimento:</h3>
                            <div class="section-post__content__assessment__top__service__location">
                                <img src="{{asset('build/client/images/location.png')}}" alt="">
                                <h4 class="section-post__content__assessment__top__service__location__title">{{$feedback->city}}</h4>
                            </div>
                        </div>
                        <div class="section-post__content__assessment__top__star">
                            <h3 class="section-post__content__assessment__top__star__amount">{{$feedback->rating}}</h3>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedback->rating)
                                    <!-- Estrela preenchida -->
                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                                    </svg>
                                @else
                                    <!-- Estrela vazia -->
                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#9D9D9D"/>
                                    </svg>
                                @endif
                            @endfor
                            <h4 class="section-post__content__assessment__top__star__title">
                                @switch($feedback->rating)
                                    @case(1)
                                        Péssimo
                                        @break
                                    @case(2)
                                        Ruim
                                        @break
                                    @case(3)
                                        Bom
                                        @break
                                    @case(4)
                                        Muito bom
                                        @break
                                    @case(5)
                                        Excelente
                                        @break
                                    @default
                                        
                                @endswitch
                            </h4>
                        </div>
                        <p class="section-post__content__assessment__top__paragraph">{{$feedback->message}}</p>
                    </div>
                    @if (isset($feedback->response) && $feedback->response != null)
                        <div class="section-post__content__assessment__bottom">
                            <h3 class="section-post__content__assessment__bottom__title">Resposta:</h3>
                            <div class="section-post__content__assessment__bottom__item">
                                <div class="section-post__content__assessment__bottom__item__image">
                                    <img src="{{asset('storage/' .$feedback->companion->path_file_profile)}}" alt="{{$feedback->companion->name}}">
                                </div>
                                <div class="section-post__content__assessment__bottom__item__information">
                                    <h3 class="section-post__content__assessment__bottom__item__information__title">{{$feedback->companion->name}}</h3>
                                    <h4 class="section-post__content__assessment__bottom__item__information__date">{{'@'.isset($feedback->companion) && $feedback->companion->mention !== null ? $feedback->companion->mention:''}}</h4>
                                </div>
                            </div>
                            <div class="section-post__content__assessment__bottom__paragraph">{!!$feedback->response!!}</div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @if (!$feedbackChecked)
            <div class="section-post__formulario">
                <div class="section-post__formulario__head">
                    <h3 class="section-post__formulario__head__title">Escreva a sua avaliação</h3>
                    <p class="section-post__formulario__head__paragraph">Lorem ipsum dolor sit amet consectetur. Feugiat fermentum imperd</p>
                </div>
                <form action="{{route('admin.client.feedback.store', ['id' => $companion->id])}}" method="POST">
                    @csrf
                    
                    <div class="section-post__formulario__assessment">
                        <div class="section-post__formulario__assessment__voting">
                            <h3 class="section-post__formulario__assessment__voting__title">Estrelas:</h3>
                            <div class="section-post__formulario__assessment__voting__star">
                                <h3 class="section-post__formulario__assessment__voting__star__amount"></h3>

                                <div class="rating-container">
                                    <div class="stars">
                                        <input type="radio" id="star5" name="rating" value="5">
                                        <label for="star5">
                                            <svg viewBox="0 0 18 17" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"/>
                                            </svg>
                                        </label>
                                        
                                        <input type="radio" id="star4" name="rating" value="4">
                                        <label for="star4">
                                            <svg viewBox="0 0 18 17" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"/>
                                            </svg>
                                        </label>

                                        <input type="radio" id="star3" name="rating" value="3">
                                        <label for="star3">
                                            <svg viewBox="0 0 18 17" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"/>
                                            </svg>
                                        </label>

                                        <input type="radio" id="star2" name="rating" value="2">
                                        <label for="star2">
                                            <svg viewBox="0 0 18 17" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"/>
                                            </svg>
                                        </label>

                                        <input type="radio" id="star1" name="rating" value="1" >
                                        <label for="star1">
                                            <svg viewBox="0 0 18 17" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"/>
                                            </svg>
                                        </label>
                                    </div>
                                    <!-- <h4 class="rating-text section-post__formulario__assessment__voting__star__title">Escolha uma nota</h4> -->
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                    const ratingTexts = ["Péssimo", "Ruim", "Bom", "Muito Bom", "Excelente"];
                                    const stars = document.querySelectorAll('.stars input');
                                    const ratingNumber = document.querySelector('.section-post__formulario__assessment__voting__star__amount');
                                    const ratingText = document.querySelector('.rating-text');

                                    // Define a exibição inicial baseado no input já marcado
                                    const checkedStar = document.querySelector('input[name="rating"]:checked');
                                    if (checkedStar) {
                                        ratingNumber.textContent = checkedStar.value;
                                        ratingText.textContent = ratingTexts[checkedStar.value - 1];
                                    }

                                    // Atualiza quando o usuário escolhe uma nova estrela
                                    stars.forEach(star => {
                                        star.addEventListener('change', function () {
                                            ratingNumber.textContent = this.value;
                                            ratingText.textContent = ratingTexts[this.value - 1];
                                        });
                                    });
                                });

                                </script>

                                <style>
                                    .rating-container {
                                        display: flex;
                                        align-items: center;
                                        gap: 10px;
                                    }
                                
                                    .stars {
                                        display: flex;
                                        flex-direction: row-reverse;
                                        gap: 5px;
                                    }
                                
                                    .stars input {
                                        display: none;
                                    }
                                
                                    .stars label {
                                        cursor: pointer;
                                    }
                                
                                    .stars label svg {
                                        width: 24px;
                                        height: 24px;
                                        fill: #9D9D9D;
                                        transition: fill 0.3s ease;
                                    }
                                
                                    .stars input:checked ~ label svg,
                                    .stars input:hover ~ label svg {
                                        fill: #FFDB12; 
                                    }
                                
                                    .rating-text {
                                        font-size: 16px;
                                        font-weight: bold;
                                    }
                                </style>
                            </div>
                        </div>
                        <!-- <div class="surname">
                            <label for="surname" style="color: #FFF;">Apelido:</label>
                            @php
                                $name = isset(Auth::guard('cliente')->user()->name) && Auth::guard('cliente')->user()->name !== null ? Auth::guard('cliente')->user()->name : '';
                            @endphp
                            <select id="anonymous" name="surname" required>
                                <option value="" disabled selected>Selecione uma opção</option>
                                @if (!empty($name))
                                    <option value="{{$name}}">{{$name}}</option>
                                @endif
                                <option value="Anônimo">Anonymous</option>
                            </select>
                        </div> -->
                        <div class="surname">
                            <input type="checkbox" name="surname" value="Anônimo">
                            <label for="surname" style="color: #FFF;">Anônimo</label>
                        </div>
                        <input name="city" type="text" placeholder="Cidade de Atentimento" required>
                    </div>
                    <textarea name="message" id="mensagem" placeholder="Mensagem"></textarea>
                    <div class="section-post__formulario__privacy">
                        <input type="checkbox">
                        <label for="">Aceito os termos descritos na <a href="#">Política de Privacidade</a></label>
                    </div>
                    <button type="submite">Enviar</button>
                </form>
            </div>
        @endif
        
        <div style="padding-right: 2.7vw;">
            @if(isset($ads['companion_footer']) && $ads['companion_footer']->isNotEmpty())
                @foreach($ads['companion_footer'] as $index => $ad)
                    <div class="announcement" data-index="{{ $index }}">
                        <a href="">
                            <img src="{{ asset('storage/' . $ad->path_image) }}" alt="Anúncio Companion">
                        </a>
                    </div>
                @endforeach
            @endif
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Selecionar os anúncios
                    let adsGroupOne = document.querySelectorAll('.announcement');
                    let adsGroupTwo = document.querySelectorAll('.announcement-two');
                
                    let totalAdsGroupOne = adsGroupOne.length;
                    let totalAdsGroupTwo = adsGroupTwo.length;
                
                    let currentIndexGroupOne = Math.floor(Math.random() * totalAdsGroupOne); // Pega um aleatório inicial para o grupo 1
                    let currentIndexGroupTwo = Math.floor(Math.random() * totalAdsGroupTwo); // Pega um aleatório inicial para o grupo 2
                
                    // Função para exibir o anúncio no grupo 1
                    function showAdGroupOne(index) {
                        adsGroupOne.forEach(ad => ad.style.display = 'none'); // Esconde todos os anúncios do grupo 1
                        if (adsGroupOne[index]) {
                            adsGroupOne[index].style.display = 'block'; // Exibe o anúncio atual do grupo 1
                        }
                    }
                
                    // Função para exibir o anúncio no grupo 2
                    function showAdGroupTwo(index) {
                        adsGroupTwo.forEach(ad => ad.style.display = 'none'); // Esconde todos os anúncios do grupo 2
                        if (adsGroupTwo[index]) {
                            adsGroupTwo[index].style.display = 'block'; // Exibe o anúncio atual do grupo 2
                        }
                    }
                
                    // Exibir o primeiro anúncio aleatório de cada grupo
                    showAdGroupOne(currentIndexGroupOne);
                    showAdGroupTwo(currentIndexGroupTwo);
                
                    // Alternar entre os anúncios a cada 10 segundos (10000ms)
                    setInterval(() => {
                        // Alternar o índice dos anúncios do grupo 1
                        currentIndexGroupOne = (currentIndexGroupOne + 1) % totalAdsGroupOne; 
                        showAdGroupOne(currentIndexGroupOne);
                
                        // Alternar o índice dos anúncios do grupo 2
                        currentIndexGroupTwo = (currentIndexGroupTwo + 1) % totalAdsGroupTwo;
                        showAdGroupTwo(currentIndexGroupTwo);
                    }, 10000); // Intervalo de 10 segundos
                });
            </script>          
            <style>
                .announcement, .announcement-two {
                    display: none;
                }
            </style>
        </div>
    </section>

    <section id="section-three" class="section-three">
        <div class="section-three__head">
            <h2 class="section-three__head__title">Modelos Prive</h2>
        </div>
        <div class="swiper section-three__box__swiper section-three__box">
            <div class="swiper-wrapper">
                @foreach ($companions as $companion)
                    <div class="swiper-slide section-three__box__item">
                        <a href="{{ route('client.post', ['slug' => $companion->slug]) }}" class="link-full"></a>
                        <div class="section-three__box__item__like" style="z-index:11;">
                            <form action="{{ route('admin.dashboard.client.liked', $companion->id) }}" method="POST">
                                @csrf
                                @method('post')
                                <input type="hidden" name="companionId" value="{{ $companion->id }}">

                                <button type="submit" class="liked-companion">
                                    <!-- Verificação do estado do coração (curtido ou não) -->
                                    @if (isset($likedByClient[$companion->id]) && $likedByClient[$companion->id]) 
                                        <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                            <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                        </svg>
                                    @else
                                        <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                        </svg>
                                    @endif

                                    <h3 class="section-three__box__item__like__title">
                                        {{ $likedCountsAll[$companion->id] ?? '' }}
                                    </h3> 
                                </button>
                            </form>
                        </div>
                        <div class="section-three__box__item__image">
                            @if (!empty($companion->path_file_vertical_cover))
                                <img src="{{ asset('storage/' . $companion->path_file_vertical_cover) }}" alt="{{$companion->name}}">
                            @else
                                <img src="{{ asset('build/client/images/section-five__one.png') }}" alt="">
                            @endif                    
                        </div>
                        @if ($companion->companion_status_verification == 'approved')                                
                            <div class="section-three__box__item__checked">
                                <img src="{{ asset('build/client/images/checked.png') }}" alt="">
                            </div>
                        @endif
                        <div class="section-three__box__item__information">
                            <h3 class="section-three__box__item__information__title">{{ $companion->name }}</h3>
                            <h4 class="section-three__box__item__information__subtitle">
                                {{ isset($companion->mention) ? '@' . $companion->mention : '' }}
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
