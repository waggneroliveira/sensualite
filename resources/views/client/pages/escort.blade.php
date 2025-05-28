@extends('client.core.client')

@section('content')
<section id="bg-geral">

    <section id="section-four" class="section-four">
        <div class="section-four__head">
            <h2 class="section-four__head__title two">Modelos Prive</h2>
            <div class="section-four__head__search">
                <form>
                    <div class="section-four__head__search__filter">
                        <img src="{{asset('build/client/images/filter.png')}}" alt="">
                        <select name="filtrar">
                            <option value="">Filtrar</option>
                            <option value="livros">Filtro I</option>
                            <option value="eletronicos">Filtro II</option>
                            <option value="roupas">Filtro III</option>
                        </select>
                    </div>
                    
                    <div class="section-four__head__search__order">
                        <img src="{{asset('build/client/images/order.png')}}" alt="">
                        <select name="ordenar">
                            <option value="">Ordenar</option>
                            <option value="preco">Ordem I</option>
                            <option value="popularidade">Ordem II</option>
                            <option value="avaliacao">Ordem III</option>
                        </select>
                    </div>
                    <button type="submit">
                        <img src="{{asset('build/client/images/pesquisa.png')}}" alt="">
                    </button>
                </form>
            </div>
        </div>

        <div class="section-four__box">
            @php
                $adsIndex = 0;
                $adsCount = $ads->count();
            @endphp

            @foreach ($companions as $index => $companion)
                
                <div class="section-four__box__item">
                    <a href="{{ route('client.post', ['slug' => $companion->slug]) }}" class="link-full"></a>
                    <div class="section-three__box__item__like" style="z-index:11;">
                        <form action="{{route('admin.dashboard.client.liked', $companion->id)}}" method="POST">
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
                                {{ isset($likeds[$companion->id]) ? $likeds[$companion->id] : '' }}
                            </h3>                              
                            </button>
                        </form>
                    </div>
                    <div class="section-four__box__item__image">
                        @if (isset($companion) && !empty($companion->path_file_horizontal_cover))                                
                            <img src="{{asset('storage/'. $companion->path_file_vertical_cover)}}" alt="">
                            @else
                            <img src="{{asset('build/client/images/section-five__one.png')}}" alt="">
                        @endif
                    </div>
                    @if ($companion->companion_status_verification == 'approved')                                
                        <div class="section-three__box__item__checked">
                            <img src="{{ asset('build/client/images/checked.png') }}" alt="">
                        </div>
                    @endif
                    <div class="section-four__box__item__information">
                        <h3 class="section-four__box__item__information__title">{{$companion->name}}</h3>
                        <h4 class="section-four__box__item__information__subtitle">@alepimentel</h4>
                    </div>
                </div>

                 {{-- Insere um anúncio a cada 8 acompanhantes, se houver anúncios disponíveis --}}
                 @if (($index + 1) % 8 == 0 && $adsIndex < $adsCount)
                    @php
                        $ad = isset($adscompanions[$adsIndex]) ? $adscompanions[$adsIndex] : null;
                        $slug = null;

                        if ($ad && !empty($ad->companion_id)) {
                            $relatedCompanion = $companions->firstWhere('id', $ad->companion_id);
                            $slug = $relatedCompanion ? $relatedCompanion->slug : null;
                        }                        
                    @endphp

                    @if ($ad && !empty($ad->path_image))
                        <div id="announcement" class="announcement">                               
                            <a href="">
                                <img src="{{ asset('storage/' . $ad->path_image) }}" alt="">
                            </a>
                        </div>
                        @php $adsIndex++; @endphp
                    @endif
                @endif

            @endforeach
        </div>
    </section>

    <section id="section-five" class="section-five">
        <div class="section-five__box">
            @foreach ($categories as $category)
                <div class="section-five__box__item">
                    <a href="{{ route('client.escort.category', ['category' => $category->slug]) }}" class="link-full"></a>

                    <div class="section-five__box__item__image">
                        {{-- <img src="{{asset('storage/' . $category->path_image)}}" alt=""> --}}
                    </div>
                    <h3 class="section-five__box__item__title">{{$category->title}}</h3>
                </div>
            @endforeach
        </div>

        @if(isset($ads['companion_footer']) && $ads['companion_footer']->isNotEmpty())
            @foreach($ads['companion_footer'] as $ad)
                <div class="announcement">
                    <a href="">
                        <img src="{{ asset('storage/' . $ad->path_image) }}" alt="Anúncio Companion">
                    </a>
                </div>
            @endforeach
        @endif
    </section>

</section>
@endsection