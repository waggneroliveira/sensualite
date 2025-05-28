<style>
    header {
        position: relative;
        z-index: 1;
    }
</style>
@extends('client.core.client')

@section('content')
<section id="bg-geral">

    <section id="section-part" class="section-part">
        <div class="section-part__firula">
            <img src="{{asset('build/client/images/section-part__firula.png')}}" alt="">
        </div>
        <div class="section-part__head">
            <h2 class="section-part__head__title">Faça Parte da Love Prive</h2>
        </div>
        <div class="section-part__information">
            <p class="section-part__information__paragraph">Lorem ipsum dolor sit amet consectetur. Donec fringilla odio faucibus lacus ultrices nunc. Blandit in nisl nunc hendrerit vitae sit vel bibendum. Suspendisse diam interdum odio ultrices habitant id nisl. Quis potenti amet dolor mi elementum. Ornare nunc tellus pretium nibh. Libero orci non diam ac diam ut vitae vitae praesent. Commodo lectus elit diam mauris morbi. Risus sagittis venenatis vestibulum amet. Sagittis purus duis aenean ipsum ridiculus cursus. Diam elementum ac proin nulla. Integer in adipiscing amet orci id cursus scelerisque ut.</p>
        </div>
        <div class="section-part__button">
            <a class="section-part__button__cta" href="{{route('client.register')}}">Faça o seu Cadastro</a>
        </div>

        <div class="section-advantages">
            <div class="section-advantages__head">
                <h2 class="section-advantages__head__title">Vantagens</h2>
            </div>
            <div class="section-advantages__box">
                <div class="section-advantages__box__item">
                    <div class="section-advantages__box__item__image">
                        <img src="{{asset('build/client/images/section-advantages__one.png')}}" alt="">
                    </div>
                    <div class="section-advantages__box__item__information">
                        <h3 class="section-advantages__box__item__information__title">Vantagens</h3>
                        <p class="section-advantages__box__item__information__paragraph">Lorem ipsum dolor sit amet consectetur. Donec fringilla odio faucibus lacus ultrices nunc. Blandit in nisl nunc hendrerit vitae sit vel bibendum. Suspendisse diam interdum odio ultrices habitant id nisl. Quis potenti amet dolor mi elementum. Ornare nunc tellus pretium nibh. Libero orci non diam ac diam ut vitae vitae praesent. Commodo lectus elit diam mauris morbi. Risus sagittis venenatis vestibulum amet. Sagittis purus duis aenean</p>
                    </div>
                </div>
                <div class="section-advantages__box__item">
                    <div class="section-advantages__box__item__image">
                        <img src="{{asset('build/client/images/section-advantages__one.png')}}" alt="">
                    </div>
                    <div class="section-advantages__box__item__information">
                        <h3 class="section-advantages__box__item__information__title">Vantagens</h3>
                        <p class="section-advantages__box__item__information__paragraph">Lorem ipsum dolor sit amet consectetur. Donec fringilla odio faucibus lacus ultrices nunc. Blandit in nisl nunc hendrerit vitae sit vel bibendum. Suspendisse diam interdum odio ultrices habitant id nisl. Quis potenti amet dolor mi elementum. Ornare nunc tellus pretium nibh. Libero orci non diam ac diam ut vitae vitae praesent. Commodo lectus elit diam mauris morbi. Risus sagittis venenatis vestibulum amet. Sagittis purus duis aenean</p>
                    </div>
                </div>
                <div class="section-advantages__box__item">
                    <div class="section-advantages__box__item__image">
                        <img src="{{asset('build/client/images/section-advantages__one.png')}}" alt="">
                    </div>
                    <div class="section-advantages__box__item__information">
                        <h3 class="section-advantages__box__item__information__title">Vantagens</h3>
                        <p class="section-advantages__box__item__information__paragraph">Lorem ipsum dolor sit amet consectetur. Donec fringilla odio faucibus lacus ultrices nunc. Blandit in nisl nunc hendrerit vitae sit vel bibendum. Suspendisse diam interdum odio ultrices habitant id nisl. Quis potenti amet dolor mi elementum. Ornare nunc tellus pretium nibh. Libero orci non diam ac diam ut vitae vitae praesent. Commodo lectus elit diam mauris morbi. Risus sagittis venenatis vestibulum amet. Sagittis purus duis aenean</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-six">
            <div class="section-six__box">
                <div class="section-six__box__left">
                    <img src="{{asset('build/client/images/section-seven__one.png')}}" alt="">
                </div>
                <div class="section-six__box__right">
                    <h3 class="section-six__box__right__title">Conheça a</h3>
                    <h4 class="section-six__box__right__subtitle">Love Prive</h4>
                    <p class="section-six__box__right__paragraph">Lorem ipsum dolor sit amet consectetur. Vel sodales elementum tempus rhoncus mauris. Feugiat ipsum et ullamcorper nunc commodo vel pharetra pulvinar quis. Et laoreet quis velit ullamcorper tristique. Ut nisl velit neque in egestas consequat. Maecenas lacinia facilisis netus eget sed semper rhoncus. Lacinia quam nulla aliquam consequat amet nunc sed vitae duis. Nam in mattis quisque felis. Mauris ultrices hac id tempus justo. Morbi blandit ipsum tortor pharetra tristique tincidunt. Commodo laoreet dapibus purus auctor id integer</p>
                    <a class="section-six__box__right__cta" href="{{route('client.register')}}">Faça o seu Cadastro</a>
                </div>
            </div>

            <div id="announcement" class="announcement">
                <a href="">
                    <img src="{{asset('build/client/images/bg-announcement.png')}}" alt="">
                </a>
            </div>
        </div>
    </section>

</section>
@endsection