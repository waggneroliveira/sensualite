@extends('client.core.client')

@section('content')

    <section id="section-contact" class="section-contact">
        <div class="section-contact__item">
            <div class="section-contact__item__head">
                <h2 class="section-contact__item__head__title">Entre em Contato Conosco</h2>
            </div>
            <div class="section-contact__item__form">
                <form action="#" method="post">
                    
                    <input type="text" id="name" name="name" placeholder="Nome" required>

                    
                    <input type="email" id="email" name="email" placeholder="E-mail" required>

                    
                    <input type="tel" id="phone" name="phone" placeholder="Telefone" required>

                    
                    <input type="text" id="subject" name="subject" placeholder="Assunto" required>

                    
                    <textarea id="message" name="message" rows="4" placeholder="Mensagem" required></textarea>

                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>

@endsection