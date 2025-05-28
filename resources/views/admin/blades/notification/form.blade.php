<div class="row">
    <div class="mb-3 d-flex align-items-start flex-column">
        <label for="type-select" class="form-label text-dark">Categoria <span class="text-danger">*</span></label>
        @php
            $currentType = isset($notification) ? $notification->type : null;
        @endphp

        <select name="type" class="form-select" id="type-select" required>
            <option value="" disabled selected>Selecione a categoria</option>
            <option value="client" {{ $currentType == 'client' ? 'selected' : '' }} >
                Cliente
            </option>
            <option value="companion" {{ $currentType == 'companion' ? 'selected' : '' }} >
                Acompanhante
            </option>
        </select>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label text-dark">Assunto <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control-input d-block w-100 p-2" id="title{{isset($notification->id)?$notification->id:''}}" value="{{isset($notification)?$notification->title:''}}" placeholder="Digite o assunto da notificação" required>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label text-dark">Duração da Notificação (em dias)</label>
        <input type="number" id="duration" name="duration" class="form-control-input d-block w-100 p-2" min="1" value="{{ old('duration', isset($notification)?$notification->duration / 86400 ?? 1:'') }}">
        <small class="form-text text-muted">Informe o número de dias que a notificação ficará visível.</small>
    </div>

    <div class="mb-3">
        <label for="{{ $textareaId }}" class="form-label text-dark">Mensagem <span class="text-danger">*</span></label>
        <textarea name="message" id="{{ $textareaId }}" placeholder="Texto" class="col-12" rows="10">
            {{isset($notification)?$notification->message:''}}
        </textarea>
    </div>   
</div>


