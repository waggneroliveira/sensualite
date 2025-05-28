<!doctype html>
<html lang="en" dir="ltr" data-theme="dark">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>SignIn - Geex Dashboard</title>

	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

	<!-- inject:css-->
	<link rel="stylesheet" href="{{asset('build/admin/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" href="{{asset('build/admin/css/style.css')}}">

	<!-- endinject -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('build/admin/images/favicon.svg')}}">

	<!-- Fonts -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css">

    <script>
        $url = "{{ url('/') }}";

		// Render localStorage JS:
		if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
		if (localStorage.layout) document.documentElement.setAttribute("data-nav", localStorage.navbar);
		if (localStorage.layout) document.documentElement.setAttribute("dir", localStorage.layout);
    </script>
</head>
<body>

    @yield('content')

    <!-- inject:js-->
	<script src="{{asset('build/admin/js/jquery/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('build/admin/js/jquery/jquery-ui.js')}}"></script>
	<script src="{{asset('build/admin/js/bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{asset('build/admin/js/main.js')}}"></script>
	<!-- endinject-->
</body>
</html>
