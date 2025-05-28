@extends('admin.core.admin')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row col-12">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.dashboard.user.index')}}">Usuários</a></li>
                                <li class="breadcrumb-item active">Meu perfil</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Editar</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row col-12">
                <div class="col-12 col-lg-12">
                    <div class="card card-body">
                        <form action="{{route('admin.dashboard.user.update', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Usuários <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name{{isset($user->id)?$user->id:''}}" value="{{isset($user)?$user->name:''}}" placeholder="Digite seu nome" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{isset($user)?$user->email:''}}" class="form-control" id="exampleInputEmail1{{isset($user->id)?$user->id:''}}" placeholder="Digite seu email" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password-{{ isset($user->id) ? $user->id : '' }}" class="form-control" placeholder="Digite sua senha" {{ !isset($user) ? 'required' : '' }}>
                                        </div>
                                    </div>
                                    
                                    <div class="form-check">
                                        <input name="active" {{ isset($user->active) && $user->active == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($user->id)?$user->id:''}}" />
                                        <label class="form-check-label" for="invalidCheck">Ativo?</label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="mt-3">
                                        <input type="file" name="path_image" data-plugins="dropify" data-default-file="{{isset($user)?$user->path_image<>''?url('storage/'.$user->path_image):'':''}}"  />
                                        <p class="text-muted text-center mt-2 mb-0">Adicione uma imagem com tamanho máximo de <b class="text-danger">2 MB</b>.</p>
                                    </div>
                                </div>
                            </div>                           

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{route('admin.dashboard.user.index')}}" class="btn btn-danger waves-effect waves-light">Cancelar</a>
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