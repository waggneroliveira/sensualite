@extends('client.core.client')

@section('content')
<section id="bg-geral">
    <section class="confirmation">
        <h3 class="title">Cadastro enviado com</h3>
        <div class="informacao">
            <img src="{{ asset('build/client/images/confirmation.png') }}" alt="">
            <h4 class="subtitle">SUCESSO</h4>
        </div>
        <p>Obrigado pela preferência!</p>
        <p>Entraremos em contato o mais breve possível</p>
        <a href="{{route('client.home')}}">Voltar para Home</a>
    </section>
</section>
@endsection