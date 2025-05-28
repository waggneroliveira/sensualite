@extends('admin.core.client')
@section('content')
@php
    $name = Auth::guard('cliente')->user()->name;
    $email = Auth::guard('cliente')->user()->email;
    $imagePath = Auth::guard('cliente')->user()->path_image;

    if ($imagePath != null) {
        $imagePath = asset('storage/'.$imagePath);
    }else{
        $imagePath = asset('build/admin/images/userblock.png');
    }
@endphp

@include('admin.includes.header', [
    'titlePage' => 'Perfil',
    'userName' => collect(explode(' ', Auth::guard('cliente')->user()->name))->slice(0, 2)->implode(' '),
    'userEmail' => Auth::guard('cliente')->user()->email,
    'notifications' => '',
    'messages' => '',
    'logout' => route('admin.dashboard.client.logout'),
    'src' => $imagePath,
    'link' => '',
])
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row col-12">
                <div class="col-12 col-lg-12">
                    <div class="card card-body">
                        <form action="{{route('admin.dashboard.client.update', ['client' => $client->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="mb-3 geex-content__form__single__box d-block">
                                        <label for="name" class="form-label mb-2">Apelido <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control px-4 py-3" id="name{{isset($client->id)?$client->id:''}}" value="{{isset($client)?$client->name:''}}" placeholder="Digite seu nome" required>
                                    </div>
                                    <div class="mb-3 geex-content__form__single__box d-block">
                                        <label for="exampleInputEmail1" class="form-label mb-2">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{isset($client)?$client->email:''}}" class="form-control px-4 py-3" id="exampleInputEmail1{{isset($client->id)?$client->id:''}}" placeholder="Digite seu email" required>
                                    </div>

                                    <div class="mb-3 geex-content__form__single__box d-block">
                                        <label for="password" class="form-label mb-2">Senha <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password-{{ isset($client->id) ? $client->id : '' }}" class="form-control px-4 py-3" placeholder="Digite sua senha" {{ !isset($client) ? 'required' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="mb-3 geex-content__form__single__box d-block">
                                        <label class="form-label mb-2">Avatar</label>
                                        <div class="fileInputPreview">
                                            <img class="preview-file-img" src="{{isset($client)?$client->path_image<>''?url('storage/'.$client->path_image):'':''}}" alt="Pré-visualização">
                                            <label for="fileInput" class="labelInput">
                                                <i class="bx bx-upload"></i>
                                                <h5 class="fileText">Clique para fazer upload</h5>
                                                <p class="fileDescription">Carregar imagem com no máximo de 2mb</p>
                                            </label>
                                            <button class="btn btn-secondary removeFile">Remover</button>
                                            <div class="wrap-input">
                                                <input type="file" id="fileInput" name="path_image" class="fileInput">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="mt-3">
                                        <input type="file" name="path_image" data-plugins="dropify" data-default-file="{{isset($client)?$client->path_image<>''?url('storage/'.$client->path_image):'':''}}"  />
                                        <p class="text-muted text-center mt-2 mb-0">Adicione uma imagem com tamanho máximo de <b class="text-danger">2 MB</b>.</p>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{route('admin.dashboard')}}" class="btn btn-danger waves-effect waves-light">Voltar</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
