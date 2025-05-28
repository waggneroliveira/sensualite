@extends('admin.core.auth-admin')

@section('content')
    <div class="geex-content__authentication">
        <div class="geex-content__authentication__content">
            <div class="geex-content__authentication__content__wrapper">
                <div class="geex-content__authentication__content__logo">
                    <a href="index.html">
                        <img class="logo-lite" src="{{asset('build/admin/images/logo-dark.svg')}}" alt="logo">
                        <img class="logo-dark" src="{{asset('build/admin/images/logo-dark.svg')}}" alt="logo">
                    </a>
                </div>
                <form action="{{route('admin.user.authenticate')}}" id="signInForm" class="geex-content__authentication__form" method="POST">
                    @csrf

                    <h2 class="geex-content__authentication__title">Painel Administrativo</h2>
                    <div class="geex-content__authentication__form-group">
                        <label for="emailSignIn">Seu Email</label>
                        <input type="email" id="emailSignIn" name="email" placeholder="Informe Seu Email" required>
                        <i class="uil-envelope"></i>
                    </div>
                    @error('email')
                        <h6 class="text-danger mb-3 text-start" style="margin-top: -20px;">{{ $message }}</h6>
                    @enderror

                    <div class="geex-content__authentication__form-group">
                        <div class="geex-content__authentication__label-wrapper">
                            <label for="loginPassword">Sua Senha</label>
                            <a href="{{route('admin.dashboard.forgot-password')}}">Esqueceu a Senha?</a>
                        </div>
                        <input type="password" id="loginPassword" name="password" placeholder="Senha" required>
                        <i class="uil-eye toggle-password-type"></i>
                    </div>
                    @error('password')
                        <h6 class="text-danger p-0 mb-3 text-start" style="margin-top: -20px;">{{ $message }}</h6>
                    @enderror

                    <div class="geex-content__authentication__form-group custom-checkbox">
                        <input type="checkbox" class="geex-content__authentication__checkbox-input" id="rememberMe">
                        <label class="geex-content__authentication__checkbox-label" for="rememberMe">Lembre-me</label>
                    </div>
                    <button type="submit" class="geex-content__authentication__form-submit">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
        <div class="geex-content__authentication__img">
            <img src="{{asset('build/admin/images/authentication.svg')}}" alt="">
        </div>
    </div>
@endsection
