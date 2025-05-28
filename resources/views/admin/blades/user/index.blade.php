@extends('admin.core.admin')
@section('content')
<style>
    .btn-group.focus-btn-group{
        display: none;
    }
</style>
@php
    $hasActiveSubscription = null;
    $imagePath = Auth::user()->path_image;
    if ($imagePath != null) {
        $imagePath = asset('storage/'.$imagePath);
    }else{
        $imagePath = asset('build/admin/images/userblock.png');
    }
@endphp

@include('admin.includes.header', [
    'titlePage' => 'Dashboard',
    'userName' => collect(explode(' ', Auth::user()->name))->slice(0, 2)->implode(' '),        
    'userEmail' => Auth::user()->email,
    'src' => $imagePath,
    'messages' => '',
    'messageCount' => '3',
    'notifications' => '',
    'notificationsCount' => '4',
    'messages' => '',
    'link' => route('admin.dashboard.user.edit', Auth::user()->id),
    'logout' => route('admin.dashboard.user.logout'),
])
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="m-0 d-flex justify-content-end">
                                <li class="me-3"><a href="{{route('admin.dashboard')}}"><span class="mdi mdi-home"></span> Dashboard</a></li>
                                <li class="active">Usuários</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Usuários</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12 d-flex justify-between">
                                    <div class="col-6">
                                        @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['usuario.visualizar', 'usuario.remover']))
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.user.destroySelected')}}" type="button" class="btSubmitDelete btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['usuario.visualizar', 'usuario.criar']))
                                            <button type="button" class="geex-btn geex-btn--primary" data-bs-toggle="modal" data-bs-target="#user-create"><i class="mdi mdi-plus-circle me-1"></i> Adicionar</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="user-create" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light">
                                                            <h4 class="modal-title" id="myCenterModalLabel">Adicionar</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <form action="{{route('admin.dashboard.user.store')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @include('admin.blades.user.form')  
                                                                <div class="d-flex justify-content-end gap-2">
                                                                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-success waves-effect waves-light">Adicionar</button>
                                                                </div>                                                 
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        @endif
                                    </div>
                                </div>
                            </div>
    
                            <div class="table-responsive">
                                <table class="table-sortable table table-centered table-nowrap table-striped" id="products-datatable">
                                    <thead>                                        
                                        <tr>
                                            <th></th>
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" type="checkbox"></label>
                                            </th>
                                            <th>Usuário</th>
                                            <th>Email</th>
                                            <th>Criado em</th>
                                            <th>Status</th>
                                            <th style="width: 85px;">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody data-route="{{route('admin.dashboard.user.sorting')}}">
                                        @foreach($users as $key => $user)
                                            <tr data-code="{{$user->id}}">
                                                <td class="text-light"><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox text-light">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$user->id}}"></label>
                                                </td>
                                                <td class="table-user text-light">
                                                    @if ($user->path_image)
                                                        <img src="{{ asset('storage/'.$user->path_image) }}" alt="table-user" class="me-2 rounded-circle" style="width: 25px;">
                                                        @else      
                                                        <img src="{{asset('build/admin/images/users/user-3.jpg')}}" alt="table-user" class="me-2 rounded-circle" style="width: 25px;">
                                                    @endif
                                                    <a href="javascript:void(0);" class="text-body fw-semibold">{{$user->name}}</a>
                                                </td>
                                                <td class="text-light">
                                                   {{$user->email}}
                                                </td>
                                                <td class="text-light">
                                                        @if ($user && $user->created_at)
                                                            {{$user->created_at->format('d/m/Y H:i:s')}}
                                                            @else
                                                            -
                                                        @endif
                                                </td>
                                                <td class="text-light">
                                                    @switch($user->active)
                                                        @case(0) <span class="badge bg-soft text-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-soft-success text-success">Ativo</span>@break
                                                    @endswitch                                                    
                                                </td>
            
                                                <td class="d-flex gap-lg-1 justify-center text-light">
                                                    @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('grupo.visualizar'))
                                                        <button class="table-edit-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-group-edit-{{$user->id}}"><span class="mdi mdi-account-group-outline"></span></button>
                                                        <div class="modal fade" id="modal-group-edit-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light">
                                                                        <h4 class="modal-title" id="myCenterModalLabel">Grupos de permissões</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                    </div>
                                                                    <div class="modal-body p-4">
                                                                        <form action="{{ route('admin.dashboard.user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            @include('admin.blades.user.modal-group')                                                                                                                                                                                               
                                                                        </form>                                                                    
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                    @endif

                                                    @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['usuario.visualizar', 'usuario.editar'])) 
                                                        <button data-bs-toggle="modal" data-bs-target="#user-edit-{{$user->id}}" class="tabledit-edit-button btn btn-success"><span class="mdi mdi-pencil"></span></button>
                                                        <div class="modal fade" id="user-edit-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light">
                                                                        <h4 class="modal-title" id="myCenterModalLabel">Editar</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                    </div>
                                                                    <div class="modal-body p-4">
                                                                        <form action="{{ route('admin.dashboard.user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            @include('admin.blades.user.form')   
                                                                            <div class="d-flex justify-content-end gap-2">
                                                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
                                                                                <button type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                                                                            </div>                                                                                                                      
                                                                        </form>                                                                    
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                    @endif
                                                    @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['usuario.visualizar', 'usuario.remover']))
                                                        <form action="{{route('admin.dashboard.user.destroy',['user' => $user->id])}}" method="POST">
                                                            @method('DELETE') @csrf        
                                                            
                                                            <button type="button" class="demo-delete-row btn btn-danger btn-xs btn-icon btSubmitDeleteItem"><i class="mdi mdi-close"></i></button>
                                                        </form>                                                    
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>
@endsection
