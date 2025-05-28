@extends('client.core.client')

@section('content')
    <section id="section-post" class="section-post">
        <div class="section-post__banner">
            <img src="{{Vite::asset('resources/assets/client/images/section-post__banner.png')}}" alt="">
        </div>
        <div class="section-post__box">
            <div class="section-post__box__left">
                <div class="section-post__box__left__top">
                    <div class="section-post__box__left__head">
                        <div class="section-post__box__left__head__image">
                            <img src="{{Vite::asset('resources/assets/client/images/section-post__head.png')}}" alt="">
                        </div>
                        <h3 class="section-post__box__left__head__title">Alexandra Pimentel</h3>
                        <h4 class="section-post__box__left__head__subtitle">@alepimentel</h4>
                        <div class="section-post__box__left__head__information">
                            <h3 class="section-post__box__left__head__information__year">22 anos</h3>
                            <h4 class="section-post__box__left__head__information__city">Salvador-Ba</h4>
                        </div>
                        <div class="section-post__box__left__head__information__additional">
                            <div class="section-post__box__left__head__information__additional__item">
                                <h3 class="section-post__box__left__head__information__additional__item__title">250</h3>
                                <h4 class="section-post__box__left__head__information__additional__item__subtitle">Seguidores</h4>
                            </div>
                            <div class="section-post__box__left__head__information__additional__item">
                                <h3 class="section-post__box__left__head__information__additional__item__title">125</h3>
                                <h4 class="section-post__box__left__head__information__additional__item__subtitle">Curtidas</h4>
                            </div>
                            <div class="section-post__box__left__head__information__additional__item">
                                <h3 class="section-post__box__left__head__information__additional__item__title">84</h3>
                                <h4 class="section-post__box__left__head__information__additional__item__subtitle">Publicações</h4>
                            </div>
                        </div>
                        <p class="section-post__box__left__head__paragraph">“ Lorem ipsum dolor sit amet consectetur. Feugiat fermentum imperdiet non in scelerisque. Metus sit sit sed tortor. “</p>
                        <div class="section-post__box__left__head__button">
                            <div class="section-post__box__left__head__button__seguir">
                                <a href="#" class="section-post__box__left__head__button__seguir__cta">Seguir</a>
                                <img class="section-post__box__left__head__button__seguir__cta__image" src="{{Vite::asset('resources/assets/client/images/seguir__off.png')}}" alt="">
                                
                                <!-- <img class="section-post__box__left__head__button__seguir__cta__image" src="{{Vite::asset('resources/assets/client/images/seguir__on.png')}}" alt=""> -->
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
                                <h4 class="section-post__box__left__profile__information__item__subtitle">Homens, Mulheres e Casais</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Idade:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">22 anos</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Tipo:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">Loira</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Biotipo:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">Magra</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Altura:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">1,65m</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Peso:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">58 kg</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Pés:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">35</h4>
                            </div>
                            <div class="section-post__box__left__profile__information__item">
                                <h3 class="section-post__box__left__profile__information__item__title">Olhos:</h3>
                                <h4 class="section-post__box__left__profile__information__item__subtitle">Verdes</h4>
                            </div>
                        </div>
                    </div>
                    <div class="section-post__box__left__specialties">
                        <div class="section-post__box__left__specialties__head">
                            <h3 class="section-post__box__left__specialties__head__title">Categorias e Especialidades</h3>
                        </div>
                        <div class="section-post__box__left__specialties__item">
                            <a href="#" class="section-post__box__left__specialties__item__cta">24 h</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Namoradinha</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Fuma</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Dançarina</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Ménage</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">BDSM</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Sugar Baby</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Despedida de Solteiro</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Cam Girl</a>
                            <a href="#" class="section-post__box__left__specialties__item__cta">Massagem</a>
                        </div>
                    </div>
                    <div class="section-post__box__left__service">
                        <div class="section-post__box__left__service__head">
                            <h3 class="section-post__box__left__service__head__title">Atendimento</h3>
                        </div> 
                        <div class="section-post__box__left__service__information">
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Horário:</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">24 horas</h4>
                            </div>
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Horário:</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">24 horas</h4>
                            </div>
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Atendo em:</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">Flat Próprio, Hotéis, Motéis</h4>
                            </div>
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Cachê:</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">R$ 500,00/hora</h4>
                            </div>
                            <div class="section-post__box__left__service__information__item">
                                <h3 class="section-post__box__left__service__information__item__title">Disponível para Viagem?</h3>
                                <h4 class="section-post__box__left__service__information__item__subtitle">Sim</h4>
                            </div>
                        </div>
                    </div>
                    <div class="section-post__box__left__button">
                        <a href="" class="section-post__box__left__button__cta">Entre em Contato</a>
                    </div>
                </div>
                <div id="announcement-two" class="announcement-two">
                    <a href="#">
                        <img src="{{Vite::asset('resources/assets/client/images/bg-announcement__mobo.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="section-post__box__right">
                <div class="section-post__box__right__gallery">
                    <div class="section-post__box__right__gallery__item">
                        <a href="#lightbox-escorts" data-fancybox>
                            <div class="section-post__box__right__gallery__item__image">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="section-post__box__right__gallery__item">
                        <div class="section-post__box__right__gallery__item__image">
                            <img src="{{Vite::asset('resources/assets/client/images/gallery__two.png')}}" alt="">
                        </div>
                    </div>
                    <div class="section-post__box__right__gallery__item">
                        <div class="section-post__box__right__gallery__item__image">
                            <img src="{{Vite::asset('resources/assets/client/images/gallery__three.png')}}" alt="">
                        </div>
                    </div>
                    <div class="section-post__box__right__gallery__item">
                        <div class="section-post__box__right__gallery__item__image">
                            <img src="{{Vite::asset('resources/assets/client/images/gallery__four.png')}}" alt="">
                        </div>
                    </div>
                    <div class="section-post__box__right__gallery__item">
                        <div class="section-post__box__right__gallery__item__image">
                            <img src="{{Vite::asset('resources/assets/client/images/gallery__five.png')}}" alt="">
                        </div>
                    </div>
                    <div class="section-post__box__right__gallery__item">
                        <div class="section-post__box__right__gallery__item__image">
                            <img src="{{Vite::asset('resources/assets/client/images/gallery__six.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="section-post__box__right__head">
                    <div class="section-post__box__right__head__left">
                        <h3 class="section-post__box__right__head__left__title">Feed</h3>
                    </div>
                    <div class="section-post__box__right__head__right">
                        <ul>
                            <li>
                                <a href="">Postagens</a>
                            </li>
                            <li>
                                <a href="{{ route('client.media') }}">Mídia</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section-post__box__right__midia">
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__video">
                            <a href="{{Vite::asset('resources/assets/client/images/video.webm')}}" data-fancybox="">
                                <img class="video-thumb" src="{{ Vite::asset('resources/assets/client/images/gallery__one.png') }}">
                                <img class="play-icon" src="{{ Vite::asset('resources/assets/client/images/play.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__video">
                            <a href="{{Vite::asset('resources/assets/client/images/video.webm')}}" data-fancybox="">
                                <img class="video-thumb" src="{{ Vite::asset('resources/assets/client/images/gallery__one.png') }}">
                                <img class="play-icon" src="{{ Vite::asset('resources/assets/client/images/play.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__video">
                            <a href="{{Vite::asset('resources/assets/client/images/video.webm')}}" data-fancybox="">
                                <img class="video-thumb" src="{{ Vite::asset('resources/assets/client/images/gallery__one.png') }}">
                                <img class="play-icon" src="{{ Vite::asset('resources/assets/client/images/play.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__video">
                            <a href="{{Vite::asset('resources/assets/client/images/video.webm')}}" data-fancybox="">
                                <img class="video-thumb" src="{{ Vite::asset('resources/assets/client/images/gallery__one.png') }}">
                                <img class="play-icon" src="{{ Vite::asset('resources/assets/client/images/play.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__video">
                            <a href="{{Vite::asset('resources/assets/client/images/video.webm')}}" data-fancybox="">
                                <img class="video-thumb" src="{{ Vite::asset('resources/assets/client/images/gallery__one.png') }}">
                                <img class="play-icon" src="{{ Vite::asset('resources/assets/client/images/play.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__video">
                            <a href="{{Vite::asset('resources/assets/client/images/video.webm')}}" data-fancybox="">
                                <img class="video-thumb" src="{{ Vite::asset('resources/assets/client/images/gallery__one.png') }}">
                                <img class="play-icon" src="{{ Vite::asset('resources/assets/client/images/play.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__video">
                            <a href="{{Vite::asset('resources/assets/client/images/video.webm')}}" data-fancybox="">
                                <img class="video-thumb" src="{{ Vite::asset('resources/assets/client/images/gallery__one.png') }}">
                                <img class="play-icon" src="{{ Vite::asset('resources/assets/client/images/play.png') }}">
                            </a>
                        </div>
                    </div>
                    <div class="section-post__box__right__midia__item">
                        <div class="section-post__box__right__midia__item__image">
                            <a href="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}" data-fancybox="">
                                <img src="{{Vite::asset('resources/assets/client/images/gallery__one.png')}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-post__content">
            <div class="section-post__content__head">
                <h3 class="section-post__content__head__title">Reviews</h3>
                <h4 class="section-post__content__head__subtitle">15 Avaliações</h4>
            </div>
            <div class="section-post__content__assessment">
                <div class="section-post__content__assessment__top">
                    <div class="section-post__content__assessment__top__user">
                        <div class="section-post__content__assessment__top__user__left">
                            <div class="section-post__content__assessment__top__user__left__item">
                                <div class="section-post__content__assessment__top__user__left__item__image">
                                    <img src="{{Vite::asset('resources/assets/client/images/usuario.png')}}" alt="">
                                </div>
                                <div class="section-post__content__assessment__top__user__left__item__information">
                                    <h3 class="section-post__content__assessment__top__user__left__item__information__title">Leandro</h3>
                                    <h4 class="section-post__content__assessment__top__user__left__item__information__date">04/11/2024</h4>
                                </div>
                            </div>
                        </div>
                        <div class="sectio-post__content__assessment__top__user__right">
                            <div class="section-post__content__assessment__top__user__right__item">
                                <!-- <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                </svg> -->
                                <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                    <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                </svg>
                                <div class="section-post__content__assessment__top__user__right__item__image">
                                    <img src="{{Vite::asset('resources/assets/client/images/usuario__foto.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-post__content__assessment__top__service">
                        <h3 class="section-post__content__assessment__top__service__title">Atendimento:</h3>
                        <div class="section-post__content__assessment__top__service__location">
                            <img src="{{Vite::asset('resources/assets/client/images/location.png')}}" alt="">
                            <h4 class="section-post__content__assessment__top__service__location__title">Porto Alegre - RS</h4>
                        </div>
                    </div>
                    <div class="section-post__content__assessment__top__star">
                        <h3 class="section-post__content__assessment__top__star__amount">4</h3>
                        <!-- ESTRELA ON -->
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <!-- ESTRELA OFF -->
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#9D9D9D"/>
                        </svg>
                        <h4 class="section-post__content__assessment__top__star__title">Satisfeito</h4>
                    </div>
                    <p class="section-post__content__assessment__top__paragraph">Pontual, educada, atenciosa e linda. Sempre bem vestida e cheirosa, sorrindente e boa de conversa.</p>
                    <p class="section-post__content__assessment__top__paragraph">Essa é a Pati.</p>
                </div>
                <div class="section-post__content__assessment__bottom">
                    <h3 class="section-post__content__assessment__bottom__title">Resposta:</h3>
                    <div class="section-post__content__assessment__bottom__item">
                        <div class="section-post__content__assessment__bottom__item__image">
                            <img src="{{Vite::asset('resources/assets/client/images/usuario__foto.png')}}" alt="">
                        </div>
                        <div class="section-post__content__assessment__bottom__item__information">
                            <h3 class="section-post__content__assessment__bottom__item__information__title">Alexandra Pimentel</h3>
                            <h4 class="section-post__content__assessment__bottom__item__information__date">@alepimentel</h4>
                        </div>
                    </div>
                    <p class="section-post__content__assessment__bottom__paragraph">Cliente querido, educado e que torna o atendimento muito leve! Muito obrigada pela preferência de sempre! Aguardo ansiosamente pelo próximo encontro! Mil beijos <3</p>
                </div>
            </div>
            <div class="section-post__content__assessment">
                <div class="section-post__content__assessment__top">
                    <div class="section-post__content__assessment__top__user">
                        <div class="section-post__content__assessment__top__user__left">
                            <div class="section-post__content__assessment__top__user__left__item">
                                <div class="section-post__content__assessment__top__user__left__item__image">
                                    <img src="{{Vite::asset('resources/assets/client/images/usuario.png')}}" alt="">
                                </div>
                                <div class="section-post__content__assessment__top__user__left__item__information">
                                    <h3 class="section-post__content__assessment__top__user__left__item__information__title">Leandro</h3>
                                    <h4 class="section-post__content__assessment__top__user__left__item__information__date">04/11/2024</h4>
                                </div>
                            </div>
                        </div>
                        <div class="sectio-post__content__assessment__top__user__right">
                            <div class="section-post__content__assessment__top__user__right__item">
                                <!-- <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                </svg> -->
                                <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                    <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                </svg>
                                <div class="section-post__content__assessment__top__user__right__item__image">
                                    <img src="{{Vite::asset('resources/assets/client/images/usuario__foto.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-post__content__assessment__top__service">
                        <h3 class="section-post__content__assessment__top__service__title">Atendimento:</h3>
                        <div class="section-post__content__assessment__top__service__location">
                            <img src="{{Vite::asset('resources/assets/client/images/location.png')}}" alt="">
                            <h4 class="section-post__content__assessment__top__service__location__title">Porto Alegre - RS</h4>
                        </div>
                    </div>
                    <div class="section-post__content__assessment__top__star">
                        <h3 class="section-post__content__assessment__top__star__amount">4</h3>
                        <!-- ESTRELA ON -->
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <!-- ESTRELA OFF -->
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#9D9D9D"/>
                        </svg>
                        <h4 class="section-post__content__assessment__top__star__title">Satisfeito</h4>
                    </div>
                    <p class="section-post__content__assessment__top__paragraph">Pontual, educada, atenciosa e linda. Sempre bem vestida e cheirosa, sorrindente e boa de conversa.</p>
                    <p class="section-post__content__assessment__top__paragraph">Essa é a Pati.</p>
                </div>
            </div>
            <div class="section-post__content__assessment">
                <div class="section-post__content__assessment__top">
                    <div class="section-post__content__assessment__top__user">
                        <div class="section-post__content__assessment__top__user__left">
                            <div class="section-post__content__assessment__top__user__left__item">
                                <div class="section-post__content__assessment__top__user__left__item__image">
                                    <img src="{{Vite::asset('resources/assets/client/images/usuario.png')}}" alt="">
                                </div>
                                <div class="section-post__content__assessment__top__user__left__item__information">
                                    <h3 class="section-post__content__assessment__top__user__left__item__information__title">Leandro</h3>
                                    <h4 class="section-post__content__assessment__top__user__left__item__information__date">04/11/2024</h4>
                                </div>
                            </div>
                        </div>
                        <div class="sectio-post__content__assessment__top__user__right">
                            <div class="section-post__content__assessment__top__user__right__item">
                                <!-- <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                </svg> -->
                                <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                    <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                </svg>
                                <div class="section-post__content__assessment__top__user__right__item__image">
                                    <img src="{{Vite::asset('resources/assets/client/images/usuario__foto.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-post__content__assessment__top__service">
                        <h3 class="section-post__content__assessment__top__service__title">Atendimento:</h3>
                        <div class="section-post__content__assessment__top__service__location">
                            <img src="{{Vite::asset('resources/assets/client/images/location.png')}}" alt="">
                            <h4 class="section-post__content__assessment__top__service__location__title">Porto Alegre - RS</h4>
                        </div>
                    </div>
                    <div class="section-post__content__assessment__top__star">
                        <h3 class="section-post__content__assessment__top__star__amount">4</h3>
                        <!-- ESTRELA ON -->
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                        </svg>
                        <!-- ESTRELA OFF -->
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#9D9D9D"/>
                        </svg>
                        <h4 class="section-post__content__assessment__top__star__title">Satisfeito</h4>
                    </div>
                    <p class="section-post__content__assessment__top__paragraph">Pontual, educada, atenciosa e linda. Sempre bem vestida e cheirosa, sorrindente e boa de conversa.</p>
                    <p class="section-post__content__assessment__top__paragraph">Essa é a Pati.</p>
                </div>
            </div>
            <div class="section-post__content__button">
                <a href="#" class="section-post__content__button__cta">Escreva a sua avaliação</a>
            </div>
        </div>
        <div class="section-post__formulario">
            <div class="section-post__formulario__head">
                <h3 class="section-post__formulario__head__title">Escreva a sua avaliação</h3>
                <p class="section-post__formulario__head__paragraph">Lorem ipsum dolor sit amet consectetur. Feugiat fermentum imperd</p>
            </div>
            <form action="">
                <div class="section-post__formulario__assessment">
                    <div class="section-post__formulario__assessment__voting">
                        <h3 class="section-post__formulario__assessment__voting__title">Estrelas:</h3>
                        <div class="section-post__formulario__assessment__voting__star">
                            <h3 class="section-post__formulario__assessment__voting__star__amount">4</h3>
                            <!-- ESTRELA ON -->
                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                            </svg>
                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                            </svg>
                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                            </svg>
                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                            </svg>
                            <!-- ESTRELA OFF -->
                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#9D9D9D"/>
                            </svg>
                            <h4 class="section-post__formulario__assessment__voting__star__title">Satisfeito</h4>
                        </div>
                    </div>
                    <input type="text" placeholder="Cidade de Atentimenro">
                </div>
                <textarea name="mensagem" id="mensagem" placeholder="Mensagem"></textarea>
                <div class="section-post__formulario__privacy">
                    <input type="checkbox">
                    <label for="">Aceito os termos descritos na <a href="#">Política de Privacidade</a></label>
                </div>
                <button type="submite">Enviar</button>
            </form>
        </div>
        <div style="padding-right: 2.7vw;">
            <div id="announcement" class="announcement">
                <a href="#">
                    <img src="{{Vite::asset('resources/assets/client/images/bg-announcement.png')}}" alt="">
                </a>
            </div>
        </div>
    </section>

    <section id="section-three" class="section-three">
        <div class="section-three__head">
            <h2 class="section-three__head__title">Modelos Prive</h2>
        </div>
        <div class="section-three__box">
            <div class="section-three__box__item">
                <div class="section-three__box__item__like">
                    <!-- ON -->
                    <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                        <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                    </svg>

                    <!-- OFF -->
                    <!-- <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                    </svg> -->
                    <h3 class="section-three__box__item__like__title">56</h3>
                </div>
                <div class="section-three__box__item__image">
                    <img src="{{Vite::asset('resources/assets/client/images/section-three__one.png')}}" alt="">
                </div>
                <div class="section-three__box__item__checked">
                    <img src="{{Vite::asset('resources/assets/client/images/checked.png')}}" alt="">
                </div>
                <div class="section-three__box__item__information">
                    <h3 class="section-three__box__item__information__title">Marcelinha</h3>
                    <h4 class="section-three__box__item__information__subtitle">@alepimentel</h4>
                </div>
            </div>
            <div class="section-three__box__item">
                <div class="section-three__box__item__like">
                    <!-- ON -->
                    <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                        <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                    </svg>

                    <!-- OFF -->
                    <!-- <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                    </svg> -->
                    <h3 class="section-three__box__item__like__title">56</h3>
                </div>
                <div class="section-three__box__item__image">
                    <img src="{{Vite::asset('resources/assets/client/images/section-three__two.png')}}" alt="">
                </div>
                <div class="section-three__box__item__checked">
                    <img src="{{Vite::asset('resources/assets/client/images/checked.png')}}" alt="">
                </div>
                <div class="section-three__box__item__information">
                    <h3 class="section-three__box__item__information__title">Marcelinha</h3>
                    <h4 class="section-three__box__item__information__subtitle">@alepimentel</h4>
                </div>
            </div>
            <div class="section-three__box__item">
                <div class="section-three__box__item__like">
                    <!-- ON -->
                    <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                        <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                    </svg>

                    <!-- OFF -->
                    <!-- <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                    </svg> -->
                    <h3 class="section-three__box__item__like__title">56</h3>
                </div>
                <div class="section-three__box__item__image">
                    <img src="{{Vite::asset('resources/assets/client/images/section-three__three.png')}}" alt="">
                </div>
                <div class="section-three__box__item__checked">
                    <img src="{{Vite::asset('resources/assets/client/images/checked.png')}}" alt="">
                </div>
                <div class="section-three__box__item__information">
                    <h3 class="section-three__box__item__information__title">Marcelinha</h3>
                    <h4 class="section-three__box__item__information__subtitle">@alepimentel</h4>
                </div>
            </div>
            <div class="section-three__box__item">
                <div class="section-three__box__item__like">
                    <!-- ON -->
                    <svg width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                        <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                    </svg>

                    <!-- OFF -->
                    <!-- <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                    </svg> -->
                    <h3 class="section-three__box__item__like__title">56</h3>
                </div>
                <div class="section-three__box__item__image">
                    <img src="{{Vite::asset('resources/assets/client/images/section-three__four.png')}}" alt="">
                </div>
                <div class="section-three__box__item__checked">
                    <img src="{{Vite::asset('resources/assets/client/images/checked.png')}}" alt="">
                </div>
                <div class="section-three__box__item__information">
                    <h3 class="section-three__box__item__information__title">Marcelinha</h3>
                    <h4 class="section-three__box__item__information__subtitle">@alepimentel</h4>
                </div>
            </div>
        </div>
    </section>
@endsection