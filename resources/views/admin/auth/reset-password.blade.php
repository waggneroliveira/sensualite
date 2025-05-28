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
            <form id="signInForm" class="geex-content__authentication__form">
                <h2 class="geex-content__authentication__title">Altere sua senha 👋</h2>
                <div class="geex-content__authentication__form-group">
                    <label for="emailSignIn">E-mail</label>
                    <input type="email" id="emailSignIn" name="emailSignIn" placeholder="Enter Your Email" required>
                    <i class="uil-envelope"></i>
                </div>
                <div class="geex-content__authentication__form-group">
                    <div class="geex-content__authentication__label-wrapper">
                        <label for="loginPassword">Senha</label>
                    </div>
                    <input type="password" id="loginPassword" name="loginPassword" placeholder="Password" required>
                    <i class="uil-eye toggle-password-type"></i>
                </div>
                <div class="geex-content__authentication__form-group">
                    <div class="geex-content__authentication__label-wrapper">
                        <label for="loginPassword">Confirmar senha</label>
                    </div>
                    <input type="password" id="loginPassword" name="loginPassword" placeholder="Password" required>
                    <i class="uil-eye toggle-password-type"></i>
                </div>

                <button type="submit" class="geex-content__authentication__form-submit">Sign Up</button>
            </form>
        </div>
    </div>
    <div class="geex-content__authentication__img">
        <img src="{{asset('build/admin/images/authentication.svg')}}" alt="">
    </div>
</div>
@endsection
