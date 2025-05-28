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
                                <li class="active">Noticações</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Noticações</h4>
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
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.notification.destroySelected')}}" type="button" class="btSubmitDelete btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['usuario.visualizar', 'usuario.criar']))
                                            <button type="button" class="geex-btn geex-btn--primary" data-bs-toggle="modal" data-bs-target="#notification-create"><i class="mdi mdi-plus-circle me-1"></i> Adicionar</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="notification-create" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light">
                                                            <h4 class="modal-title" id="myCenterModalLabel">Adicionar</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <form action="{{route('admin.dashboard.notification.store')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @include('admin.blades.notification.form', ['textareaId' => 'textarea-create'])  
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
                                            <th>Destino</th>
                                            <th>Assunto</th>
                                            <th>Menssagem</th>
                                            <th>Criado em</th>
                                            <th style="width: 85px;">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody data-route="{{route('admin.dashboard.notification.sorting')}}">
                                        @foreach($notifications as $key => $notification)
                                            <tr data-code="{{$notification->id}}">
                                                <td class="text-light"><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox text-light">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$notification->id}}"></label>
                                                </td>
                                                <td class="text-light">
                                                    @switch($notification->type)
                                                        @case('client')
                                                                Cliente
                                                            @break
                                                        @case('companion')
                                                                Acompanhnate
                                                            @break
                                                        @default
                                                        -
                                                            
                                                    @endswitch
                                                </td>
                                                <td class="text-light">
                                                   {{$notification->title}}
                                                </td>
                                                <td class="text-light">
                                                   {!! substr(strip_tags($notification->message), 0, 40)!!}...
                                                </td>
                                                <td class="text-light">
                                                        @if ($notification && $notification->created_at)
                                                            {{$notification->created_at->format('d/m/Y H:i:s')}}
                                                            @else
                                                            -
                                                        @endif
                                                </td>
            
                                                <td class="d-flex gap-lg-1 justify-center text-light">
                                                    @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['usuario.visualizar', 'usuario.editar'])) 
                                                        <button data-bs-toggle="modal" data-bs-target="#notification-edit-{{$notification->id}}" class="tabledit-edit-button btn btn-success"><span class="mdi mdi-pencil"></span></button>
                                                        <div class="modal fade" id="notification-edit-{{$notification->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light">
                                                                        <h4 class="modal-title" id="myCenterModalLabel">Editar</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                    </div>
                                                                    <div class="modal-body p-4">
                                                                        <form action="{{ route('admin.dashboard.notification.update', ['notification' => $notification->id]) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            @include('admin.blades.notification.form', ['textareaId' => 'textarea-edit-' . $notification->id])   
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
                                                        <form action="{{route('admin.dashboard.notification.destroy',['notification' => $notification->id])}}" method="POST">
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
