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

        $canCriar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('assinatura.criar');
        $canEditar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('assinatura.editar');
        $canRemover = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('assinatura.remover');
        $canVisualizar = Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('assinatura.visualizar');
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
    <div class="row justify-content-end mb-3">
        <div class="col-lg-3">
            @if($canCriar)
            <button type="button" class="geex-btn geex-btn--primary w-auto" data-bs-toggle="modal" data-bs-target="#plan-create"><i class="mdi mdi-plus-circle me-1"></i> Cadastrar Novo Plano </button>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="plan-create" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h4 class="modal-title" id="myCenterModalLabel">Adicionar</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form action="{{route('admin.dashboard.plan.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @include('admin.blades.plan.form-admin', ['textareaId' => 'textarea-create'])
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
    @if ($canVisualizar)
        <div class="geex-content__pricing">
            <div class="geex-content__pricing__wrapper">
                <div class="row">
                    @foreach ($plans as $plan)
                        <div class="col-lg-4 mb-40">
                            <div class="geex-content__pricing__single">
                                <div class="geex-content__pricing__header">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="geex-content__pricing__badge">{{$plan->name}}</span>
                                        <div class="geex-content__todo__sidebar__text w-100 px-2">
                                            <a href="#" class="geex-content__chat__header__filter__btn d-flex ms-auto m-1" style="justify-content: center;align-items: center;background-color: #17161eba;width: 40px;height: 40px;border-radius: 100%;">
                                                <i class="uil-ellipsis-h"></i>
                                            </a>
                                            <div class="geex-content__chat__header__filter__content" style="max-width: 200px;">
                                                <ul class="geex-content__chat__header__filter__content__list">
                                                    @if($canEditar)
                                                    <li class="geex-content__chat__header__filter__content__list__item">
                                                        <button data-bs-toggle="modal" style="outline: none; box-shadow: none;" data-bs-target="#plan-edit-{{$plan->id}}" class="btn p-0 text-white">Editar</button>
                                                    </li>
                                                    @endif
                                                    @if($canRemover)
                                                    <li class="geex-content__chat__header__filter__content__list__item">
                                                        <form action="{{route('admin.dashboard.plan.destroy',['plan' => $plan->id])}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" style="outline: none; box-shadow: none;" class="text-white btn p-0 bg-transparent btSubmitDeleteItem geex-content__chat__header__filter__content__list__link">Deletar</button>
                                                        </form>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="plan-edit-{{$plan->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h4 class="modal-title" id="myCenterModalLabel">Editar</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form action="{{ route('admin.dashboard.plan.update', ['plan' => $plan->id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        @include('admin.blades.plan.form-admin', ['textareaId' => 'textarea-edit-' . $plan->id])
                                                        <div class="d-flex justify-content-end gap-2">
                                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <div class="geex-content__pricing__tag">
                                        <span class="geex-content__pricing__currency">R$</span>
                                        <span class="geex-content__pricing__amount">{{$plan->price}}</span>
                                        <span class="geex-content__pricing__period">por semana</span>
                                    </div>
                                    <span class="geex-content__pricing__subtitle">{{$plan->description}}</span>
                                </div>
                                <div class="geex-content__pricing__body">
                                    {!! $plan->features !!}
                                    {{-- <span class="geex-content__pricing__profit">R$999,00 anualmente. Economize R$189,00.</span> --}}
                                </div>
                            </div>
                        </div>
                        <style>
                            .geex-content__pricing__body ul{
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-orient: vertical;
                                -webkit-box-direction: normal;
                                -ms-flex-direction: column;
                                flex-direction: column;
                                gap: 8px;
                                padding: 28px 0;
                            }

                            .geex-content__pricing__body ul li{
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                gap: 10px;
                                -webkit-box-align: start;
                                -ms-flex-align: start;
                                align-items: flex-start;
                                font-size: 16px;
                                line-height: 32px;
                                color: var(--body-color);
                            }

                            html[data-theme="dark"] .geex-content__pricing__body ul li{
                                color: var(--sec-color);
                            }

                            .geex-content__pricing__body ul li::before {
                                font-family: 'unicons-line';
                                content: '\e9c3';
                                margin-right: 8px;
                                font-weight: normal;
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-align: center;
                                -ms-flex-align: center;
                                align-items: center;
                                -webkit-box-pack: center;
                                -ms-flex-pack: center;
                                justify-content: center;
                                min-width: 20px;
                                height: 20px;
                                font-size: 24px;
                                position: relative;
                                top: 7px;
                                color: var(--primary-color);
                            }
                        </style>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
