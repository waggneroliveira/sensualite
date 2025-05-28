<?php

use Carbon\Carbon;
    
?>

<div class="mb-3 col-12 d-flex align-items-start flex-column">
    <label for="announcetement-select" class="form-label text-dark">Anuncios</label>
    <select name="position" class="form-select">
        @php
            $currentPosition = isset($announcetement) ? $announcetement->position : null;
        @endphp

        <!-- Opção padrão -->
        <option disabled {{ is_null($currentPosition) ? 'selected' : '' }}>
            Selecione a página do anuncio
        </option>

        <!-- Opções adicionais estáticas -->
        <option value="feed_left" {{ $currentPosition == 'feed_left' ? 'selected' : '' }}>Feed Esquerda</option>
        <option value="feed_footer" {{ $currentPosition == 'feed_footer' ? 'selected' : '' }}>Feed Rodapé</option>
        <option value="companion" {{ $currentPosition == 'companion' ? 'selected' : '' }}>Acompanhantes</option>
        <option value="companion_left" {{ $currentPosition == 'companion_left' ? 'selected' : '' }}>Acompanhante Esquerda</option>
        <option value="companion_footer" {{ $currentPosition == 'companion_footer' ? 'selected' : '' }}>Acompanhante Rodapé</option>
        <option value="home" {{ $currentPosition == 'home' ? 'selected' : '' }}>Home</option>
        <option value="footer_home" {{ $currentPosition == 'footer_home' ? 'selected' : '' }}>Home Rodapé</option>
    </select>
</div>

<div class="mb-3 col-12 d-flex align-items-start flex-column">
    <label for="text" class="form-label text-dark">Google ADS</label>
    <input type="text" name="text" class="form-control-input d-block w-100 p-2" id="text{{isset($announcetement->id)?$announcetement->id:''}}" value="{{isset($announcetement)?$announcetement->text:''}}" placeholder="Texto do anuncio">
</div>
<div class="row">
    <div class="mb-3 col-6">
        <label for="start_date" class="form-label text-dark">Data início</label>
        <input type="date" name="start_date" class="form-control-input d-block w-100 p-2" 
       id="start_date{{ isset($announcetement->id) ? $announcetement->id : '' }}" 
       value="{{ isset($announcetement->start_date) ? \Carbon\Carbon::parse($announcetement->start_date)->format('Y-m-d') : '' }}">
    </div>
    <div class="mb-3 col-6">
        <label for="end_date" class="form-label text-dark">Data final</label>
        <input type="date" name="end_date" class="form-control-input d-block w-100 p-2" 
       id="end_date{{ isset($announcetement->id) ? $announcetement->id : '' }}" 
       value="{{ isset($announcetement->end_date) ? \Carbon\Carbon::parse($announcetement->end_date)->format('Y-m-d') : '' }}">
    </div>
</div>

<div class="mb-3 col-12 d-flex align-items-start flex-column">
    <label for="status" class="form-label text-dark">Status do Anuncio</label>
    <select id="status" name="status" class="form-select">
        @php
            $currentStatus = isset($announcetement) ? $announcetement->status : null;
        @endphp

        <option disabled {{ is_null($currentStatus) ? 'selected' : ''}}>Selecione um Status</option>
        <option value="completed" {{ $currentStatus == 'completed' ? 'selected' : '' }}>Ativo</option>
        <option value="pending" {{ $currentStatus == 'pending' ? 'selected' : '' }}>Pendente</option>
        <option value="inactive" {{ $currentStatus == 'inactive' ? 'selected' : '' }}>Inativo</option>
        <option value="expired" {{ $currentStatus == 'expired' ? 'selected' : '' }}>Expirado</option>

    </select>
</div>

<div class="col-lg-12">
    <div class="mt-3">
        <input type="file" name="path_image" data-plugins="dropify" data-default-file="{{isset($announcetement)?$announcetement->path_image<>''?url('storage/'.$announcetement->path_image):'':''}}"  />
        <p class="text-muted text-left mt-2 mb-0">Adicione uma imagem com tamanho máximo de <b class="text-danger">2 MB</b>.</p>
    </div>
</div>