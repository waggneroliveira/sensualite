@extends('admin.core.auth-admin')

@section('content')
<div class="geex-content__authentication geex-content__authentication--forgot-password">
    <div class="geex-content__authentication__content">
        <div class="geex-content__authentication__content__wrapper">
            <div class="geex-content__authentication__content__logo">
                <a href="#">
                    <img class="logo-lite" src="{{asset('build/admin/images/logo-dark.svg')}}" alt="logo">
                    <img class="logo-dark" src="{{asset('build/admin/images/logo-dark.svg')}}" alt="logo">
                </a>
            </div>
            <form id="signInForm" class="geex-content__authentication__form">
                <h2 class="geex-content__authentication__title">Esqueceu sua senha? 👋</h2>
                <p class="geex-content__authentication__desc">Por favor, insira o endereço de e-mail associado à sua conta e enviaremos um e-mail com um link para redefinir sua senha.</p>
                <div class="geex-content__authentication__form-group">
                    <label for="emailSignIn">E-mail</label>
                    <input type="email" id="emailSignIn" name="emailSignIn" placeholder="Enter Your Email" required>
                    <i class="uil-envelope"></i>
                </div>
                <button type="button" class="geex-content__authentication__form-submit"><a href="{{route('admin.dashboard.reset-password')}}" class="text-white">Esqueci a senha</a></button>
                <a href="{{route('admin.dashboard.painel')}}" class="geex-content__authentication__form-submit return-btn">Voltar para Login</a>
            </form>
        </div>
    </div>
    <div class="geex-content__authentication__img">
        <img src="{{asset('build/admin/images/authentication.svg')}}" alt="">
    </div>
</div>
@endsection
