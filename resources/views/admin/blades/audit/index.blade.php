@php
    // use App\Enums\ModelTypeAudit;
    use App\Models\AuditActivity;
@endphp
@extends('admin.core.admin')
@section('content')
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
                                    <li class="me-3"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="active">Auditoria</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Auditoria</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="mt-4">
                                <table class="table-sortable table table-centered table-nowrap table-striped">
                                    <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Ação realizada</th>
                                        <th>Data do evento</th>
                                        <th>Recurso manipulado</th>
                                        <th>Usuário manipulador</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($activities as $key => $activitie)
                                        @if ($activitie->description !== 'logout-client' && $activitie->description !== 'login-client' && $activitie->description !== 'login-companion' && $activitie->description !== 'logout-companion')
                                            <tr>
                                                <td class="text-light"></td>
                                                <td class="text-light">                                                    
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
                                                </td>
                                                <td class="text-light">
                                                    @switch($activitie->description)
                                                        @case('created')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                        @case('login')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                        @case('logout')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                        @case('updated')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                        @case('deleted')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                        @case('order_updated')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                        @case('multiple_deleted')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                        @case('test_conection_smtp')
                                                            {{$activitie->created_at->format('d/m/Y H:i:s')}}
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td class="text-light">
                                                    {{$modelName = AuditActivity::getModelName($activitie->subject_type)}}
                                                </td>
                                                @if($activitie->causer)
                                                    <!-- Verifica se há um usuário associado (causer) -->
                                                    <td class="text-light">{{ $activitie->causer->name }}</td>
                                                @else
                                                    <td class="text-light">Sistema</td>
                                                @endif
                                                @if(Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('auditoria.visualizar'))
                                                    <td class="text-light">
                                                        <a href="{{route('admin.dashboard.audit.show',['activitie' => $activitie->id])}}"
                                                        class="btn-icon mdi mdi-eye-outline"></a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                                {{-- PAGINATION --}}
                                {{-- <div class="mt-3 float-end">
                                    {{$activities->links()}}
                                </div> --}}
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
@endsection
