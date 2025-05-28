<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-sidenav-user="true">

<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }} - Painel Gerenciador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="author" content="Love Prive">
    <meta name="description" content="Painel gerenciador de conteúdo {{ env('APP_NAME') }}">
    <meta name="copyright" content="© 2024 Love Prive." />
    <meta name="robots" content="none">
    <meta name="googlebot" content="noarchive">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons CSS -->
    <link href="{{ asset('build/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body style="background-color: #17161E;" class="d-flex justify-content-center align-items-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <!-- Card -->
                <div class="card shadow">
                    <div class="card-body text-center p-4">
                        <div class="mb-4">
                            <a href="#" class="logo d-block mb-2">
                                <img src="{{asset('admin/images/logo-dark.svg')}}" alt="Logo" height="30">
                            </a>
                        </div>

                        <!-- SVG Checkmark -->
                        <div class="d-flex justify-content-center mb-3">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" width="80">
                                <circle class="path circle" fill="none" stroke="#4bd396" stroke-width="6" cx="65.1"
                                    cy="65.1" r="62.1" />
                                <polyline class="path check" fill="none" stroke="#4bd396" stroke-width="6"
                                    stroke-linecap="round" points="100.2,40.2 51.5,88.8 29.8,67.5" />
                            </svg>
                        </div>

                        <h4 class="text-success">Logout realizado com sucesso!</h4>
                        <p class="text-muted">Sua sessão foi encerrada. Volte quando quiser!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (para componentes opcionais) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Redirecionamento -->
    <script>
        function redirecionar() {
            window.location.href = '/painel';
        }
        setTimeout(redirecionar, 1800);
    </script>
</body>

</html>
