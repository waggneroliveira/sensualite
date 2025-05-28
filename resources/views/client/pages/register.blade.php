@extends('client.core.client')

@section('content')
<section id="bg-geral">

<section id="section-register" class="section-register">
        <div class="section-register__item">
            <div class="section-register__item__head">
                <h2 class="section-register__item__head__title">Faça parte da LovePrive</h2>
                <p>Lorem ipsum dolor sit amet consectetur. Donec fringilla odio faucibus lacus ultrices nunc. Blandit in nisl nunc hendrerit vitae sit vel bibendum. Suspendisse diam interdum odio ultrices habitant id nisl.</p>
            </div>
            <div class="section-register__item__form">
                <form action="{{route('client.register.store')}}" method="post">
                    @csrf

                    <input type="text" id="name" name="name" placeholder="Nome" required>                    
                    <input type="email" id="email" name="email" placeholder="E-mail" required>                    
                    <input type="tel" id="phone" name="phone" placeholder="WhatsApp" required>

                    <div class="escolha">
                        <select name="gender" id="gender">
                            <option disabled selected style="color: #FFF">Selecione um genero</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="trans">Trans</option>
                        </select>
    
                        <select name="city" id="city">
                            <option disabled selected style="color: #FFF">Selecione uma cidade</option>
                            <option value="">Cidade</option>
                            <option value="salvador">Salvador</option>
                            <option value="barra">Barra</option>
                            <option value="caminho-das-arvores">Caminho das árvores</option>
                            <option value="pituba">Pituba</option>
                            <option value="rio-vermelho">Rio Vermelho</option>
                            <option value="ondina">Ondina</option>
                            <option value="itapuã">Itapuã</option>
                            <option value="bonfim">Bonfim</option>
                            <option value="cabula">Cabula</option>
                            <option value="boca-do-rio">Boca do Rio</option>
                            <option value="brotas">Brotas</option>
                            <option value="cajazeiras">Cajazeiras</option>
                            <option value="campo-grande">Campo Grande</option>
                            <option value="graça">Graça</option>
                            <option value="amaralina">Amaralina</option>
                            <option value="narandiba">Narandiba</option>
                            <option value="periperi">Periperi</option>
                            <option value="paripe">Paripe</option>
                            <option value="lobato">Lobato</option>
                        </select>                        
    
                        <select name="state" id="state">
                            <option value="bahia">Bahia</option>
                        </select>
                    </div>
                    
                    <textarea id="description" name="description" rows="4" placeholder="Observações" required></textarea>

                    <div class="form-group checkbox">
                        <input type="checkbox" required>
                        <label>Afirmo ter 18 anos ou mais e aceito os <a target="_blank" href="#">termos e políticas</a></label>
                    </div>

                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>
    <style>
        input, textarea{
            color: #FFF
        }
        select option{
            color: #000;
            background: transparent;
        }
    </style>
</section>
@endsection