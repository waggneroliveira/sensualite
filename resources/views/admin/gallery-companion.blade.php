@extends('admin.core.admin')
<style>    
    .hover-shadow:hover img{
        transform: scale(1.2);
        transition: 0.3s ease-in-out;
    }
    .hover-shadow img{
        transform: scale(1);
        transition: 0.3s ease-in-out;
    }
</style>
@section('content')
<div class="container my-5">
    <div class="d-flex flex-row justify-content-between">
        <button class="geex-btn geex-btn--primary"><i class="uil uil-arrow-left"></i> <a href="{{route('admin.dashboard.companion.file')}}" style="color: #FFF">Voltar</a> </button>
        <div class="d-flex flex-row justify-content-end gap-2">
            <button type="button" class="geex-btn geex-btn--primary-transparent" data-bs-toggle="modal" data-bs-target="#modal-image-gallery"><i class="uil-plus me-1"></i> Adicionar arquivos</button>
            <!--Modal galeria-->
            <div id="modal-image-gallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="max-width: 800px;">
                    <div class="modal-content">
                        <div class="modal-header p-3 pt-2 pb-2 geex-btn--primary">
                            <h4 class="page-title text-white">Cadastrar Arquivos de imagem e vídeo</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body p-3 pt-0 pb-3">
                            <div class="card-body p-0">
                                <h4 class="header-title mt-3">Inserir Arquivos</h4>
                                <p class="sub-header">
                                    Clique na área designada abaixo para adicionar seus arquivos. Você pode selecionar uma ou vários arquivos para enviar.
                                </p>
    
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="gallery_id" value="">
                                    <label for="imageInput" class="custom-file-upload">Selecionar Arquivos</label>
                                    <input id="imageInput" name="file[]" type="file" multiple onchange="updateFileCount(this)" />
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
            
            <button class="geex-btn geex-btn--primary" data-bs-toggle="modal" data-bs-target="#modal-image-gallery-approved"> Solicitar aprovação</button>
            <div id="modal-image-gallery-approved" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="max-width: 800px;">
                    <div class="modal-content">
                        <div class="modal-header p-3 pt-2 pb-2 geex-btn--primary">
                            <h4 class="page-title text-white">Solicitação de aprovação de galeria</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body p-3 pt-0 pb-3">
                            <div class="card-body p-0">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="geex-content__form__single__box mb-20 flex-column p-25">
                                        <div class="row">
                                            <div class="input-wrapper">
                                                <label for="geex-input-5" class="input-label">Nome</label>
                                                <input placeholder="Nome" readonly class="form-control" id="geex-input5" Value="Wagner Oliveira" />
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="geex-input-5" class="input-label">Galeria</label>
                                                <input placeholder="Nome" readonly class="form-control" id="geex-input5" Value="Galeria 01" />
                                            </div>
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="geex-input-5" class="input-label">Texto</label>
                                            <textarea class="form-control" id="geex-textarea1" rows="5"></textarea>
                                        </div>
                                    </div>
                                </form>                            
                            </div> <!-- end card-body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="geex-content__header__title mt-5">Galeria 01</h4> 
    <div class="row g-4 mt-3">
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a data-fancybox="gallery" href="{{ asset('build/admin/images/avatar/user-10.jpg') }}">
                <div class="card overflow-hidden hover-shadow">
                    <img src="{{ asset('build/admin/images/avatar/user-10.jpg') }}" class="card-img-top" alt="Imagem 1">
                </div>
            </a>
        </div>

    </div>
</div>
@endsection