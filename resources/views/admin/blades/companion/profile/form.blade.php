<div class="row">
    <div class="col-12 col-lg-6">
        <h2 class="mb-4">
            <i class="uil uil-user"></i>
            Dados Pessoais
        </h2>

        <div class="mb-3 w-100 d-flex align-items-start flex-column">
            <div class="geex-content__form__single__box d-block w-100">
                <label for="category-select" class="form-label mb-2">Categorias</label>
                <select class="form-select category-select px-4 py-3">
                    <option disabled selected>Selecione uma ou mais categorias</option>
                    @foreach ($categories as $categoryLabel)
                        <option value="{{ $categoryLabel->id }}">
                            {{ $categoryLabel->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="companion_id" value="{{isset($companion->id)?$companion->id:''}}">
            <div class="category mt-2" id="category-container">
                @if (isset($companion))
                    @if ($companion->categories)
                        @foreach ($companion->categories as $categorySelectedOption)
                            <label class="btn btn-light btn-xs waves-effect waves-light mb-2">{{$categorySelectedOption->title}} <i class="btn-close ms-3" onclick="deletecategoryHandler(event)"></i>
                                <input type="hidden" value='{{$categorySelectedOption->id}}' name="companion_category_id[]">
                            </label>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="name" class="form-label mb-2">Nome <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control d-block w-100 px-4 py-3" id="name{{ isset($companion->id) ? $companion->id : '' }}" value="{{ isset($companion) ? $companion->name : '' }}" placeholder="Digite seu nome" required>
        </div>

        <div class="row">
            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label for="mention" class="form-label mb-2">Seu @ <span class="text-danger">*</span></label>
                <input type="text" name="mention" class="form-control d-block w-100 px-4 py-3" id="mention{{ isset($companion->id) ? $companion->id : '' }}" value="{{ isset($companion) ? $companion->mention : '' }}" placeholder="informe o @" required>
            </div>

            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label class="form-label mb-2">Gênero</label>
                <select name="gender" class="form-select px-4 py-3">
                    <option value="masculino" {{ isset($companion) && $companion->gender == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="feminino" {{ isset($companion) && $companion->gender == 'feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="trans" {{ isset($companion) && $companion->gender == 'trans' ? 'selected' : '' }}>Transexual</option>
                </select>
            </div>
        </div>


        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="phone" class="form-label mb-2">Telefone</label>
            <input type="text" name="phone" value="{{ isset($companion) ? $companion->phone : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="phone{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Digite seu telefone">
        </div>

        <div class="row">
            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label for="age" class="form-label mb-2">Idade</label>
                <input type="number" name="age" value="{{ isset($companion) ? $companion->age : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="age{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Digite sua idade">
            </div>

            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label for="height" class="form-label mb-2">Altura (cm)</label>
                <input type="number" name="height" value="{{ isset($companion) ? $companion->height : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="height{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Digite sua altura">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label for="type" class="form-label mb-2">Sua Classificação</label>
                <input type="text" name="type" value="{{ isset($companion) ? $companion->type : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="type{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Ex.: Premium, Luxo, etc.">
            </div>

            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label for="body_type" class="form-label mb-2">Tipo de Corpo</label>
                <input type="text" name="body_type" value="{{ isset($companion) ? $companion->body_type : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="body_type{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Informe o tipo de corpo">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label for="weight" class="form-label mb-2">Peso (kg)</label>
                <input type="number" name="weight" value="{{ isset($companion) ? $companion->weight : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="weight{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Digite seu peso">
            </div>

            <div class="mb-3 col-6 geex-content__form__single__box d-block">
                <label for="shoe_size" class="form-label mb-2">Tamanho do Sapato</label>
                <input type="number" name="shoe_size" value="{{ isset($companion) ? $companion->shoe_size : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="shoe_size{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Informe o tamanho do sapato">
            </div>

        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="eye_color" class="form-label mb-2">Cor dos Olhos</label>
            <input type="text" name="eye_color" value="{{ isset($companion) ? $companion->eye_color : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="eye_color{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Informe a cor dos olhos">
        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="go_out_with" class="form-label mb-2">Acompanha</label>
            <input type="text" name="go_out_with" value="{{ isset($companion) ? $companion->go_out_with : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="go_out_with{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Com quem acompanha">
        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="availability" class="form-label mb-2">Disponibilidade</label>
            <input type="text" name="availability" value="{{ isset($companion) ? $companion->availability : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="availability{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Informe a disponibilidade">
        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label class="form-label mb-2">Cidade</label>
            <select name="city" class="form-select px-4 py-3">
                <option disabled {{ !isset($companion) || !$companion->city ? 'selected' : '' }} style="color: #FFF">Selecione uma cidade</option>
                <option value="" {{ isset($companion) && $companion->city == '' ? 'selected' : '' }}>Cidade</option>
                <option value="salvador" {{ isset($companion) && $companion->city == 'salvador' ? 'selected' : '' }}>Salvador</option>
                <option value="barra" {{ isset($companion) && $companion->city == 'barra' ? 'selected' : '' }}>Barra</option>
                <option value="caminho-das-arvores" {{ isset($companion) && $companion->city == 'caminho-das-arvores' ? 'selected' : '' }}>Caminho das árvores</option>
                <option value="pituba" {{ isset($companion) && $companion->city == 'pituba' ? 'selected' : '' }}>Pituba</option>
                <option value="rio-vermelho" {{ isset($companion) && $companion->city == 'rio-vermelho' ? 'selected' : '' }}>Rio Vermelho</option>
                <option value="ondina" {{ isset($companion) && $companion->city == 'ondina' ? 'selected' : '' }}>Ondina</option>
                <option value="itapuã" {{ isset($companion) && $companion->city == 'itapuã' ? 'selected' : '' }}>Itapuã</option>
                <option value="bonfim" {{ isset($companion) && $companion->city == 'bonfim' ? 'selected' : '' }}>Bonfim</option>
                <option value="cabula" {{ isset($companion) && $companion->city == 'cabula' ? 'selected' : '' }}>Cabula</option>
                <option value="boca-do-rio" {{ isset($companion) && $companion->city == 'boca-do-rio' ? 'selected' : '' }}>Boca do Rio</option>
                <option value="brotas" {{ isset($companion) && $companion->city == 'brotas' ? 'selected' : '' }}>Brotas</option>
                <option value="cajazeiras" {{ isset($companion) && $companion->city == 'cajazeiras' ? 'selected' : '' }}>Cajazeiras</option>
                <option value="campo-grande" {{ isset($companion) && $companion->city == 'campo-grande' ? 'selected' : '' }}>Campo Grande</option>
                <option value="graça" {{ isset($companion) && $companion->city == 'graça' ? 'selected' : '' }}>Graça</option>
                <option value="amaralina" {{ isset($companion) && $companion->city == 'amaralina' ? 'selected' : '' }}>Amaralina</option>
                <option value="narandiba" {{ isset($companion) && $companion->city == 'narandiba' ? 'selected' : '' }}>Narandiba</option>
                <option value="periperi" {{ isset($companion) && $companion->city == 'periperi' ? 'selected' : '' }}>Periperi</option>
                <option value="paripe" {{ isset($companion) && $companion->city == 'paripe' ? 'selected' : '' }}>Paripe</option>
                <option value="lobato" {{ isset($companion) && $companion->city == 'lobato' ? 'selected' : '' }}>Lobato</option>
            </select>
        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="meeting_places" class="form-label mb-2">Locais de Encontro</label>
            <input type="text" name="meeting_places" value="{{ isset($companion) ? $companion->meeting_places : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="meeting_places{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Informe os locais de encontro">
        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="{{$textareaId}}" class="form-label text-white mb-2">Apresentação da Modelo</label>
            <textarea name="description" id="{{$textareaId}}" placeholder="Texto" class="col-12 " rows="10">
                {!!isset($companion->description)?$companion->description: ''!!}
            </textarea>
        </div>
    </div>
    {{-- END col --}}

    <div class="col-12 col-lg-6">
        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="payment_methods" class="form-label mb-2">Métodos de Pagamento</label>
            <input type="text" name="payment_methods" value="{{ isset($companion) ? $companion->payment_methods : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="payment_methods{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Ex.: Cartão, Dinheiro, Pix, etc.">
        </div>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="rate" class="form-label mb-2">Taxa</label>
            <input type="text" name="rate" value="{{ isset($companion) ? $companion->rate : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="rate{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Informe a taxa de encontro">
        </div>

        <h2 class="mb-5 mt-5">
            <i class="uil-lock-alt"></i>
            Dados de Acesso
        </h2>

        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="email" class="form-label mb-2">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ isset($companion) ? $companion->email : '' }}" class="form-control-input d-block w-100 px-4 py-3" id="email{{ isset($companion->id) ? $companion->id : '' }}" placeholder="Digite seu email" required>
        </div>
        <div class="mb-3 geex-content__form__single__box d-block">
            <label for="password" class="form-label mb-2">Senha <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <input type="password" name="password" id="password-{{ isset($companion->id) ? $companion->id : '' }}" class="form-control-input d-block w-100 px-4 py-3" placeholder="Digite sua senha" {{ !isset($companion) ? 'required' : '' }}>
            </div>
        </div>

        <h2 class="mb-5 mt-5">
            <i class="uil-image-edit"></i>
            Imagens
        </h2>

        <div class="mb-3">
            <label class="form-label mb-2">Imagem Perfil</label>
            <div class="fileInputPreview">
                <img class="preview-file-img" src="{{isset($companion)?$companion->path_file_profile<>''?url('storage/'.$companion->path_file_profile):'':''}}" alt="Pré-visualização">
                <label for="fileInputProfile" class="labelInput">
                    <i class="bx bx-upload"></i>
                    <h5 class="fileText">Clique para fazer upload</h5>
                    <p class="fileDescription">Carregar imagem com no máximo de 2mb</p>
                </label>
                <button class="btn btn-secondary removeFile">Remover</button>
                <div class="wrap-input">
                    <input type="file" id="fileInputProfile" name="path_file_profile" class="fileInput">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label mb-2">Imagem de Capa <small>(Horizontal)</small></label>
            <div class="fileInputPreview">
                <img class="preview-file-img" src="{{isset($companion)?$companion->path_file_horizontal_cover<>''?url('storage/'.$companion->path_file_horizontal_cover):'':''}}" alt="Pré-visualização">
                <label for="fileInputHorizontal" class="labelInput">
                    <i class="bx bx-upload"></i>
                    <h5 class="fileText">Clique para fazer upload</h5>
                    <p class="fileDescription">Carregar imagem com no máximo de 2mb</p>
                </label>
                <button class="btn btn-secondary removeFile">Remover</button>
                <div class="wrap-input">
                    <input type="file" id="fileInputHorizontal" name="path_file_horizontal_cover" class="fileInput">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label mb-2">Imagem de Capa <small>(Vertical)</small></label>
            <div class="fileInputPreview">
                <img class="preview-file-img" src="{{isset($companion)?$companion->path_file_vertical_cover<>''?url('storage/'.$companion->path_file_vertical_cover):'':''}}" alt="Pré-visualização">
                <label for="fileInputVertical" class="labelInput">
                    <i class="bx bx-upload"></i>
                    <h5 class="fileText">Clique para fazer upload</h5>
                    <p class="fileDescription">Carregar imagem com no máximo de 2mb</p>
                </label>
                <button class="btn btn-secondary removeFile">Remover</button>
                <div class="wrap-input">
                    <input type="file" id="fileInputVertical" name="path_file_vertical_cover" class="fileInput">
                </div>
            </div>
        </div>
    </div>
    {{-- END col --}}
</div>
{{-- END row --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById("{{$textareaId}}")) {
            CKEDITOR.replace("{{$textareaId}}");
        }
    });

    const categorySelect = document.querySelectorAll('.category-select');

    if (categorySelect.length > 0) {

        categorySelect.forEach((el) => {
            const containercategorys = el.parentNode.parentNode.querySelector('.category');

            el.addEventListener('change', ev => {
                const categorySelectedValue = ev.target.value;
                const categorySelectedOption = ev.target.selectedOptions[0].innerText;

                // Evitar duplicação
                if (!containercategorys.querySelector(`[value="${categorySelectedValue}"]`)) {
                    containercategorys.innerHTML += `
                        <label class="btn btn-light btn-xs waves-effect waves-light mb-3">
                            ${categorySelectedOption}
                            <i class="btn-close ms-2" onclick="deletecategoryHandler(event)"></i>
                            <input type="hidden" value='${categorySelectedValue}' name="companion_category_id[]" required>
                        </label>`;
                }
            });
        });
    }

    function deletecategoryHandler(event) {
        event.target.parentNode.parentNode.removeChild(event.target.parentNode);
    }
</script>
