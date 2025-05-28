<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

        @vite([
            'resources/assets/client/scss/app.scss',
            'resources/assets/client/js/main.js',
        ])

        <title>Love Prime</title>
    </head>
    <body>
        <main>
            <!-- Pop-up -->
            @if(!request()->cookie('genero'))
                <div id="op" class="op">
                    <div class="popup-contentt">
                        <div class="form-containeer">
                            <form id="accept-btn" action="{{ route('client.set.genero') }}" method="post">
                                @csrf

                                <div class="tipo-conteudo">
                                    <div class="topo">
                                        <h3 class="title">Qual tipo de conteúdo<h4 class="subtitle">você deseja ver?</h4></h3>
                                    </div>

                                    <input type="hidden" name="genero" id="generoInput">
                                    <div class="engloba-box-conteudo">
                                        <div class="box-conteudo" onclick="setGenero('feminino')">
                                            <div class="image">
                                                <!-- Verificação do estado do coração selecionado -->
                                                <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                                </svg>

                                                <svg class="hover" width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                                    <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                                </svg>
                                            </div>
                                            <h3 class="title">Mulheres</h3>
                                        </div>

                                        <div class="box-conteudo" onclick="setGenero('masculino')">
                                            <div class="image">
                                                <!-- Verificação do estado do coração selecionado -->
                                                <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                                </svg>

                                                <svg class="hover" width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                                    <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                                </svg>
                                            </div>
                                            <h3 class="title">Homens</h3>
                                        </div>

                                        <div class="box-conteudo" onclick="setGenero('trans')">
                                            <div class="image">
                                                <!-- Verificação do estado do coração selecionado -->
                                                <svg width="56" height="53" viewBox="0 0 56 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.0759 0.883195C28.9911 4.27952 31.3115 6.30197 33.6252 8.29652C37.3985 11.5499 41.5018 14.3778 45.2104 17.7149C48.9394 21.0728 52.4133 24.6784 54.3322 29.473C56.554 35.0242 56.8636 40.5511 53.451 45.806C47.8234 54.4677 35.3808 54.9628 29.083 46.7963C28.7733 46.3953 28.4773 45.9908 28.1167 45.5096C27.3852 46.4127 26.7693 47.3403 25.9732 48.1109C21.4412 52.501 16.1266 53.8051 10.2881 51.7164C4.43251 49.6242 1.0301 45.1679 0.26116 38.8495C-0.405713 33.354 1.5813 28.5977 4.77276 24.3087C7.83152 20.1941 11.7137 16.9652 15.6741 13.8269C18.2565 11.78 20.9172 9.83428 23.3635 7.61307C25.3641 5.79635 27.3001 3.9099 28.0827 0.876221L28.0759 0.883195ZM28.035 36.4644C28.5352 37.9149 29.0694 39.1145 29.8077 40.2024C32.482 44.1392 35.9048 46.6289 40.8485 46.2453C45.4384 45.8897 48.674 42.9432 49.4974 38.3125C50.0418 35.2439 49.3715 32.4195 47.8711 29.7659C45.9657 26.394 43.2132 23.8275 40.2735 21.4424C36.3573 18.2693 32.0363 15.6366 28.3991 12.0973C28.0282 11.7382 27.8547 11.9334 27.5961 12.188C26.4903 13.2794 25.2859 14.2453 24.0712 15.2077C20.645 17.9171 16.9568 20.2673 13.7109 23.2208C10.8699 25.8047 8.33168 28.6187 7.02856 32.3811C5.50428 36.7852 6.68831 41.5693 9.9206 44.0834C13.6326 46.9706 18.6206 47.0613 22.3904 44.2508C24.9865 42.3155 26.8578 39.7909 28.035 36.4574V36.4644Z" fill="#F14C90"/>
                                                </svg>

                                                <svg class="hover" width="57" height="53" viewBox="0 0 57 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M28.2613 0.883195C29.1766 4.27952 31.497 6.30197 33.8107 8.29652C37.5839 11.5499 41.6872 14.3778 45.3959 17.7149C49.1249 21.0728 52.5988 24.6784 54.5177 29.473C56.7395 35.0242 57.0491 40.5511 53.6365 45.806C48.0089 54.4677 35.5663 54.9628 29.2685 46.7963C28.9588 46.3953 28.6628 45.9908 28.3022 45.5096C27.5707 46.4127 26.9548 47.3403 26.1587 48.1109C21.6266 52.501 16.3121 53.8051 10.4735 51.7164C4.618 49.6242 1.21559 45.1679 0.446645 38.8495C-0.220227 33.354 1.76678 28.5977 4.95824 24.3087C8.01701 20.1941 11.8992 16.9652 15.8596 13.8269C18.442 11.78 21.1027 9.83428 23.549 7.61307C25.5496 5.79635 27.4856 3.9099 28.2681 0.876221L28.2613 0.883195ZM28.2205 36.4644C28.7207 37.9149 29.2548 39.1145 29.9932 40.2024C32.6675 44.1392 36.0903 46.6289 41.034 46.2453C45.6238 45.8897 48.8595 42.9432 49.6829 38.3125C50.2273 35.2439 49.557 32.4195 48.0565 29.7659C46.1512 26.394 43.3987 23.8275 40.459 21.4424C36.5428 18.2693 32.2217 15.6366 28.5846 12.0973C28.2137 11.7382 28.0402 11.9334 27.7816 12.188C26.6758 13.2794 25.4714 14.2453 24.2567 15.2077C20.8305 17.9171 17.1423 20.2673 13.8964 23.2208C11.0554 25.8047 8.51716 28.6187 7.21404 32.3811C5.68976 36.7852 6.8738 41.5693 10.1061 44.0834C13.8181 46.9706 18.806 47.0613 22.5759 44.2508C25.172 42.3155 27.0433 39.7909 28.2205 36.4574V36.4644Z" fill="#F14C90"/>
                                                    <path d="M9.96939 21.1954L28.7646 9.00391C32.6591 11.7131 40.7528 17.3347 41.972 18.1475C43.4959 19.1635 48.5757 24.7512 49.5917 25.7672C50.6076 26.7831 52.6395 34.4028 52.6395 35.9267V42.0225L41.972 48.1182H37.9082L27.7486 42.0225L25.7167 45.5783L8.95343 48.1182L3.87366 42.0225C3.87366 39.4826 4.17844 33.8948 5.39759 31.8629C6.61674 29.831 8.95343 23.9046 9.96939 21.1954Z" fill="#F14C90"/>
                                                </svg>
                                            </div>
                                            <h3 class="title">Trans</h3>
                                        </div>
                                    </div>
                                </div><!-- A view que contém a escolha do gênero -->
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <style>
                #op{
                    display: none
                }
                .op {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 99;
                    width: 100%;
                }
                .popup-contentt {
                    width: 100%;
                }
                .header__genero__esq__box__one.active .active{
                    display: block
                }
            </style>

            <div class="header__genero">
                <div class="header__genero__esq">
                    <h3 class="header__genero__esq__title">Alterar Gênero</h3>
                    <form id="accept-btn-1" action="{{ route('client.set.genero') }}" method="post">
                        @csrf
                        <div class="header__genero__esq__box">
                            <input type="hidden" name="genero" id="generoInput">
                            <div class="header__genero__esq__box__one {{request()->cookie('genero') == 'feminino' ? 'active' : ''}}" onclick="setGenero('feminino')">
                                @if (request()->cookie('genero') == 'masculino' || request()->cookie('genero') == 'trans')
                                    <svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.5022 0.00323032C13.9445 1.5764 15.0657 2.51319 16.1837 3.43706C18.0069 4.94401 19.9896 6.25391 21.7816 7.79962C23.5835 9.35502 25.2621 11.0251 26.1893 13.2459C27.2629 15.8173 27.4125 18.3773 25.7635 20.8114C23.0443 24.8234 17.032 25.0528 13.9889 21.2701C13.8393 21.0843 13.6962 20.897 13.522 20.6741C13.1685 21.0924 12.8709 21.522 12.4862 21.879C10.2964 23.9125 7.72836 24.5165 4.90719 23.5491C2.07779 22.58 0.433748 20.5158 0.0621942 17.5891C-0.260038 15.0436 0.700084 12.8405 2.2422 10.8539C3.72019 8.948 5.59604 7.45236 7.5097 5.99871C8.75753 5.05061 10.0432 4.14935 11.2252 3.12049C12.1919 2.27899 13.1274 1.40519 13.5055 0L13.5022 0.00323032ZM13.4825 16.4843C13.7242 17.1562 13.9823 17.7119 14.3391 18.2158C15.6313 20.0393 17.2852 21.1925 19.674 21.0149C21.8918 20.8501 23.4553 19.4853 23.8531 17.3404C24.1162 15.919 23.7923 14.6108 23.0673 13.3816C22.1466 11.8198 20.8166 10.631 19.3961 9.52623C17.5038 8.05643 15.4159 6.83698 13.6584 5.19759C13.4792 5.03123 13.3954 5.12168 13.2704 5.23959C12.7361 5.74513 12.1541 6.19253 11.5672 6.63832C9.91165 7.8933 8.12951 8.98192 6.56109 10.35C5.18832 11.5468 3.96186 12.8502 3.3322 14.593C2.59567 16.6329 3.16779 18.8489 4.72963 20.0135C6.52328 21.3508 8.93345 21.3928 10.755 20.091C12.0094 19.1946 12.9137 18.0252 13.4825 16.4811V16.4843Z" fill="#F14C90"/>
                                    </svg>
                                    <svg class="active" width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0036 0.00792793C14.0032 0.0064075 14.0027 0.0048865 14.0023 0.00336492L14.0057 0C14.005 0.00264445 14.0043 0.00528709 14.0036 0.00792793C14.4631 1.64389 15.6248 2.6188 16.7831 3.58028C18.6738 5.15001 20.73 6.51449 22.5884 8.1246C24.457 9.74481 26.1977 11.4845 27.1593 13.7979C28.2726 16.4763 28.4278 19.143 26.7177 21.6785C23.8978 25.8577 17.6628 26.0966 14.507 22.1563C14.3518 21.9628 14.2035 21.7677 14.0228 21.5355C13.6562 21.9713 13.3476 22.4188 12.9487 22.7906C10.6777 24.9088 8.0146 25.5381 5.08893 24.5303C2.15474 23.5208 0.449812 21.3706 0.0644977 18.322C-0.269669 15.6704 0.726013 13.3756 2.32524 11.3061C3.85797 9.32083 5.8033 7.76287 7.78784 6.24866C9.08189 5.26105 10.4151 4.32224 11.641 3.25051C12.6417 2.37554 13.6101 1.46703 14.0036 0.00792793Z" fill="#F14C90"/>
                                    </svg>
                                    @else
                                    <svg class="active" width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0036 0.00792793C14.0032 0.0064075 14.0027 0.0048865 14.0023 0.00336492L14.0057 0C14.005 0.00264445 14.0043 0.00528709 14.0036 0.00792793C14.4631 1.64389 15.6248 2.6188 16.7831 3.58028C18.6738 5.15001 20.73 6.51449 22.5884 8.1246C24.457 9.74481 26.1977 11.4845 27.1593 13.7979C28.2726 16.4763 28.4278 19.143 26.7177 21.6785C23.8978 25.8577 17.6628 26.0966 14.507 22.1563C14.3518 21.9628 14.2035 21.7677 14.0228 21.5355C13.6562 21.9713 13.3476 22.4188 12.9487 22.7906C10.6777 24.9088 8.0146 25.5381 5.08893 24.5303C2.15474 23.5208 0.449812 21.3706 0.0644977 18.322C-0.269669 15.6704 0.726013 13.3756 2.32524 11.3061C3.85797 9.32083 5.8033 7.76287 7.78784 6.24866C9.08189 5.26105 10.4151 4.32224 11.641 3.25051C12.6417 2.37554 13.6101 1.46703 14.0036 0.00792793Z" fill="#F14C90"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="header__genero__esq__box__one {{request()->cookie('genero') == 'masculino' ? 'active' : ''}}" onclick="setGenero('masculino')">
                                @if (request()->cookie('genero') == 'feminino' || request()->cookie('genero') == 'trans')
                                    <svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.5022 0.00323032C13.9445 1.5764 15.0657 2.51319 16.1837 3.43706C18.0069 4.94401 19.9896 6.25391 21.7816 7.79962C23.5835 9.35502 25.2621 11.0251 26.1893 13.2459C27.2629 15.8173 27.4125 18.3773 25.7635 20.8114C23.0443 24.8234 17.032 25.0528 13.9889 21.2701C13.8393 21.0843 13.6962 20.897 13.522 20.6741C13.1685 21.0924 12.8709 21.522 12.4862 21.879C10.2964 23.9125 7.72836 24.5165 4.90719 23.5491C2.07779 22.58 0.433748 20.5158 0.0621942 17.5891C-0.260038 15.0436 0.700084 12.8405 2.2422 10.8539C3.72019 8.948 5.59604 7.45236 7.5097 5.99871C8.75753 5.05061 10.0432 4.14935 11.2252 3.12049C12.1919 2.27899 13.1274 1.40519 13.5055 0L13.5022 0.00323032ZM13.4825 16.4843C13.7242 17.1562 13.9823 17.7119 14.3391 18.2158C15.6313 20.0393 17.2852 21.1925 19.674 21.0149C21.8918 20.8501 23.4553 19.4853 23.8531 17.3404C24.1162 15.919 23.7923 14.6108 23.0673 13.3816C22.1466 11.8198 20.8166 10.631 19.3961 9.52623C17.5038 8.05643 15.4159 6.83698 13.6584 5.19759C13.4792 5.03123 13.3954 5.12168 13.2704 5.23959C12.7361 5.74513 12.1541 6.19253 11.5672 6.63832C9.91165 7.8933 8.12951 8.98192 6.56109 10.35C5.18832 11.5468 3.96186 12.8502 3.3322 14.593C2.59567 16.6329 3.16779 18.8489 4.72963 20.0135C6.52328 21.3508 8.93345 21.3928 10.755 20.091C12.0094 19.1946 12.9137 18.0252 13.4825 16.4811V16.4843Z" fill="#6358FF"/>
                                    </svg>
                                    <svg class="active" width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0036 0.00792793C14.0032 0.0064075 14.0027 0.0048865 14.0023 0.00336492L14.0057 0C14.005 0.00264445 14.0043 0.00528709 14.0036 0.00792793C14.4631 1.64389 15.6248 2.6188 16.7831 3.58028C18.6738 5.15001 20.73 6.51449 22.5884 8.1246C24.457 9.74481 26.1977 11.4845 27.1593 13.7979C28.2726 16.4763 28.4278 19.143 26.7177 21.6785C23.8978 25.8577 17.6628 26.0966 14.507 22.1563C14.3518 21.9628 14.2035 21.7677 14.0228 21.5355C13.6562 21.9713 13.3476 22.4188 12.9487 22.7906C10.6777 24.9088 8.0146 25.5381 5.08893 24.5303C2.15474 23.5208 0.449812 21.3706 0.0644977 18.322C-0.269669 15.6704 0.726013 13.3756 2.32524 11.3061C3.85797 9.32083 5.8033 7.76287 7.78784 6.24866C9.08189 5.26105 10.4151 4.32224 11.641 3.25051C12.6417 2.37554 13.6101 1.46703 14.0036 0.00792793Z" fill="#6358FF"/>
                                    </svg>
                                    @else
                                    <svg class="active" width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0036 0.00792793C14.0032 0.0064075 14.0027 0.0048865 14.0023 0.00336492L14.0057 0C14.005 0.00264445 14.0043 0.00528709 14.0036 0.00792793C14.4631 1.64389 15.6248 2.6188 16.7831 3.58028C18.6738 5.15001 20.73 6.51449 22.5884 8.1246C24.457 9.74481 26.1977 11.4845 27.1593 13.7979C28.2726 16.4763 28.4278 19.143 26.7177 21.6785C23.8978 25.8577 17.6628 26.0966 14.507 22.1563C14.3518 21.9628 14.2035 21.7677 14.0228 21.5355C13.6562 21.9713 13.3476 22.4188 12.9487 22.7906C10.6777 24.9088 8.0146 25.5381 5.08893 24.5303C2.15474 23.5208 0.449812 21.3706 0.0644977 18.322C-0.269669 15.6704 0.726013 13.3756 2.32524 11.3061C3.85797 9.32083 5.8033 7.76287 7.78784 6.24866C9.08189 5.26105 10.4151 4.32224 11.641 3.25051C12.6417 2.37554 13.6101 1.46703 14.0036 0.00792793Z" fill="#6358FF"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="header__genero__esq__box__one {{session()->get('genero') == 'trans' ? 'active' : ''}}" onclick="setGenero('trans')">
                                @if (request()->cookie('genero') == 'masculino' || request()->cookie('genero') == 'feminino')
                                    <svg width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.5022 0.00323032C13.9445 1.5764 15.0657 2.51319 16.1837 3.43706C18.0069 4.94401 19.9896 6.25391 21.7816 7.79962C23.5835 9.35502 25.2621 11.0251 26.1893 13.2459C27.2629 15.8173 27.4125 18.3773 25.7635 20.8114C23.0443 24.8234 17.032 25.0528 13.9889 21.2701C13.8393 21.0843 13.6962 20.897 13.522 20.6741C13.1685 21.0924 12.8709 21.522 12.4862 21.879C10.2964 23.9125 7.72836 24.5165 4.90719 23.5491C2.07779 22.58 0.433748 20.5158 0.0621942 17.5891C-0.260038 15.0436 0.700084 12.8405 2.2422 10.8539C3.72019 8.948 5.59604 7.45236 7.5097 5.99871C8.75753 5.05061 10.0432 4.14935 11.2252 3.12049C12.1919 2.27899 13.1274 1.40519 13.5055 0L13.5022 0.00323032ZM13.4825 16.4843C13.7242 17.1562 13.9823 17.7119 14.3391 18.2158C15.6313 20.0393 17.2852 21.1925 19.674 21.0149C21.8918 20.8501 23.4553 19.4853 23.8531 17.3404C24.1162 15.919 23.7923 14.6108 23.0673 13.3816C22.1466 11.8198 20.8166 10.631 19.3961 9.52623C17.5038 8.05643 15.4159 6.83698 13.6584 5.19759C13.4792 5.03123 13.3954 5.12168 13.2704 5.23959C12.7361 5.74513 12.1541 6.19253 11.5672 6.63832C9.91165 7.8933 8.12951 8.98192 6.56109 10.35C5.18832 11.5468 3.96186 12.8502 3.3322 14.593C2.59567 16.6329 3.16779 18.8489 4.72963 20.0135C6.52328 21.3508 8.93345 21.3928 10.755 20.091C12.0094 19.1946 12.9137 18.0252 13.4825 16.4811V16.4843Z" fill="#FF36FC"/>
                                    </svg>
                                    <svg class="active" width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0036 0.00792793C14.0032 0.0064075 14.0027 0.0048865 14.0023 0.00336492L14.0057 0C14.005 0.00264445 14.0043 0.00528709 14.0036 0.00792793C14.4631 1.64389 15.6248 2.6188 16.7831 3.58028C18.6738 5.15001 20.73 6.51449 22.5884 8.1246C24.457 9.74481 26.1977 11.4845 27.1593 13.7979C28.2726 16.4763 28.4278 19.143 26.7177 21.6785C23.8978 25.8577 17.6628 26.0966 14.507 22.1563C14.3518 21.9628 14.2035 21.7677 14.0228 21.5355C13.6562 21.9713 13.3476 22.4188 12.9487 22.7906C10.6777 24.9088 8.0146 25.5381 5.08893 24.5303C2.15474 23.5208 0.449812 21.3706 0.0644977 18.322C-0.269669 15.6704 0.726013 13.3756 2.32524 11.3061C3.85797 9.32083 5.8033 7.76287 7.78784 6.24866C9.08189 5.26105 10.4151 4.32224 11.641 3.25051C12.6417 2.37554 13.6101 1.46703 14.0036 0.00792793Z" fill="#FF36FC"/>
                                    </svg>
                                    @else
                                    <svg class="active" width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0036 0.00792793C14.0032 0.0064075 14.0027 0.0048865 14.0023 0.00336492L14.0057 0C14.005 0.00264445 14.0043 0.00528709 14.0036 0.00792793C14.4631 1.64389 15.6248 2.6188 16.7831 3.58028C18.6738 5.15001 20.73 6.51449 22.5884 8.1246C24.457 9.74481 26.1977 11.4845 27.1593 13.7979C28.2726 16.4763 28.4278 19.143 26.7177 21.6785C23.8978 25.8577 17.6628 26.0966 14.507 22.1563C14.3518 21.9628 14.2035 21.7677 14.0228 21.5355C13.6562 21.9713 13.3476 22.4188 12.9487 22.7906C10.6777 24.9088 8.0146 25.5381 5.08893 24.5303C2.15474 23.5208 0.449812 21.3706 0.0644977 18.322C-0.269669 15.6704 0.726013 13.3756 2.32524 11.3061C3.85797 9.32083 5.8033 7.76287 7.78784 6.24866C9.08189 5.26105 10.4151 4.32224 11.641 3.25051C12.6417 2.37554 13.6101 1.46703 14.0036 0.00792793Z" fill="#FF36FC"/>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="header__genero__dir">
                    <a href="{{route('admin.dashboard.companion.painel')}}" target="_blank" rel="noopener noreferrer">
                        <img src="{{asset('build/client/images/login-header.png')}}" alt="login">
                        <h3 class="header__genero__dir__title">Perfil Acompanhante</h3>
                    </a>
                </div>
            </div>

            <script>
                function setCookie(name, value, days) {
                    const date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    const expires = "expires=" + date.toUTCString();
                    document.cookie = name + "=" + value + ";" + expires + ";path=/";
                }

                function getCookie(name) {
                    const nameEQ = name + "=";
                    const ca = document.cookie.split(';');
                    for (let i = 0; i < ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') c = c.substring(1);
                        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                    }
                    return null;
                }

                function checkConsent() {
                    const consent = getCookie('cookieConsent');
                    if (!consent) {
                        const op = document.getElementById('op');
                        if (op) op.style.display = 'block';
                    }
                }

                function giveConsent() {
                    setCookie('cookieConsent', 'accepted', 365); // Salva por 1 ano
                    const op = document.getElementById('op');
                    if (op) op.style.display = 'none';
                }

                const acceptBtn = document.getElementById('accept-btn');
                if (acceptBtn) {
                    acceptBtn.addEventListener('click', function () {
                        giveConsent();
                        const form = acceptBtn.closest('form');
                        if (form) form.submit();
                    });
                }

                const acceptBtn1 = document.getElementById('accept-btn-1');
                if (acceptBtn1 && acceptBtn1.tagName === "FORM") {
                    // se for um form, não adiciona eventListener, só usamos .submit() nele depois
                }

                function setGenero(genero) {
                    document.getElementById('generoInput').value = genero;

                    document.querySelectorAll('.box-conteudo').forEach((box) => {
                        box.classList.remove('selecionado');
                    });

                    const selectedBox = Array.from(document.querySelectorAll('.box-conteudo')).find((el) =>
                        el.onclick.toString().includes(genero)
                    );
                    if (selectedBox) {
                        selectedBox.classList.add('selecionado');
                    }

                    // Dá o consentimento com o clique
                    giveConsent();

                    // Submete os dois formulários se existirem
                    const form1 = document.getElementById('accept-btn')?.closest('form');
                    if (form1) form1.submit();

                    const form2 = document.getElementById('accept-btn-1');
                    if (form2 && form2.tagName === "FORM") form2.submit();
                }

                window.onload = checkConsent;
            </script>

            <header class="header">
                <div class="header__logo">
                    <a href="{{ route('client.home') }}">
                        <img src="{{asset('build/client/images/logo-header.png')}}" alt="">
                    </a>
                </div>

                <!-- Botão de menu Mobile -->
                <button class="menu-toggle" id="menuToggle">
                    ☰
                </button>

                <nav class="header__navigation" id="mobileMenu">
                    <div class="logo-mobile">
                        <a href="{{ route('client.home') }}">
                            <img src="{{asset('build/client/images/logo-header.png')}}" alt="">
                        </a>
                    </div>

                    <ul class="menu">
                        <li><a href="{{ route('client.home') }}">Home</a></li>
                        <li><a href="{{ route('client.escort') }}">Acompanhantes</a></li>
                        <li><a href="{{ route('client.feed') }}">Feed</a></li>
                        <li class="dropdown">
                            <a href="#" id="toggle-categorias">Categorias</a>
                            <ul id="submenu-categorias" class="submenu">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('client.escort.category', ['category' => $category->slug]) }}">{{$category->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('client.contact') }}">Contato</a></li>
                    </ul>

                    <div class="header__social">
                        <div class="header__social__item">
                            <a href="#">
                                <img src="{{asset('build/client/images/insta.png')}}" alt="">
                            </a>
                        </div>
                        <div class="header__social__item">
                            <a href="#">
                                <img src="{{asset('build/client/images/youtube.png')}}" alt="">
                            </a>
                        </div>
                        <div class="header__social__item">
                            <a href="#">
                                <img src="{{asset('build/client/images/linkedin.png')}}" alt="">
                            </a>
                        </div>
                        <div class="header__social__item">
                            <a href="#">
                                <img src="{{asset('build/client/images/tiktok.png')}}" alt="">
                            </a>
                        </div>
                        <div class="header__social__item">
                            <a href="#">
                                <img src="{{asset('build/client/images/twitter.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="header__navigation__login">
                        <!-- <a href="#"><img src="{{asset('build/client/images/pesquisa-header.png')}}" alt=""></a> -->
                        <div class="header__navigation__login__acesso">
                             @if (Auth::guard('cliente')->check())

                                    {{-- <a href="{{ route('admin.client.logout') }}">Sair</a> --}}

                                    <a href="{{ route('admin.dashboard.client.index') }}" class="link-full"></a>
                                    @php
                                        $imgClient = Auth::guard('cliente')->user()->path_image;
                                    @endphp
                                    @if ($imgClient)
                                        <img src="{{asset('storage/'.$imgClient)}}" alt="" style="width: 31px; height: 31px; border-radius: 100%;object-fit: cover;">
                                    @else
                                        <img src="{{asset('build/client/images/login-header.png')}}" alt="">
                                    @endif

                                    <h4 class="header__navigation__login__acesso__title">Olá, {{ Auth::guard('cliente')->user()->name }}!</h4>
                                @else
                                    <a href="#" id="login-access" class="link-full"></a>
                                    <img src="{{asset('build/client/images/entrar.png')}}" alt="">
                                    <h4 class="header__navigation__login__acesso__title">Entrar</h4>
                                @endif
                        </div>
                        {{-- <a href="#" id="login-access"><img src="{{asset('build/client/images/login-header.png')}}" alt=""></a> --}}
                        <!-- Fundo escuro -->
                        <div id="overlay"></div>
                        <!-- Modal de Login -->
                        <div class="box-login" id="login-modal">
                            <div class="modal-content">
                                <span class="close-btn" id="close-modal">&times;</span>
                                <img src="{{asset('build/client/images/logo-header.png')}}" alt="">
                                <h2>Acesse sua Conta</h2>
                                <p>Acesso para Clientes</p>
                                <form action="{{route('admin.client.authenticate')}}" method="POST">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="clientPage" value="true">

                                    <div class="form-group">
                                        <!-- <label for="email">E-mail</label> -->
                                        <input type="email" id="email" name="email" placeholder="E-mail" required>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="password">Senha</label> -->
                                        <input type="password" id="password" name="password" placeholder="Senha" required>
                                    </div>
                                    <button type="submit" class="login-btn">Entrar</button>
                                </form>
                                <div class="form-info">
                                    <p>Ainda não tem uma conta? <a href="#" id="login-cadastro">Registrar-se</a> aqui <a href="#">Esqueceu sua senha?</a></p>
                                </div>

                            </div>
                        </div>

                        @if ($errors->any())
                            @foreach ($errors->all() as $erro)
                                <div class="custom-alert error-alert">
                                    <img src="{{asset('build/client/images/error-icon.png')}}" alt="Erro" class="icon-img">
                                    <div class="content">
                                        <strong>Erro</strong>
                                        {{ $erro }}
                                    </div>
                                    <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
                                </div>
                            @endforeach
                        @endif

                        <div class="box-login" id="cadastro-modal">
                            <div class="modal-content">
                                <span class="close-btn" id="close-modal-cadastro">&times;</span>
                                <img src="{{asset('build/client/images/logo-header.png')}}" alt="">
                                <h2>Criar uma nova conta</h2>
                                <p>cadastro</p>
                                <form action="{{route('client.register-client.store')}}" method="POST">
                                    @csrf

                                    <input type="hidden" name="clientPage" value="true">

                                    <div class="form-group">
                                        <!-- <label for="email">E-mail</label> -->
                                        <input type="text" id="apelido" name="name" placeholder="Apelido" required>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="email">E-mail</label> -->
                                        <input type="email" id="email" name="email" placeholder="E-mail" required>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="password">Senha</label> -->
                                        <input type="password" id="password" name="password" placeholder="Senha" required>
                                    </div>

                                    <div class="form-group checkbox">
                                        <input type="checkbox" name="policy_term" required>
                                        <label>Afirmo ter 18 anos ou mais e aceito os <a target="_blank" href="#">termos e políticas</a></label>
                                    </div>

                                    <button type="submit" class="login-btn">Cadastrar</button>
                                </form>
                                <!-- <div class="form-info">
                                    <p><a href="#" id="login-access">Login</a></p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="header__navigation__buttom">
                        <a class="header__navigation__buttom__cta" href="{{ route('client.about') }}">Anuncie Aqui</a>
                    </div>
                </nav>
            </header>
            @yield('content')
        </main>

        <style>
            #overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: rgba(0, 0, 0, 0.6);
                z-index: 2;
            }
            .modal-content h2{
                color: #F14C90;
                font-family: "Red Hat Display", serif;
                font-size: 1.75rem;
                font-style: normal;
                font-weight: 700;
                margin-top: 18px;
            }
            .modal-content p{
                color: #FFFF;
                font-family: "Red Hat Display", serif;
                font-size: 1rem;
                font-style: normal;
                font-weight: 400;
            }
            .modal-content form {
                width: 100%;
                max-width: 390px;
                margin: 0 auto;
                margin-top: 19px;
            }
            .modal-content img {
                margin-top: 70px;
            }
            .box-login {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(180deg, #000 45.21%, #4D182E 115.7%);
                padding: 20px;
                z-index: 1000;
                width: 472px;
                text-align: center;
            }
            .box-login.active,
            #overlay.active {
                display: block;
            }
            body.modal-open {
                overflow: hidden;
            }
            .close-btn {
                position: absolute;
                top: 0;
                right: 15px;
                font-size: 100px;
                cursor: pointer;
                color: #FFFF;
            }
            .form-group {
                margin-bottom: 25px;
            }

            .form-group label {
                display: block;
                font-weight: bold;
                font-family: "Red Hat Display", serif;
                font-style: normal;
                font-size: 1rem;
                color: #FFFF;
                text-align: left;
                margin-bottom: 0;
            }

            .form-group input {
                width: 100%;
                padding: 8px;
                border: none;
                border-bottom: 1px solid #ffffff7a;
                background: transparent;
                color: #FFFF;
            }

            .form-group placeholder {
                color: #FFFF;
            }

            .form-info {
                width: 100%;
                max-width: 319px;
                margin: 0 auto;
                margin-top: 26px;
            }

            .form-info p {
                color: #FFFF;
                font-family: "Red Hat Display", serif;
                font-size: 1rem;
                font-style: normal;
                font-weight: 400;
                line-height: 33px;
            }

            .form-info a {
                color: #F14C90;
            }

            .login-btn {
                background-color: #f14c90;
                font-family: "Red Hat Display", serif;
                font-style: normal;
                font-size: 1.125rem;
                color: #FFFF;
                padding: 5px 40PX;
                border: 1px solid #f14c90;
                border-radius: 25px;
                cursor: pointer;
                margin-top: 7px;
            }

            .login-btn:hover {
                background-color: transparent;
            }
        </style>

        <div id="lightbox-feed" class="lightbox-feed" style="display: none;">
            <img src="{{asset('build/client/images/logo-header.png')}}" class="lightbox-feed__logo" alt="">
            <img src="{{asset('build/client/images/lightbox-escorts.png')}}" class="lightbox-feed__firula" alt="">

            <div class="lightbox-info">
                <div class="swiper lightbox-info__swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide lightbox-info__swiper__item">
                            <div class="lightbox-info__swiper__item__image">

                                <div class="swiper lightbox-gallery">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-next.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="lightbox-gallery__nav swiper-pagination"></div>
                                </div>

                            </div>
                            <div class="lightbox-info__swiper__item__information">
                                <div class="lightbox-info__swiper__item__information__image">
                                    <img src="{{asset('build/client/images/lightbox-info.png')}}" alt="">
                                </div>
                                <div class="lightbox-info__swiper__item__information__description">
                                    <h3 class="lightbox-info__swiper__item__information__description__title">Alexandra Pimentel</h3>
                                    <div class="lightbox-info__swiper__item__information__description__additional">
                                        <h3 class="lightbox-info__swiper__item__information__description__additional__years">22 anos</h3>
                                        <h4 class="lightbox-info__swiper__item__information__description__additional__city">Salvador-BA</h4>
                                    </div>
                                </div>
                                <div class="lightbox-info__swiper__item__information__button">
                                    <a href="#" class="lightbox-info__swiper__item__information__button__cta">Ver Stories</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide lightbox-info__swiper__item">
                            <div class="lightbox-info__swiper__item__image">
                                <div class="swiper lightbox-gallery">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-next.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="lightbox-gallery__nav swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="lightbox-info__swiper__item__information">
                                <div class="lightbox-info__swiper__item__information__image">
                                    <img src="{{asset('build/client/images/lightbox-info.png')}}" alt="">
                                </div>
                                <div class="lightbox-info__swiper__item__information__description">
                                    <h3 class="lightbox-info__swiper__item__information__description__title">Alexandra Pimentel</h3>
                                    <div class="lightbox-info__swiper__item__information__description__additional">
                                        <h3 class="lightbox-info__swiper__item__information__description__additional__years">22 anos</h3>
                                        <h4 class="lightbox-info__swiper__item__information__description__additional__city">Salvador-BA</h4>
                                    </div>
                                </div>
                                <div class="lightbox-info__swiper__item__information__button">
                                    <a href="#" class="lightbox-info__swiper__item__information__button__cta">Ver Stories</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide lightbox-info__swiper__item">
                            <div class="lightbox-info__swiper__item__image">
                                <div class="swiper lightbox-gallery">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-next.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="lightbox-gallery__nav swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="lightbox-info__swiper__item__information">
                                <div class="lightbox-info__swiper__item__information__image">
                                    <img src="{{asset('build/client/images/lightbox-info.png')}}" alt="">
                                </div>
                                <div class="lightbox-info__swiper__item__information__description">
                                    <h3 class="lightbox-info__swiper__item__information__description__title">Alexandra Pimentel</h3>
                                    <div class="lightbox-info__swiper__item__information__description__additional">
                                        <h3 class="lightbox-info__swiper__item__information__description__additional__years">22 anos</h3>
                                        <h4 class="lightbox-info__swiper__item__information__description__additional__city">Salvador-BA</h4>
                                    </div>
                                </div>
                                <div class="lightbox-info__swiper__item__information__button">
                                    <a href="#" class="lightbox-info__swiper__item__information__button__cta">Ver Stories</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide lightbox-info__swiper__item">
                            <div class="lightbox-info__swiper__item__image">
                                <div class="swiper lightbox-gallery">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-next.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="lightbox-gallery__nav swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="lightbox-info__swiper__item__information">
                                <div class="lightbox-info__swiper__item__information__image">
                                    <img src="{{asset('build/client/images/lightbox-info.png')}}" alt="">
                                </div>
                                <div class="lightbox-info__swiper__item__information__description">
                                    <h3 class="lightbox-info__swiper__item__information__description__title">Alexandra Pimentel</h3>
                                    <div class="lightbox-info__swiper__item__information__description__additional">
                                        <h3 class="lightbox-info__swiper__item__information__description__additional__years">22 anos</h3>
                                        <h4 class="lightbox-info__swiper__item__information__description__additional__city">Salvador-BA</h4>
                                    </div>
                                </div>
                                <div class="lightbox-info__swiper__item__information__button">
                                    <a href="#" class="lightbox-info__swiper__item__information__button__cta">Ver Stories</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide lightbox-info__swiper__item">
                            <div class="lightbox-info__swiper__item__image">
                                <div class="swiper lightbox-gallery">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-next.png')}}" alt="">
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('build/client/images/lightbox-info-black.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="lightbox-gallery__nav swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="lightbox-info__swiper__item__information">
                                <div class="lightbox-info__swiper__item__information__image">
                                    <img src="{{asset('build/client/images/lightbox-info.png')}}" alt="">
                                </div>
                                <div class="lightbox-info__swiper__item__information__description">
                                    <h3 class="lightbox-info__swiper__item__information__description__title">Alexandra Pimentel</h3>
                                    <div class="lightbox-info__swiper__item__information__description__additional">
                                        <h3 class="lightbox-info__swiper__item__information__description__additional__years">22 anos</h3>
                                        <h4 class="lightbox-info__swiper__item__information__description__additional__city">Salvador-BA</h4>
                                    </div>
                                </div>
                                <div class="lightbox-info__swiper__item__information__button">
                                    <a href="#" class="lightbox-info__swiper__item__information__button__cta">Ver Stories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lightbox-info__swiper__nav">
                        <div class="lightbox-info__swiper__nav__swiper-button-prev swiper-button-prev"></div>
                        <div class="lightbox-info__swiper__nav__swiper-button-next swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div id="lightbox-escorts" class="lightbox-escorts" style="display: none;">
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
        </div> --}}

        <footer id="footer" class="footer">
            <a href="{{ route('client.home') }}">
                <img class="footer__logo" src="{{asset('build/client/images/logo-footer.png')}}" alt="">
            </a>
            <div class="footer__social">
                <div class="footer__social__item">
                    <a href="#">
                        <img src="{{asset('build/client/images/insta.png')}}" alt="">
                    </a>
                </div>
                <div class="footer__social__item">
                    <a href="#">
                        <img src="{{asset('build/client/images/youtube.png')}}" alt="">
                    </a>
                </div>
                <div class="footer__social__item">
                    <a href="#">
                        <img src="{{asset('build/client/images/linkedin.png')}}" alt="">
                    </a>
                </div>
                <div class="footer__social__item">
                    <a href="#">
                        <img src="{{asset('build/client/images/tiktok.png')}}" alt="">
                    </a>
                </div>
                <div class="footer__social__item">
                    <a href="#">
                        <img src="{{asset('build/client/images/twitter.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="footer__menu">
                <ul>
                    <li>
                        <a href="{{ route('client.home') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('client.escort') }}">Acompanhantes</a>
                    </li>
                    <li>
                        <a href="{{ route('client.feed') }}">Feed</a>
                    </li>
                    <li>
                        <a href="{{ route('client.about') }}">Anuncie</a>
                    </li>
                    <li>
                        <a href="{{ route('client.contact') }}">Contato</a>
                    </li>
                    <li>
                        <a href="{{route('client.register')}}">Cadastre-se Gratis</a>
                    </li>
                </ul>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    //Modal de cadastro
                    const loginCadastroBtn = document.getElementById("login-cadastro");
                    const modalCadastro = document.getElementById("cadastro-modal");
                    const closeModalCadastro = document.getElementById("close-modal-cadastro");

                    //Modal de login
                    const loginBtn = document.getElementById("login-access");
                    const modal = document.getElementById("login-modal");
                    const overlay = document.getElementById("overlay");
                    const closeModal = document.getElementById("close-modal");

                    function openModal() {
                        modal.classList.add("active");
                        overlay.classList.add("active");
                        document.body.classList.add("modal-open"); // Impede a rolagem
                    }

                    function openModalCadastro() {
                        modalCadastro.classList.add("active");
                        overlay.classList.add("active");
                        document.body.classList.add("modal-open"); // Impede a rolagem
                    }

                    function closeModalFunc() {
                        modalCadastro.classList.remove("active");
                        modal.classList.remove("active");
                        overlay.classList.remove("active");
                        document.body.classList.remove("modal-open"); // Habilita a rolagem
                    }

                    loginBtn.addEventListener("click", function (event) {
                        event.preventDefault();
                        openModal();
                    });
                    
                    loginCadastroBtn.addEventListener("click", function (event) {
                        event.preventDefault();
                        openModalCadastro();
                    });

                    closeModal.addEventListener("click", closeModalFunc);
                    closeModalCadastro.addEventListener("click", closeModalFunc);

                    overlay.addEventListener("click", closeModalFunc);
                });
            </script>

            @if (session('showLoginModal'))
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        setTimeout(() => {
                            document.getElementById("overlay").classList.add("active");
                            document.getElementById("login-modal").classList.add("active");
                            document.body.classList.add("modal-open");
                        }, 200); // Pequeno atraso para evitar problemas no carregamento
                    });
                </script>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </footer>
    </body>
</html>
