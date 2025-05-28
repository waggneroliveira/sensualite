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
    $canEditar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('pagarme.editar');
    $canVisualizar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('pagarme.visualizar');
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
@if($canVisualizar)
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
                                <li class="active">Credenciais Pagarme</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Credenciais Pagarme</h4>
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
                                    <div class="col-12 d-flex justify-content-end">
                                        @if (Auth::user()->hasRole('Super'))
                                            @if (!$credentialPagarme)                                                
                                                <button type="button" class="geex-btn geex-btn--primary" data-bs-toggle="modal" data-bs-target="#configPayment-create"><i class="mdi mdi-plus-circle me-1"></i> Adicionar</button>
                                            @endif
                                            <!-- Modal -->
                                            <div class="modal fade configPayment-create-modal" id="configPayment-create" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light">
                                                            <h4 class="modal-title" id="myCenterModalLabel">Adicionar</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <form action="{{route('admin.dashboard.configPayment.store')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @include('admin.blades.configPayment.form')  
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
                                            <th>Link de pagamento</th>
                                            <th>Link de status</th>
                                            <th style="width: 85px;">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($credentialPagarme)                                            
                                            <tr data-code="{{$credentialPagarme->id}}">
                                                <td class="text-light"><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox text-light">
                                                    <label><input data-index="" name="btnSelectItem" class="btnSelectItem" type="checkbox" value=""></label>
                                                </td>
                                                <td class="text-light">
                                                {{$credentialPagarme->api_url_payment_link}}
                                                </td>
                                                <td class="text-light">
                                                    R$ {{$credentialPagarme->api_url_get_payment_status}}
                                                </td>

                                                <td class="d-flex gap-lg-1 justify-center text-light">
                                                    @if ($canEditar)
                                                        <button data-bs-toggle="modal" data-bs-target="#configPayment-edit-{{$credentialPagarme->id}}" class="tabledit-edit-button btn btn-success"><span class="mdi mdi-pencil"></span></button>
                                                        <div class="modal fade" id="configPayment-edit-{{$credentialPagarme->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light">
                                                                        <h4 class="modal-title" id="myCenterModalLabel">Editar</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                    </div>
                                                                    <div class="modal-body p-4">
                                                                        <form action="{{ route('admin.dashboard.configPayment.update', ['credentialPagarme' => $credentialPagarme->id]) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            @include('admin.blades.configPayment.form')   
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
                                                </td>
                                            </tr>
                                        @endif
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
@endif
@endsection
