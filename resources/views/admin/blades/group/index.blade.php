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
                                <li class="me-3"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="active">Grupos</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Grupos</h4>
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
                                        @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['grupo.visualizar','grupo.remover']))
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.group.destroySelected')}}" type="button" class="btSubmitDelete btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        @endif
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['grupo.visualizar', 'grupo.criar']))                                                        
                                            <button type="button" class="geex-btn geex-btn--primary" data-bs-toggle="modal" data-bs-target="#group-create"><i class="mdi mdi-plus-circle me-1"></i> Adicionar </button>
                                        @endif
                                        <!-- Modal -->
                                        <div class="modal fade" id="group-create" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 760px">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h4 class="modal-title" id="myCenterModalLabel">Criar grupo </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="{{route('admin.dashboard.group.store')}}" method="POST">
                                                            @csrf
                                                            @include('admin.blades.group.form')                                                   
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
                            </div>
    
                            <div class="table-responsive">
                                <table class="table-sortable table table-centered table-nowrap table-striped" id="products-datatable">
                                    <thead>                                        
                                        <tr>
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" type="checkbox"></label>
                                            </th>
                                            <th>Nome</th>
                                            <th>Criado em</th>
                                            <th style="width: 85px;">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody data-route="">
                                        @foreach($roles as $key => $group)
                                            <tr data-code="{{$group->id}}">
                                                <td class="text-light bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$group->id}}"></label>
                                                </td>
                                                <td class="text-light">
                                                   {{$group->name}}
                                                </td>
                                                <td class="text-light">
                                                    @if ($group && $group->created_at)
                                                        {{$group->created_at->format('d/m/Y H:i:s')}}
                                                        @else
                                                        -
                                                    @endif
                                                </td>
                                                
                                                <td class="d-flex flex-row gap-2 text-light">
                                                    @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['grupo.visualizar', 'grupo.editar']))                                                        
                                                        <button data-bs-toggle="modal" data-bs-target="#group-edit-{{$group->id}}" class="btn btn-success"><span class="mdi mdi-pencil"></span></button>
                                                    @endif
                                                    <div class="modal fade" id="group-edit-{{$group->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 760px">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h4 class="modal-title" id="myCenterModalLabel">Editar grupo</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                </div>
                                                                <div class="modal-body p-4">
                                                                    <form action="{{ route('admin.dashboard.group.update', ['role' => $group->id]) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        @include('admin.blades.group.form')                                                                                                                         
                                                                    </form>
                                                                    
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['grupo.visualizar', 'grupo.remover']))                                                        
                                                        <form action="{{route('admin.dashboard.group.destroy',['role' => $group->id])}}" method="POST">
                                                            @method('DELETE') @csrf        
                                                            
                                                            <button type="button" class="btn btn-danger btn-icon btSubmitDeleteItem"><i class="mdi mdi-close"></i></button>
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
{{-- <script>
    const responseItemDelete = @json(__('dashboard.response_item_delete'));
</script> --}}
@endsection
