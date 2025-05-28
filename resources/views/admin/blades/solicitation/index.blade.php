@extends('admin.core.admin')
@section('content')
<style>
    .btn-solicitation.focus-btn-solicitation{
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
    $canAprovar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('ensaio.aprovar');
    $canReprovar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('ensaio.reprovar');
    $canRemover = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('ensaio.remover foto ou video de ensaio');
    $canVisualizar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('ensaio.reprovar');
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
                                <li class="active">Solicitação de aprovação de galeria</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Solicitação de aprovação de galeria</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
    @if ($canVisualizar)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">    
                        <div class="table-responsive">
                            <table class="table-sortable table table-centered table-nowrap table-striped" id="products-datatable">
                                <thead>                                        
                                    <tr>
                                        <th class="bs-checkbox">
                                            <label><input name="btnSelectAll" type="checkbox"></label>
                                        </th>
                                        <th>Nome</th>
                                        <th>Solicitação enviada em</th>
                                        <th style="width: 85px;">Ação</th>
                                    </tr>
                                </thead>
                                <tbody data-route="">
                                    @foreach($solicitations as $solicitation)
                                        <tr data-code="{{$solicitation->id}}">
                                            <td class="text-light bs-checkbox">
                                                <label><input data-index="" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$solicitation->id}}"></label>
                                            </td>
                                            <td class="text-light">
                                            {{$solicitation->title}}
                                            </td>
                                            <td class="text-light">
                                                @if ($solicitation && $solicitation->requested_at)
                                                    {{$solicitation->requested_at}}
                                                    @else
                                                    -
                                                @endif
                                            </td>
                                            
                                            <td class="d-flex flex-row gap-2 text-light">
                                                <button data-bs-toggle="modal" data-bs-target="#solicitation-edit-{{$solicitation->id}}" class="btn btn-success"><span class="mdi mdi-pencil"></span></button>
                                                <div class="modal fade" id="solicitation-edit-{{$solicitation->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 760px">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="myCenterModalLabel">Solicitação de aprovação de galeria</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                @include('admin.blades.solicitation.form')  
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
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
    @endif
            <!-- end row -->
        </div>
    </div>
</div>
{{-- <script>
    const responseItemDelete = @json(__('dashboard.response_item_delete'));
</script> --}}
@endsection
