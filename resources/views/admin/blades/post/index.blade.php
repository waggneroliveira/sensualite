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
        'titlePage' => 'Post',
        'userName' => collect(explode(' ', Auth::guard('acompanhante')->user()->name))->slice(0, 2)->implode(' '),
        'userEmail' => Auth::guard('acompanhante')->user()->email,
        'messages' => '',
        'messageCount' => '3',
        'notifications' => '',
        'notificationsCount' => '4',
        'messages' => '',
        'link' => route('admin.dashboard.companion.profile.index'),
        'logout' => route('admin.dashboard.companion.logout'),
        'src' => $imagePath,
    ])
<div class=" table-responsive geex-content__section geex-content__section--transparent geex-content__todo mt-50">
    <div class="geex-content__todo__sidebar custom_al__file">
        <div class="geex-content__todo__sidebar__label">
            <div class="geex-content__todo__sidebar__text">
                <button class="geex-btn geex-btn--primary-transparent" data-bs-toggle="modal" data-bs-target="#modal-post-group">
                    <i class="uil-plus me-1"></i>
                    Criar Post
                </button>

                <div id="modal-post-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header p-3 pt-2 pb-2 geex-btn--primary">
                                <h4 class="page-title text-white">Criar Post</h4>
                                <button type="button" class="btn-close w-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-3 pt-0 pb-3">
                                <div class="card-body p-0">
                                    <form action="{{route('admin.dashboard.companion.post.store')}}" method="POST">
                                        @csrf
                                        @method('post')
                                        <div class="geex-content__form__single__box mb-20 flex-column p-25">
                                            <div class="mb-3 col-12 d-flex align-items-start flex-column">
                                                <label for="apparence-select" class="form-label text-dark">Exibição do post</label>
                                                <select name="apparence_type" class="form-select">
                                                    <option disabled selected>Selecione a forma de exibição do post</option>
                                                    <option value="one">Full</option>
                                                    <option value="two">Dois em dois</option>
                                                    <option value="threee">Três em três</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <label for="textarea-create" class="form-label text-dark textareaId">Descrição do Post</label>
                                                <textarea name="text" id="textarea-create" placeholder="Texto" class="col-12" rows="10"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="geex-btn geex-btn--primary mb-0 w-auto"> Avançar</button>
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
                    <a href="{{route('admin.dashboard.companion.post.index')}}" class="nav-link {{Route::currentRouteName() == 'admin.dashboard.companion.post.index'? 'active': ''}}">
                        <img src="{{asset('build/admin/images/file/01.png')}}" alt="">
                        Todos os Posts
                    </a>
                </li>
                @foreach ($posts as $post)
                    <li class="nav-item" role="presentation">
                        <a href="{{route('admin.dashboard.companion.postId', [$post->id])}}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard.companion.postId'? 'active' : '' }}">
                            <div class="d-flex flex-row gap-3 justify-content-start w-100">
                                <div class="profile-picture">
                                    <img src="{{asset('build/admin/images/file/02.png')}}" alt="reviews">
                                </div>
                                <div class="col-8 d-flex justify-content-center align-items-start flex-column">
                                    {!!isset($post->text)? substr(strip_tags($post->text), 0, 18) . '...' : 'Post: ' . $post->created_at->format('d/m/Y')!!}
                                    <span class="mt-2" style="font-size: 10px;">{{$post->created_at->format('d/m/Y')}}</span>
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

                        <div class="title">{{substr(strip_tags($postTitle), 0, 50)}}...</div>

                        @if (isset($postId) && $postId !== '')
                            <button class="update" data-bs-toggle="modal" data-bs-target="#modal-post-edit-{{$postId}}">
                                <i class="uil uil-pen"></i>
                            </button>

                            <form action="{{route('admin.dashboard.companion.post.destroy', $postId)}}" method="POST">
                                @method('DELETE') @csrf

                                <button type="submit" class="deletar">
                                    <i class="uil uil-trash"></i>
                                </button>
                            </form>

                            <div id="modal-post-edit-{{$postId}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header p-3 pt-2 pb-2 geex-btn--primary">
                                            <h4 class="page-title text-white">Editar Post</h4>
                                            <button type="button" class="btn-close w-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-3 pt-0 pb-3">
                                            <div class="card-body p-0">
                                                <form action="{{route('admin.dashboard.companion.post.update', ['post' => $postId])}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="geex-content__form__single__box mb-20 flex-column p-25">
                                                        <div class="mb-3 col-12 d-flex align-items-start flex-column">
                                                            <label for="apparence-select" class="form-label text-dark">Exibição do post</label>
                                                            <select name="apparence_type" class="form-select">
                                                                <option value="one" {{isset($post->one)?'selected':''}}>Normal</option>
                                                                <option value="two" {{isset($post->two)?'selected':''}}>Dois em dois</option>
                                                                <option value="threee" {{isset($post->trhee)?'selected':''}}>Três em três</option>
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <label for="textarea-edit-{{$postId}}" class="form-label text-dark textareaId">Descrição do Post</label>
                                                            <textarea name="text" id="textarea-edit-{{$postId}}" placeholder="Texto" class="col-12" rows="10">
                                                                {{isset($post->text)?$post->text: ''}}
                                                            </textarea>
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
                        @endif
                    </div>
                </div>
            </div>
            @if (Route::currentRouteName() == 'admin.dashboard.companion.postId')
                <div class="w-100 d-flex flex-row justify-content-end">
                    <div class="d-flex flex-row justify-content-end gap-2">
                        @if ($postContent->postFile->count() == 0)
                            <button type="button" class="geex-btn geex-btn--primary-transparent" data-bs-toggle="modal" data-bs-target="#modal-image-post"><i class="uil-plus me-1"></i> Adicionar arquivos</button>
                        @endif
                        <!--Modal galeria-->
                        <div id="modal-image-post" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" style="max-width: 800px;">
                                <div class="modal-content geex-content__section">
                                    <div class="modal-header p-3 pt-2 pb-2 geex-btn--primary">
                                        <h4 class="page-title text-white">Cadastrar Arquivos de imagem e vídeo</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body p-3 pt-0 pb-3">
                                        <div class="card-body p-0">
                                            <form action="{{route('admin.dashboard.companion.postFile.store')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" name="post_id" value="{{$post_id}}">

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
                    </div>
                    <table class="table-reviews-geex-1 custom_filemanager">
                        <tbody>
                            <tr class="content-image row g-5 mt-3 bg-white single-contact-grid-area">
                                @if ($postContent)
                                    @if ($post_id)
                                        {{-- Exibir arquivos de uma galeria específica --}}
                                        @if ($postContent->postFile !== null)
                                            @foreach ($postContent->postFile as $contentFile)
                                                @php
                                                    $mimeTypePath = $contentFile->file;
                                                    $postUrl = asset('storage/' . $mimeTypePath);
                                                    $mimeType = Storage::mimeType($mimeTypePath);
                                                @endphp

                                                @if (str_starts_with($mimeType, 'image/'))
                                                    <td class="top-area d-block col-sm-6 col-md-4 col-lg-4 px-1 py-0 mt-0 mb-2 position-relative">
                                                        <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                            <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                <i class="uil-ellipsis-h"></i>
                                                            </a>
                                                            <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                <ul class="geex-content__chat__header__filter__content__list">
                                                                    <li class="geex-content__chat__header__filter__content__list__item">
                                                                        <form id="postFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.postFile.update', ['postFile' => $contentFile->id])}}" method="post">
                                                                            @method('put')
                                                                            @csrf
                                                                            <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                            <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                        </form>
                                                                    </li>
                                                                    <li class="geex-content__chat__header__filter__content__list__item">
                                                                        <form action="{{ route('admin.dashboard.companion.postFile.destroy', ['postFile' => $contentFile->id]) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="deletar">Deletar</button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <a data-fancybox="post" href="{{ $postUrl }}" class="{{$contentFile->active == 0 ? 'desativa': ''}}">
                                                            <div class="image overflow-hidden">
                                                                <div class="card hover-shadow max-image rounded-0">
                                                                    <img src="{{ $postUrl }}" class="card-img-top" alt="Imagem">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        {{-- Exibir arquivos de todas as galerias --}}
                                        @foreach ($postContent as $post)
                                            @if ($post->postFile !== null)
                                                @foreach ($post->postFile as $contentFile)
                                                    @php
                                                        $mimeTypePath = $contentFile->file;
                                                        $postUrl = asset('storage/' . $mimeTypePath);
                                                        $mimeType = Storage::mimeType($mimeTypePath);
                                                    @endphp

                                                    @if (str_starts_with($mimeType, 'image/'))
                                                        <td class="top-area d-block col-sm-6 col-md-4 col-lg-4 px-1 py-0 mt-0 mb-2 position-relative">
                                                            <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                                <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                    <i class="uil-ellipsis-h"></i>
                                                                </a>
                                                                <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                    <ul class="geex-content__chat__header__filter__content__list">
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form id="postFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.postFile.update', ['postFile' => $contentFile->id])}}" method="post">
                                                                                @method('put')
                                                                                @csrf
                                                                                <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                                <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                            </form>
                                                                        </li>
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form action="{{ route('admin.dashboard.companion.postFile.destroy', ['postFile' => $contentFile->id]) }}" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button type="submit" class="deletar">Deletar</button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <a data-fancybox="post" href="{{ $postUrl }}" class="{{$contentFile->active == 0 ? 'desativa': ''}}">
                                                                <div class="image overflow-hidden">
                                                                    <div class="card hover-shadow max-image rounded-0">
                                                                        <img src="{{ $postUrl }}" class="card-img-top" alt="Imagem">
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
                                @if ($postContent)
                                    @if ($post_id)
                                        {{-- Exibir arquivos de uma galeria específica --}}
                                        @if ($postContent->postFile !== null)
                                            @foreach ($postContent->postFile as $contentFile)
                                                @php
                                                    $mimeTypePath = $contentFile->file;
                                                    $postUrl = asset('storage/' . $mimeTypePath);
                                                    $mimeType = Storage::mimeType($mimeTypePath);
                                                @endphp

                                                @if (str_starts_with($mimeType, 'video/'))
                                                    <td class="top-area d-block col-sm-6 col-md-4 col-lg-4 px-1 py-0 mt-0 mb-2 position-relative">
                                                        <div class="video w-100">
                                                            <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                                <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                    <i class="uil-ellipsis-h"></i>
                                                                </a>
                                                                <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                    <ul class="geex-content__chat__header__filter__content__list">
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form id="postFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.postFile.update', ['postFile' => $contentFile->id])}}" method="post">
                                                                                @method('put')
                                                                                @csrf
                                                                                <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                                <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                            </form>
                                                                        </li>
                                                                        <form action="{{ route('admin.dashboard.companion.postFile.destroy', ['postFile' => $contentFile->id]) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="deletar">Deletar</button>
                                                                        </form>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="video w-100 {{$contentFile->active == 0 ? 'desativa': ''}}">
                                                                <video controls style="width: 100%;">
                                                                    <source src="{{ $postUrl }}" type="video/mp4" />
                                                                </video>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        {{-- Exibir arquivos de todas as galerias --}}
                                        @foreach ($postContent as $post)
                                            @if ($post->postFile !== null)
                                                @foreach ($post->postFile as $contentFile)
                                                    @php
                                                        $mimeTypePath = $contentFile->file;
                                                        $postUrl = asset('storage/' . $mimeTypePath);
                                                        $mimeType = Storage::mimeType($mimeTypePath);
                                                    @endphp

                                                    @if (str_starts_with($mimeType, 'video/'))
                                                        <td class="top-area d-block col-sm-6 col-md-4 col-lg-4 px-1 py-0 mt-0 mb-2 position-relative">
                                                            <div class="geex-content__todo__sidebar__text w-100 position-absolute px-2" style="z-index: 10;">
                                                                <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                                    <i class="uil-ellipsis-h"></i>
                                                                </a>
                                                                <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                                    <ul class="geex-content__chat__header__filter__content__list">
                                                                        <li class="geex-content__chat__header__filter__content__list__item">
                                                                            <form id="postFileForm-{{$contentFile->id}}" action="{{route('admin.dashboard.companion.postFile.update', ['postFile' => $contentFile->id])}}" method="post">
                                                                                @method('put')
                                                                                @csrf
                                                                                <input id="activeInput" class="inputImage" name="active" type="checkbox" {{ isset($contentFile->active) && $contentFile->active == 1 ? 'checked' : ''}} />
                                                                                <button type="button" class="toggleButton">{{ $contentFile->active == 1 ? 'Desativar' : 'Ativar' }}</button>
                                                                            </form>
                                                                        </li>

                                                                        <form action="{{ route('admin.dashboard.companion.postFile.destroy', ['postFile' => $contentFile->id]) }}" method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="deletar">Deletar</button>
                                                                        </form>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="video w-100 {{$contentFile->active == 0 ? 'desativa': ''}}">
                                                                <video controls style="width: 100%;">
                                                                    <source src="{{ $postUrl }}" type="video/mp4" />
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
    .toggleButton, .deletar, .update {
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
