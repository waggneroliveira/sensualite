@extends('admin.core.companion')
@section('content')
    @php
        $imagePath = Auth::guard('acompanhante')->user()->path_file_profile;
        if ($imagePath != null) {
            $imagePath = asset('storage/'.$imagePath);
        }else{
            $imagePath = 'build/admin/images/userblock.png';
        }
    @endphp

    @include('admin.includes.header', [
        'titlePage' => 'Ensaios',
        'userName' => collect(explode(' ', Auth::guard('acompanhante')->user()->name))->slice(0, 2)->implode(' '),
        'userEmail' => Auth::guard('acompanhante')->user()->email,
        'messages' => '',
        'messageCount' => '3',
        'notifications' => '',
        'notificationsCount' => '4',
        'messages' => '',
        'logout' => route('admin.dashboard.companion.logout'),
        'src' => $imagePath,
        'link' => route('admin.dashboard.companion.profile.index'),
    ])
<div class=" table-responsive geex-content__section geex-content__section--transparent geex-content__todo mt-50">
    <div class="geex-content__todo__sidebar custom_al__file">
        <div class="geex-content__todo__sidebar__label">
            <div class="geex-content__todo__sidebar__text">
                @if ($galleries->count() < 3)
                    <button class="geex-btn geex-btn--primary-transparent" data-bs-toggle="modal" data-bs-target="#modal-gallery-group">
                        <i class="uil-plus me-1"></i>
                        Adicionar Galeria
                    </button>
                @endif

                <div id="modal-gallery-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header p-3 pt-2 pb-2 geex-btn--primary">
                                <h4 class="page-title text-white">Criar galeria</h4>
                                <button type="button" class="btn-close w-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-3 pt-0 pb-3">
                                <div class="card-body p-0">
                                    <form action="{{route('admin.dashboard.companion.gallery.store')}}" method="POST">
                                        @csrf
                                        @method('post')
                                        <div class="geex-content__form__single__box mb-20 flex-column p-25">
                                            <div class="row">
                                                <label for="title" class="form-label text-dark">Nome da galeria <span class="text-danger">*</span></label>
                                                <input type="text" name="title" class="form-control-input d-block w-100 p-3" id="title"  placeholder="Digite o nome da galeria" required>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="geex-btn geex-btn--primary mb-0 w-auto"> Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs geex-content__todo__sidebar__tab mb-20"
            id="geex-todo-task-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{route('admin.dashboard.companion.gallery.index')}}" class="nav-link {{Route::currentRouteName() == 'admin.dashboard.companion.gallery.index'? 'active': ''}}">
                        <img src="{{asset('build/admin/images/file/01.png')}}" alt="">
                        Todas as Galerias
                    </a>
                </li>
                @foreach ($galleries as $gallery)
                    <li class="nav-item" role="presentation">
                        <a href="{{route('admin.dashboard.companion.galleryId', [$gallery->id])}}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard.companion.galleryId' ? 'active' : '' }}">
                            <div class="d-flex flex-row gap-2 justify-content-between w-100">
                                <div class="profile-picture col-4">
                                    <img src="{{asset('build/admin/images/file/02.png')}}" alt="reviews">
                                </div>
                                <div class="col-8 d-flex justify-content-center align-items-start flex-column">
                                    {{$gallery->title}}
                                    @switch($gallery->status)
                                        @case('approved')
                                            <span class="py-1 px-5 mt-2 geex-badge geex-badge--label-icon geex-badge--success-transparent">Aprovado</span>
                                            @break
                                        @case('rejected')
                                            <span class="py-1 px-5 mt-2 geex-badge geex-badge--label-icon geex-badge--danger-transparent">Rejeitado</span>
                                            @break
                                        @default
                                            <span class="py-1 px-5 mt-2 geex-badge geex-badge--label-icon geex-badge--warning-transparent">Pendente</span>
                                    @endswitch
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="geex-content__todo__content tab-content" id="geex-todo-task-content">
        <div class="tab-pane fade show active" id="geex-todo-task-content-important">
            <div class="geex-content__todo__header custom_al__file">
                <div class="geex-content__todo__header__title">
                    <div class="title">
                        <i class="uil-info-circle"></i>

                        <h4>{{$galleryTitle}}</h4>
                    </div>
                    @if (isset($galleryContent->requested_at) && $galleryContent->requested_at != null && $galleryContent->rejected_at == null && $galleryContent->approved_at == null)
                        <div class="msg-user alert alert-warning d-flex align-items-center gap-2" role="alert">
                            <i class="uil uil-exclamation-circle fs-4"></i>
                            <div>
                                Sua solicitação está em processo de análise. Em breve, você receberá uma atualização sobre o status da sua solicitação. Agradecemos pela paciência.
                            </div>
                        </div>
                    @endif
                    @if (isset($galleryContent->approved_at) && $galleryContent->approved_at != null)
                        <div class="msg-user alert alert-success d-flex align-items-center gap-2" role="alert">
                            <i class="uil uil-check-circle fs-4"></i>
                            <div>
                                Ensaio Aprovado!
                            </div>
                        </div>
                    @endif
                    @if (isset($galleryContent->rejected_at) && $galleryContent->rejected_at != null)
                        <div class="msg-user alert alert-danger d-flex align-items-center gap-2" role="alert">
                            <i class="uil uil-times-circle fs-4"></i>
                            <div>
                                Após análise, sua solicitação não pôde ser aprovada neste momento. Caso deseje, você poderá reenviar com as devidas correções. Agradecemos pela compreensão.
                            </div>
                        </div>
                        @if ($galleryContent->rejection_reason != null)
                            <div class="msg-user alert alert-light d-flex align-items-center gap-2" role="alert">
                                <i class="uil uil-exclamation-circle fs-4"></i>
                                <div>
                                    <b>Motivo:</b> {{$galleryContent->rejection_reason}}
                                </div>
                            </div>
                        @endif

                    @endif
                    @if (isset($galleryContent->galleryFile) && $galleryContent->galleryFile->count() < 20 && $galleryContent->approved_at == null)
                        <div class="msg-user alert alert-warning d-flex align-items-center gap-2" role="alert">
                            <i class="uil uil-exclamation-circle fs-4"></i>
                            <div>
                                O limite máximo de uploads é de 20 arquivos, incluindos vídeos e imagens.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if (Route::currentRouteName() == 'admin.dashboard.companion.galleryId')
                <div class="w-100 d-flex flex-row justify-content-end">
                    <div class="d-flex flex-row justify-content-end gap-2">
                        @if (isset($galleryContent->galleryFile) && $galleryContent->galleryFile->count() < 20 && $galleryContent->approved_at == null)
                            <button type="button" class="geex-btn geex-btn--primary-transparent" data-bs-toggle="modal" data-bs-target="#modal-image-gallery"><i class="uil-plus me-1"></i> Adicionar arquivos</button>
                        @endif
                        <!--Modal galeria-->
                        <div id="modal-image-gallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" style="max-width: 800px;">
                                <div class="modal-content geex-content__section">
                                    <div class="modal-header p-3 pt-2 pb-2 geex-btn--primary">
                                        <h4 class="page-title text-white">Cadastrar Arquivos de imagem e vídeo</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body p-3 pt-0 pb-3">
                                        <div class="card-body p-0">
                                            {{-- <h4 class="header-title mt-3">Inserir Arquivos</h4>
                                            <p class="sub-header">
                                                Clique na área designada abaixo para adicionar seus arquivos. Você pode selecionar uma ou vários arquivos para enviar.
                                            </p> --}}

                                            <form action="{{route('admin.dashboard.companion.galleryFile.store')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" name="gallery_id" value="{{$gallery_id}}">
                                                <div class="mb-3 mt-3">
                                                    <div class="fileInputPreview">
                                                        <img class="preview-file-img" src="" alt="Pré-visualização">
                                                        <label for="fileInput" class="labelInput">
                                                            <i class="bx bx-upload"></i>
                                                            <h5 class="fileText">Clique para fazer upload</h5>
                                                            <p class="fileDescription">Carregar imagens com no máximo de 2mb</p>
                                                        </label>
                                                        <button class="btn btn-secondary removeFile">Remover</button>
                                                        <div class="wrap-input">
                                                            <input type="file" id="fileInput" name="file[]" class="fileInput" multiple onchange="updateFileCount(this)">
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <label for="imageInput" class="custom-file-upload">Selecionar Arquivos</label>
                                                <input id="imageInput" name="file[]" type="file" multiple onchange="updateFileCount(this)" /> --}}
                                                <span id="fileCount">Nenhum arquivo selecionado</span>
                                                <button type="submit" class="btn btn-secondary waves-effect waves-light float-end mb-3 me-0 width-lg align-items-left">Enviar</button>
                                            </form>

                                            <script>
                                                function updateFileCount(input) {
                                                    var count = input.files.length;
                                                    var fileCountText = count + (count === 1 ? ' arquivo selecionado' : ' arquivos selecionados');
                                                    document.getElementById('fileCount').innerText = fileCountText;
                                                }
                                            </script>
                                        </div> <!-- end card-body-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal galeria-->
                        @if (isset($galleryContent) && $galleryContent->requested_at == null &&
                        $galleryContent->companion_id == Auth::guard('acompanhante')->user()->id &&
                        isset($galleryContent->galleryFile) && isset($gallery_id) && $gallery_id !== null)
                            <form action="{{route('admin.dashboard.companion.gallery.requestApproval', ['galleryId' => $gallery_id])}}" method="post">
                                @csrf
                                <button type="submit" class="geex-btn geex-btn--primary"> Solicitar aprovação</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
            <div class="file_manager_content__body">
                <div class="mt-30 geex-content__section geex-content__form table-responsive">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <button class="btn-video geex-btn geex-btn--primary px-20 py-2 rounded-2">Vídeo</button>
                            <button class="btn-image geex-btn geex-btn--primary px-20 py-2 rounded-2">Fotos</button>
                        </div>

                        @php
                            if (isset($galleryContent)) {
                                if ($galleryContent instanceof \Illuminate\Support\Collection) {
                                    // Somar os arquivos de todas as galerias
                                    $total = $galleryContent->sum(function($gallery) {
                                        return $gallery->galleryFile->count();
                                    });
                                } else {
                                    // Contar os arquivos da galeria específica
                                    $total = $galleryContent->galleryFile->count();
                                }
                            } else {
                                $total = 0;
                            }
                        @endphp

                        <p>Total de arquivos: {{ $total }}</p>

                    </div>
                    <table class="table-reviews-geex-1 custom_filemanager">
                        <tbody>
                            <tr class="content-image row g-5 mt-3 bg-white single-contact-grid-area">
                                @if ($galleryContent)
                                    @if ($gallery_id)
                                        {{-- Exibir arquivos de uma galeria específica --}}
                                        @if ($galleryContent->galleryFile !== null)
                                            @foreach ($galleryContent->galleryFile as $contentFile)
                                                @php
                                                    $mimeTypePath = $contentFile->file;
                                                    $galleryUrl = asset('storage/' . $mimeTypePath);
                                                    $mimeType = Storage::mimeType($mimeTypePath);
                                                @endphp

                                                @if (str_starts_with($mimeType, 'image/'))
                                                    <td class="top-area d-block col-sm-6 col-md-4 col-lg-3 px-1 py-0 mt-0 mb-2 position-relative">
                                                        <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                            <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                <i class="uil-ellipsis-h"></i>
                                                            </a>
                                                            <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                <ul class="geex-content__chat__header__filter__content__list">
                                                                    <li class="geex-content__chat__header__filter__content__list__item">
                                                                        <form id="galleryFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.galleryFile.update', ['galleryFile' => $contentFile->id])}}" method="post">
                                                                            @method('put')
                                                                            @csrf
                                                                            <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                            <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                        </form>
                                                                    </li>
                                                                    @if ($galleryContent->approved_at == null)
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form action="{{ route('admin.dashboard.companion.galleryFile.destroy', ['galleryFile' => $contentFile->id]) }}" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button type="submit" class="deletar">Deletar</button>
                                                                            </form>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <a data-fancybox="gallery" href="{{ $galleryUrl }}" class="{{$contentFile->active == 0 ? 'desativa': ''}}">
                                                            <div class="image overflow-hidden">
                                                                <div class="card hover-shadow max-image rounded-0">
                                                                    <img src="{{ $galleryUrl }}" class="card-img-top" alt="Imagem">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        {{-- Exibir arquivos de todas as galerias --}}
                                        @foreach ($galleryContent as $gallery)
                                            @if ($gallery->galleryFile !== null)
                                                @foreach ($gallery->galleryFile as $contentFile)
                                                    @php
                                                        $mimeTypePath = $contentFile->file;
                                                        $galleryUrl = asset('storage/' . $mimeTypePath);
                                                        $mimeType = Storage::mimeType($mimeTypePath);
                                                    @endphp

                                                    @if (str_starts_with($mimeType, 'image/'))
                                                        <td class="top-area d-block col-sm-6 col-md-4 col-lg-3 px-1 py-0 mt-0 mb-2 position-relative">
                                                            <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                                <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                    <i class="uil-ellipsis-h"></i>
                                                                </a>
                                                                <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                    <ul class="geex-content__chat__header__filter__content__list">
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form id="galleryFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.galleryFile.update', ['galleryFile' => $contentFile->id])}}" method="post">
                                                                                @method('put')
                                                                                @csrf
                                                                                <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                                <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                            </form>
                                                                        </li>
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form action="{{ route('admin.dashboard.companion.galleryFile.destroy', ['galleryFile' => $contentFile->id]) }}" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button type="submit" class="deletar">Deletar</button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <a data-fancybox="gallery" href="{{ $galleryUrl }}" class="{{$contentFile->active == 0 ? 'desativa': ''}}">
                                                                <div class="image overflow-hidden">
                                                                    <div class="card hover-shadow max-image rounded-0">
                                                                        <img src="{{ $galleryUrl }}" class="card-img-top" alt="Imagem">
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endif

                            </tr>
                            <tr class="content-video row g-5 mt-3 bg-white single-contact-grid-area">
                                @if ($galleryContent)
                                    @if ($gallery_id)
                                        {{-- Exibir arquivos de uma galeria específica --}}
                                        @if ($galleryContent->galleryFile !== null)
                                            @foreach ($galleryContent->galleryFile as $contentFile)
                                                @php
                                                    $mimeTypePath = $contentFile->file;
                                                    $galleryUrl = asset('storage/' . $mimeTypePath);
                                                    $mimeType = Storage::mimeType($mimeTypePath);
                                                @endphp

                                                @if (str_starts_with($mimeType, 'video/'))
                                                    <td class="top-area d-block col-sm-6 col-md-4 col-lg-3 px-1 py-0 mt-0 mb-2 position-relative">
                                                        <div class="video w-100">
                                                            <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                                <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                    <i class="uil-ellipsis-h"></i>
                                                                </a>
                                                                <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                    <ul class="geex-content__chat__header__filter__content__list">
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form id="galleryFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.galleryFile.update', ['galleryFile' => $contentFile->id])}}" method="post">
                                                                                @method('put')
                                                                                @csrf
                                                                                <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                                <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                            </form>
                                                                        </li>
                                                                        <form action="{{ route('admin.dashboard.companion.galleryFile.destroy', ['galleryFile' => $contentFile->id]) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="deletar">Deletar</button>
                                                                        </form>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="video w-100 {{$contentFile->active == 0 ? 'desativa': ''}}">
                                                                <video controls style="width: 100%;">
                                                                    <source src="{{ $galleryUrl }}" type="video/mp4" />
                                                                </video>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        {{-- Exibir arquivos de todas as galerias --}}
                                        @foreach ($galleryContent as $gallery)
                                            @if ($gallery->galleryFile !== null)
                                                @foreach ($gallery->galleryFile as $contentFile)
                                                    @php
                                                        $mimeTypePath = $contentFile->file;
                                                        $galleryUrl = asset('storage/' . $mimeTypePath);
                                                        $mimeType = Storage::mimeType($mimeTypePath);
                                                    @endphp

                                                    @if (str_starts_with($mimeType, 'video/'))
                                                        <td class="top-area d-block col-sm-6 col-md-4 col-lg-3 px-1 py-0 mt-0 mb-2 position-relative">
                                                            <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                                <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                    <i class="uil-ellipsis-h"></i>
                                                                </a>
                                                                <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                    <ul class="geex-content__chat__header__filter__content__list">
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form id="galleryFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.galleryFile.update', ['galleryFile' => $contentFile->id])}}" method="post">
                                                                                @method('put')
                                                                                @csrf
                                                                                <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                                <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                            </form>
                                                                        </li>

                                                                        <form action="{{ route('admin.dashboard.companion.galleryFile.destroy', ['galleryFile' => $contentFile->id]) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="deletar">Deletar</button>
                                                                        </form>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="video w-100 {{$contentFile->active == 0 ? 'desativa': ''}}">
                                                                <video controls style="width: 100%;">
                                                                    <source src="{{ $galleryUrl }}" type="video/mp4" />
                                                                </video>
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endif

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .toggleButton, .deletar {
        all: unset;
        cursor: pointer;
    }
    .desativa{
        position: relative;
        pointer-events: none;
    }
    .desativa::before{
        content: '';
        background: #000000a8;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        width: 100%;
        height: 100%;
    }
    .inputImage{
       display: none;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnVideos = document.querySelectorAll(".btn-video");
        const btnImages = document.querySelectorAll(".btn-image");

        const contentVideos = document.querySelectorAll(".content-video");
        const contentImages = document.querySelectorAll(".content-image");

        const showVideo = () => {
            contentVideos.forEach(content => {
                content.style.display = "flex";
            });
            contentImages.forEach(content => {
                content.style.display = "none";
            });
        };

        const showImage = () => {
            contentVideos.forEach(content => {
                content.style.display = "none";
            });
            contentImages.forEach(content => {
                content.style.display = "flex";
            });
        };

        // Adiciona o evento de clique para todos os botões de vídeo
        btnVideos.forEach(btn => {
            btn.addEventListener("click", showVideo);
        });

        // Adiciona o evento de clique para todos os botões de imagem
        btnImages.forEach(btn => {
            btn.addEventListener("click", showImage);
        });

        showImage(); // Exibe as imagens por padrão ao carregar a página
    });


    //Script p ação da imagem
    const toggleButtons = document.querySelectorAll('.toggleButton');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Obtém o formulário e o checkbox associado
            const form = button.closest('form');
            const activeInput = form.querySelector('input[name="active"]');

            // Inverte o estado do checkbox
            activeInput.checked = !activeInput.checked;

            // Muda o texto do botão conforme o estado do checkbox
            button.textContent = activeInput.checked ? 'Desativar' : 'Ativar';

            // Envia o formulário
            form.submit();
        });
    });
</script>

@endsection
