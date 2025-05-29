@extends('client.core.client')

@section('content')
<section id="bg-geral" style="background: #000;">
    
    <section id="section-two" class="section-two">
        <div class="section-two__head">
            <h2 class="section-two__head__title">Seu Feed</h2>
        </div>
        <div class="swiper section-two__swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two__one.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_two.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_three.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_four.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_five.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_six.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_seven.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_eight.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_five.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two__one.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_two.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_three.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two__one.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_two.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_three.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_four.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_five.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_six.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_seven.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_eight.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_five.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two__one.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_two.png')}}" alt="">
                    </div>
                </div>
                <div class="swiper-slide section-two__box__item">
                    <div class="section-two__box__item__image">
                        <img src="{{asset('build/client/images/section-two_three.png')}}" alt="">
                    </div>
                </div>
            </div>
            <!-- Botões de navegação -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Paginação opcional -->
            <div class="swiper-pagination"></div>
        </div>

        <div id="section-feed" class="section-feed"> 
            <div class="section-feed__box">
                <div class="section-feed__box__left">
                    <div class="swiper section-feed__box__left__top__swiper section-feed__box__left__top">
                        <div class="section-feed__box__left__top__head">
                            <h3 class="section-feed__box__left__top__head__title">Sugestões para Você</h3>
                        </div>
                        <div class="swiper-wrapper">
                            @foreach ($suggestionscompanions as $suggestionscompanion)                                
                                <div class="swiper-slide section-feed__box__left__item"> 
                                    <div class="section-feed__box__left__item__row">
                                        <div class="section-feed__box__left__item__row__image">
                                            @if (!empty($suggestionscompanion->path_file_profile))                                
                                            <img src="{{asset('storage/'. $suggestionscompanion->path_file_profile)}}" alt="">
                                            @else
                                            <img src="{{asset('build/client/images/section-three__one.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="section-feed__box__left__item__row__information">
                                            <h3 class="section-feed__box__left__item__row__information__title">{{$suggestionscompanion->name}}</h3>
                                            <p class="section-feed__box__left__item__row__information__description">{{'@'.isset($suggestionscompanion->mention)?$suggestionscompanion->mention:''}}</p>
                                        </div>
                                    </div>
                                    <div class="section-feed__box__left__item__emphasis">
                                        @foreach ($suggestionscompanion->post as $post)   
                                            @foreach ($post->postFile->filter(fn($file) => $file->active == 1) as $postFile)                                                
                                                <div class="section-feed__box__left__item__emphasis__image">
                                                    <img src="{{asset('storage/'. $postFile->file)}}" alt="{{$suggestionscompanion->name}}">
                                                </div>
                                            @endforeach                                       
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if(isset($ads['feed_left']) && $ads['feed_left']->isNotEmpty())
                        @foreach($ads['feed_left'] as $ad)
                            <div id="announcement-two" class="announcement-two">
                                <a href="">
                                    <img src="{{ asset('storage/' . $ad->path_image) }}" alt="Anúncio Companion">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="section-feed__box__right">
                    @foreach ($posts as $post)
                        <div class="section-feed__box__right__item">                            
                            <div class="section-feed__box__right__item__row">
                                <div class="section-feed__box__right__item__row__image">
                                    <img src="{{asset('storage/'. $post->companion->path_file_profile)}}" alt="{{$post->companion->name}}">
                                </div>
                                <div class="section-feed__box__right__item__row__information">
                                    <div class="section-feed__box__right__item__row__information__more">
                                        <a href="{{ route('client.post', ['slug' => $post->companion->slug]) }}">
                                            <h3 class="section-feed__box__right__item__row__information__more__title">{{$post->companion->name}}</h3>
                                            <h4 class="section-feed__box__right__item__row__information__more__hours"> {{ $timeDifferences[$post->id] ?? 'pouco tempo' }}</h4>
                                        </a>
                                    </div>
                                    <p class="section-feed__box__right__item__row__information__description">{{'@'.isset($post->companion->mention)?$post->companion->mention:''}}</p>
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
                                        @foreach ($post->postFile->filter(fn($file) => $file->active == 1) as $pathFile){{-- O método filter(fn($file) => $file->active == 1) filtra apenas os arquivos onde active é 1. --}}
                                            @php
                                                $mimeTypePath = $pathFile->file;
                                                $galleryUrl = asset('storage/' . $mimeTypePath); 
                                                $mimeType = Storage::mimeType($mimeTypePath);
                                            @endphp
                                            @if (str_starts_with($mimeType, 'image/'))
                                                <div class="swiper-slide">
                                                    <div class="section-feed__box__right__item__gallery__image">
                                                        <a href="#lightbox-escorts" data-fancybox="lightbox-escorts">
                                                            <img src="{{ asset('storage/' . $pathFile->file) }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @elseif(str_starts_with($mimeType, 'video/'))
                                                <div class="swiper-slide">
                                                    <div class="section-feed__box__right__item__gallery__video">
                                                        <a href="{{ $galleryUrl }}" data-fancybox="">
                                                            <img src="{{ asset('build/client/images/play.png') }}" class="play-icon">
                                                            @if ($post->apparence_type === 'one')
                                                                <img src="{{ asset('storage/'.$post->companion->path_file_horizontal_cover) }}" class="video-thumb">
                                                            @elseif ($post->apparence_type === 'two')
                                                                <img src="{{ asset('storage/'.$post->companion->path_file_profile) }}" class="video-thumb">
                                                            @else
                                                                <img src="{{ asset('storage/'.$post->companion->path_file_vertical_cover) }}" class="video-thumb">
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="section-feed__box__right__item__like">
                                <button 
                                    class="liked-post-companion" 
                                    data-url="{{ route('admin.client.likedPost', $post->id) }}" 
                                    data-post-id="{{ $post->companion_id }}"
                                    style="all: unset; cursor: pointer; position: relative;"
                                >
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div style="padding-left: 2vw; padding-right: 2vw;">
        @if(isset($ads['feed_footer']) && $ads['feed_footer']->isNotEmpty())
            @foreach($ads['feed_footer'] as $ad)
                <div id="announcement" class="announcement">
                    <a href="">
                        <img src="{{ asset('storage/' . $ad->path_image) }}" alt="Anúncio Companion">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection

<div id="lightbox-escorts" class="lightbox-escorts" style="display: none;">
    <img src="{{asset('build/client/images/lightbox-escorts.png')}}" class="lightbox-escorts__firula" alt="">
    <div class="lightbox-escorts__row">
        <div class="lightbox-escorts__row__image">
            <img src="{{asset('build/client/images/section-feed__emphasis__main.png')}}" alt="">
        </div>
        <div class="lightbox-escorts__row__information">
            <div class="lightbox-escorts__row__information__more">
                <h3 class="lightbox-escorts__row__information__more__title">Alexandra Pimentel</h3>
                <h4 class="lightbox-escorts__row__information__more__hours">há 12 horas</h4>
            </div>
            <p class="lightbox-escorts__row__information__description">@alepimentel</p>
        </div> 
    </div>
    <div class="lightbox-escorts__gallery">
        <img src="{{asset('build/client/images/gallery__one.png')}}" alt="">
    </div>
</div>