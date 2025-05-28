<!doctype html>
<html lang="en" dir="ltr" data-theme="dark" data-route="{{ Route::currentRouteName() }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Love Prive - Painel Dashboard</title>

	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

	<!-- inject:css-->
    <link rel="stylesheet" href="{{asset('build/admin/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.27.0/dist/apexcharts.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="{{asset('build/admin/css/style.css')}}">
	<!-- endinject -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('build/admin/images/favicon.svg')}}">
	<!-- Fonts -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css" integrity="sha512-/k658G6UsCvbkGRB3vPXpsPHgWeduJwiWGPCGS14IQw3xpr63AEMdA8nMYG2gmYkXitQxDTn6iiK/2fD4T87qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="{{ asset('build/admin/js/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

	<!-- FancyBox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css">
    <!-- FancyBox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
	<!-- Select2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!-- Select2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>
        $url = "{{ url('/') }}";

		// Render localStorage JS:
		if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
		if (localStorage.layout) document.documentElement.setAttribute("data-nav", localStorage.navbar);
		if (localStorage.layout) document.documentElement.setAttribute("dir", localStorage.layout);
    </script>
</head>
<body>
    <main class="geex-main-content">
        <div class="geex-sidebar">
			<a href="#" class="geex-sidebar__close">
				<i class="uil uil-times"></i>
			</a>
			<div class="geex-sidebar__wrapper">
				<div class="geex-sidebar__header">
					<a href="{{ route('admin.dashboard') }}" class="geex-sidebar__logo">
						<img class="logo-lite" src="{{asset('build/admin/images/logo-dark.svg')}}" alt="logo">
                        <img class="logo-dark" src="{{asset('build/admin/images/logo-dark.svg')}}" alt="logo">
					</a>
				</div>
				<nav class="geex-sidebar__menu-wrapper">
					<ul class="geex-sidebar__menu">
						<li class="geex-sidebar__menu__item mb-2">
							<a href="{{ route('admin.dashboard') }}" class="geex-sidebar__menu__link justify-content-start">
								<i class="uil-home"></i>
								<span>Dashboard</span>
							</a>
						</li>

                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('acompanhantes.visualizar'))
                            <a href="{{route('admin.companion.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-user"></i>
                                <span>Acompanhantes</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('assinatura.visualizar'))
                            <a href="{{route('admin.dashboard.plan.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-credit-card"></i>
                                <span>Assinaturas</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('pacote.visualizar'))
                            <a href="{{route('admin.dashboard.package.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-box"></i>
                                <span>Pacotes</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('notificacao.visualizar'))
                            <a href="{{route('admin.dashboard.notification.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-bell"></i>
                                <span>Notificações</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('categoria.visualizar'))
                            <a href="{{route('admin.dashboard.category.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-puzzle-piece"></i>
                                <span>Categorias</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('anuncio.visualizar'))
                            <a href="{{route('admin.dashboard.announcement.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-tag"></i>
                                <span>Anuncios</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('ensaio.visualizar'))
                            <a href="{{route('admin.dashboard.galleryApprovalRequest')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-image-check"></i>
                                <span>Aprovação de galeria</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('pagarme.visualizar'))
                            <a href="{{route('admin.dashboard.configPayment.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-setting"></i>
                                <span>Configuração pagarme</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('grupo.visualizar'))
                            <a href="{{route('admin.dashboard.group.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-user-square"></i>
                                <span>Grupos</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('usuario.visualizar'))
                            <a href="{{route('admin.dashboard.user.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-users-alt"></i>
                                <span>Usuários</span>
                            </a>
                            @endif
                        </li>
                        <li class="geex-sidebar__menu__item mb-2">
                            @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('auditoria.visualizar'))
                            <a href="{{route('admin.dashboard.audit.index')}}" class="geex-sidebar__menu__link justify-content-start">
                                <i class="uil uil-search-alt"></i>
                                <span>Auditoria</span>
                            </a>
                            @endif
                        </li>
					</ul>
				</nav>
				<div class="geex-sidebar__footer">
					<span class="geex-sidebar__footer__title">Agência Hoom Interativa</span>
                    <p class="geex-sidebar__footer__copyright">© 2024 All Rights Reserved</p>
                    <p class="geex-sidebar__footer__author">Desenvolvido por:<a href="https://hoom.com.br/"> Hoom Interativa</a></p>
				</div>
			</div>
		</div>

		<div class="geex-customizer">
			<div class="geex-customizer__header">
				<h4 class="geex-customizer__title">Customizar</h4>
				<button class="geex-btn geex-btn__customizer-close">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18 7.05L16.95 6L12 10.95L7.05 6L6 7.05L10.95 12L6 16.95L7.05 18L12 13.05L16.95 18L18 16.95L13.05 12L18 7.05Z" fill="#BCBFDB"/>
						<path d="M18 7.05L16.95 6L12 10.95L7.05 6L6 7.05L10.95 12L6 16.95L7.05 18L12 13.05L16.95 18L18 16.95L13.05 12L18 7.05Z" fill="black" fill-opacity="0.8"/>
					</svg>
				</button>
			</div>
			<div class="geex-customizer__body">
				{{-- <div class="geex-customizer__single">
					<h5 class="geex-customizer__single__title">Tipos do layout</h5>
					<ul class="geex-customizer__list geex-customizer__list--layout">
						<li class="geex-customizer__list__item">
							<button class="geex-btn geex-customizer__btn geex-customizer__btn--ltr active">
								<svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="4.5" y="2.5" width="13" height="5" rx="1.5" stroke="white"/>
									<rect x="4.5" y="12.5" width="19" height="5" rx="1.5" stroke="white"/>
									<rect width="1" height="20" fill="white"/>
								</svg>
								LTR
							</button>
						</li>
						<li class="geex-customizer__list__item">
							<button class="geex-btn geex-customizer__btn geex-customizer__btn--rtl">
								RTL
								<svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="-0.5" y="0.5" width="13" height="5" rx="1.5" transform="matrix(-1 0 0 1 19 2)" stroke="#AB54DB"/>
									<rect x="-0.5" y="0.5" width="19" height="5" rx="1.5" transform="matrix(-1 0 0 1 19 12)" stroke="#AB54DB"/>
									<rect width="1" height="20" transform="matrix(-1 0 0 1 24 0)" fill="#AB54DB"/>
								</svg>
							</button>
						</li>
					</ul>
				</div> --}}
				<div class="geex-customizer__single">
					{{-- <h4 class="geex-customizer__single__title">Tipos de modelo</h4> --}}
					<ul class="geex-customizer__list geex-customizer__list--sidebar">
						<li class="geex-customizer__list__item">
							<button class="geex-btn geex-customizer__btn geex-customizer__btn--light active">
								<svg width="144" height="86" viewBox="0 0 144 86" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect width="144" height="86" rx="10" fill="white"/>
									<circle cx="27" cy="22" r="4" fill="#FF5653"/>
									<circle cx="38" cy="22" r="4" fill="#FDB23A"/>
									<circle cx="49" cy="22" r="4" fill="#2CBF44"/>
									<rect x="22" y="36" width="110" height="1" fill="#E7E7E7"/>
									<path d="M31.94 58.34H26.38L25.46 61H22.52L27.54 47.02H30.8L35.82 61H32.86L31.94 58.34ZM31.18 56.1L29.16 50.26L27.14 56.1H31.18ZM36.9764 55.42C36.9764 54.3 37.1964 53.3067 37.6364 52.44C38.0897 51.5733 38.6964 50.9067 39.4564 50.44C40.2297 49.9733 41.0897 49.74 42.0364 49.74C42.8631 49.74 43.5831 49.9067 44.1964 50.24C44.8231 50.5733 45.3231 50.9933 45.6964 51.5V49.92H48.5164V61H45.6964V59.38C45.3364 59.9 44.8364 60.3333 44.1964 60.68C43.5697 61.0133 42.8431 61.18 42.0164 61.18C41.0831 61.18 40.2297 60.94 39.4564 60.46C38.6964 59.98 38.0897 59.3067 37.6364 58.44C37.1964 57.56 36.9764 56.5533 36.9764 55.42ZM45.6964 55.46C45.6964 54.78 45.5631 54.2 45.2964 53.72C45.0297 53.2267 44.6697 52.8533 44.2164 52.6C43.7631 52.3333 43.2764 52.2 42.7564 52.2C42.2364 52.2 41.7564 52.3267 41.3164 52.58C40.8764 52.8333 40.5164 53.2067 40.2364 53.7C39.9697 54.18 39.8364 54.7533 39.8364 55.42C39.8364 56.0867 39.9697 56.6733 40.2364 57.18C40.5164 57.6733 40.8764 58.0533 41.3164 58.32C41.7697 58.5867 42.2497 58.72 42.7564 58.72C43.2764 58.72 43.7631 58.5933 44.2164 58.34C44.6697 58.0733 45.0297 57.7 45.2964 57.22C45.5631 56.7267 45.6964 56.14 45.6964 55.46Z" fill="#464255"/>
								</svg>
							</button>
						</li>
						<li class="geex-customizer__list__item">
							<button class="geex-btn geex-customizer__btn geex-customizer__btn--dark">
								<svg width="144" height="86" viewBox="0 0 144 86" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect width="144" height="86" rx="10" fill="#2F2A36"/>
									<circle cx="27" cy="22" r="4" fill="#FF5653"/>
									<circle cx="38" cy="22" r="4" fill="#FDB23A"/>
									<circle cx="49" cy="22" r="4" fill="#2CBF44"/>
									<rect x="22" y="36" width="110" height="1" fill="#D0D6DE"/>
									<path d="M31.94 58.34H26.38L25.46 61H22.52L27.54 47.02H30.8L35.82 61H32.86L31.94 58.34ZM31.18 56.1L29.16 50.26L27.14 56.1H31.18ZM36.9764 55.42C36.9764 54.3 37.1964 53.3067 37.6364 52.44C38.0897 51.5733 38.6964 50.9067 39.4564 50.44C40.2297 49.9733 41.0897 49.74 42.0364 49.74C42.8631 49.74 43.5831 49.9067 44.1964 50.24C44.8231 50.5733 45.3231 50.9933 45.6964 51.5V49.92H48.5164V61H45.6964V59.38C45.3364 59.9 44.8364 60.3333 44.1964 60.68C43.5697 61.0133 42.8431 61.18 42.0164 61.18C41.0831 61.18 40.2297 60.94 39.4564 60.46C38.6964 59.98 38.0897 59.3067 37.6364 58.44C37.1964 57.56 36.9764 56.5533 36.9764 55.42ZM45.6964 55.46C45.6964 54.78 45.5631 54.2 45.2964 53.72C45.0297 53.2267 44.6697 52.8533 44.2164 52.6C43.7631 52.3333 43.2764 52.2 42.7564 52.2C42.2364 52.2 41.7564 52.3267 41.3164 52.58C40.8764 52.8333 40.5164 53.2067 40.2364 53.7C39.9697 54.18 39.8364 54.7533 39.8364 55.42C39.8364 56.0867 39.9697 56.6733 40.2364 57.18C40.5164 57.6733 40.8764 58.0533 41.3164 58.32C41.7697 58.5867 42.2497 58.72 42.7564 58.72C43.2764 58.72 43.7631 58.5933 44.2164 58.34C44.6697 58.0733 45.0297 57.7 45.2964 57.22C45.5631 56.7267 45.6964 56.14 45.6964 55.46Z" fill="#D0D6DE"/>
								</svg>
							</button>
						</li>
					</ul>
				</div>
				{{-- <div class="geex-customizer__single">
					<h4 class="geex-customizer__single__title">Tipo de navegação</h4>
					<ul class="geex-customizer__list geex-customizer__list--navbar">
						<li class="geex-customizer__list__item">
							<button class="geex-btn geex-customizer__btn geex-customizer__btn--side active">
								<svg width="149" height="92" viewBox="0 0 149 92" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect x="46" width="103" height="92" rx="10" fill="white"/>
									<rect width="40" height="92" rx="10" fill="white"/>
								</svg>
							</button>
						</li>
						<li class="geex-customizer__list__item">
							<button class="geex-btn geex-customizer__btn geex-customizer__btn--top">
								<svg width="149" height="92" viewBox="0 0 149 92" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect y="13" width="149" height="79" rx="10" fill="white"/>
									<rect width="149" height="8" rx="4" fill="white"/>
								</svg>
							</button>
						</li>
					</ul>
				</div> --}}
			</div>
			<div class="geex-customizer-overlay"></div>
		</div>

        <div class="geex-content">
            @yield('content')
        </div>
    </main>

    <!-- inject:js-->
	<script src="{{asset('build/admin/js/jquery/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('build/admin/js/jquery/jquery-ui.js')}}"></script>
	<script src="{{asset('build/admin/js/jquery/jquery.sortable.min.js')}}"></script>
	<script src="{{ asset('build/admin/js/sweetalert2/sweetalert2.min.js') }}"></script>
	<script src="{{asset('build/admin/js/bootstrap/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.0/dist/apexcharts.min.js"></script>
	<script src="{{asset('build/admin/js/main.js')}}"></script>
  	<!-- endinject-->
    <script>
        const currentRoute = document.documentElement.getAttribute('data-route');

        if (currentRoute === 'admin.dashboard.client') {
            document.documentElement.setAttribute('data-nav', 'top');
        } else {
            document.documentElement.setAttribute('data-nav', 'side');
        }
    </script>
	<!-- input mask -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" type="text/javascript"></script>
	<script src="https://unicons.iconscout.com/release/v4.0.8/script/monochrome/bundle.js"></script>
	<script>
		$(function() {
		$('[type=money]').maskMoney({
			thousands: '.',
			decimal: ','
		});
		})
	</script>
	<script>
		toastr.options = {
			"closeButton": true,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"timeOut": "5000",
			"extendedTimeOut": "1000"
		};

		@if(session('success'))
			toastr.success("{{ session('success') }}");
		@endif

		@if(session('error'))
			toastr.error("{{ session('error') }}");
		@endif

		@if(session('warning'))
			toastr.warning("{{ session('warning') }}");
		@endif

		@if(session('info'))
			toastr.info("{{ session('info') }}");
		@endif
	</script>

	{{-- Modais alert --}}
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			let successMessage = '{{ session('success') }}';
			if (successMessage) {
				setTimeout(function() {
					if (typeof Swal !== 'undefined') {
						Swal.fire({
							title: responseSuccessName,
							text: successMessage,
							icon: 'success',
							confirmButtonText: 'OK',
							timer: 1800,
							showConfirmButton: false
						});
					}
				}, 1300);
			}
		});
	</script>


	@if(Session::has('error'))
		<div id="errorMessage" class="alert alert-warning notification-message" >
			<span class="mdi mdi-alert-circle"></span>
			{{ Session::get('error') }}
		</div>
	@endif

	@if ($errors->any())
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				let errors = '';
				@foreach ($errors->all() as $error)
					errors += '{{ $error }}\n';
				@endforeach

				setTimeout(function() {
					Swal.fire({
						title: responseItemErrorName,
						text: errors,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}, 1300);
			});
		</script>
	@endif

    <style>
		.geex-content__pricing__feature__text li::before{
			content: '\2714';
			font-family: 'unicons-line';
			font-size: 16px;
			color: #F14C90;
  			margin-right: 8px;
		}
		.cke_notifications_area{
			z-index: -1 !important;
			display: none;
		}
        .color-action{
            color: #B9BBBD;
            font-size: 23px;
        }
        .bt-delete{
            border: inherit;
            background: inherit;
        }
        .color-action:hover{
            color: #AB54DB;
        }
        #modal-image-gallery .modal-header .page-title {
            margin: 0;
            font-size: 1.4rem;
        }

        /* Modal Close Button */
        #modal-image-gallery .modal-header .btn-close {
            color: white;
            opacity: 0.8;
        }

        #modal-image-gallery .modal-header .btn-close:hover {
            opacity: 1;
        }

        /* Body Sub-header */
        #modal-image-gallery .modal-body .sub-header {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        /* File Input Styling */
        #modal-image-gallery .custom-file-upload {
            display: inline-block;
            padding: 6px 10px;
            cursor: pointer;
            background-color: #AB54DB;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        #modal-image-gallery .custom-file-upload:hover {
            background-color: #AB54DB;
        }

        /* Hidden Input */
        #modal-image-gallery input[type="file"] {
            display: none;
        }

        /* File Count Text */
        #modal-image-gallery #fileCount {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #495057;
        }

        /* Submit Button */
        #modal-image-gallery button[type="submit"] {
            background-color: #6c757d;
            border-color: #6c757d;
            font-weight: 500;
        }

        #modal-image-gallery button[type="submit"]:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .max-image{
            width: auto;
            max-height: 300px;
        }
        .card-img-top{
            object-fit: cover;
            height: 300px;
        }
        .hover-shadow:hover{
            transform: scale(1.2);
            transition: 0.3s ease-in-out;
        }
        .hover-shadow{
            transform: scale(1);
            transition: 0.3s ease-in-out;
        }
        video {
            height: 444px;
            width: 250px;
        }
        .custom-border {
            border: 1px solid #70707038;
        }
    </style>
</body>
</html>
