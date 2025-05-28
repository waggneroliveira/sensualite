@php
    use App\Enums\ModelTypeAudit;
    use App\Models\AuditActivity;
@endphp
@extends('admin.core.admin')
@section('content')
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
                                    <li class="me-3"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="me-3"><a href="{{route('admin.dashboard.audit.index')}}">Auditoria</a>
                                    </li>
                                    <li class="active">Evento de Auditoria</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Evento de Auditoria</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="mt-5">
                    <div class="mb-2 col-lg-6">
                        <div>
                            <h5>Usuário manipulador</h5>
                        </div>
                        @if($activitie->causer)
                            <!-- Verifica se há um usuário associado (causer) -->
                            <td>{{ $activitie->causer->name }}</td>
                        @else
                            <td>Sistema</td>
                        @endif
                    </div>
                    <div class="mb-2 col-lg-6">
                        <div>
                            <h5>Recurso Manipulado</h5>
                        </div>
                        {{$modelName = AuditActivity::getModelName($activitie->subject_type)}}
                    </div>
                    <div class="mb-2">
                        <div>
                            <h5>Ação realizada</h5>
                        </div>
                        @switch($activitie->description)
                            @case('created') <span>Criação</span> @break
                            @case('login') <span>Login</span> @break
                            @case('logout') <span>Logout</span> @break
                            @case('updated') <span>Atualização</span> @break
                            @case('deleted') <span>Deleção</span> @break
                            @case('order_updated') <span>Mudança na ordenação do item</span> @break
                            @case('multiple_deleted') <span>Deleção multipla de itens</span> @break
                            @case('test_conection_smtp') <span>Teste de conexão SMTP</span> @break
                        @endswitch
                    </div>
                    <div class="mb-2">
                        <div>
                            <h5>Data do evento</h5>
                        </div>
                        
                        @switch($activitie->description)
                            @case('created')
                                <span>{{$activitie->created_at}}</span>
                            @break
                            @case('login')
                                <span>{{$activitie->created_at}}</span>
                            @break
                            @case('logout')
                                <span>{{$activitie->created_at}}</span>
                            @break
                            @case('updated')
                                <span>{{$activitie->created_at}}</span>
                            @break
                            @case('deleted')
                                <span>{{$activitie->created_at}}</span>
                            @break
                            @case('order_updated')
                                <span>{{$activitie->created_at}}</span>
                            @break
                            @case('multiple_deleted')
                                <span>{{$activitie->created_at}}</span>
                            @break
                            @case('test_conection_smtp')
                                <span>{{$activitie->created_at}}</span>
                            @break
                        @endswitch
                    </div>
                    <div class="mb-2">
                        <div>
                            <h5>Valores antigos</h5>
                        </div>
                        <code>
                            {{ print_r($activitie->properties['old'] ?? [], true) }}
                        </code>
                    </div>
                    <div class="mb-2">
                        <div>
                            <h5>Valores novos</h5>
                        </div>
                        <code>
                            {{ print_r($activitie->properties['attributes'] ?? [], true) }}
                        </code>
                    </div>
                </div> <!-- end card-body-->

            </div> <!-- container -->
        </div> <!-- content -->
    </div>
@endsection
