@extends('admin.core.companion')
@section('content')
@php
    $imagePath = Auth::guard('acompanhante')->user()->path_file_profile;
    if ($imagePath != null) {
        $imagePath = asset('storage/'.$imagePath);
    }else{
        $imagePath = 'build/admin/images/userblock.png';
    }
@endphp

@include('admin.includes.header', [
    'titlePage' => 'Perfil',
    'userName' => collect(explode(' ', Auth::guard('acompanhante')->user()->name))->slice(0, 2)->implode(' '),
    'userEmail' => Auth::guard('acompanhante')->user()->email,
    'messages' => '',
    'messageCount' => '3',
    'notifications' => '',
    'notificationsCount' => '4',
    'messages' => '',
    'logout' => route('admin.dashboard.companion.logout'),
    'src' => $imagePath,
    'link' => route('admin.dashboard.companion.profile.index'),
])

<style>
    .btn-group.focus-btn-group{
        display: none;
    }
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12 d-flex justify-between">
                                    <div class="col-6">
                                        <button id="btSubmitDelete" data-route="{{route('admin.dashboard.feedback.destroySelected')}}" type="button" class="btSubmitDelete btn btn-danger" style="display: none;">Deletar selecionados</button>
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
                                            <th>Cliente</th>
                                            <th>Feedback</th>
                                            <th>Enviado em</th>
                                            <th style="width: 85px;">Ação</th>
                                        </tr>
                                    </thead>

                                    <tbody data-route="{{route('admin.dashboard.feedback.sorting')}}">
                                        @foreach($feedbacks as $key => $feedback)
                                            <tr data-code="{{$feedback->id}}">
                                                <td class="text-light"><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox text-light">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$feedback->id}}"></label>
                                                </td>
                                                <td class="text-light">
                                                    {{$feedback->surname}}
                                                </td>
                                                <td class="text-light">
                                                    {!!substr(strip_tags($feedback->message), 0, 80)!!}...
                                                </td>
                                                {{-- <td class="table-feedback text-light">
                                                    @if ($feedback->path_image)
                                                        <img src="{{ asset('storage/'.$feedback->path_image) }}" alt="table-feedback" class="me-2 rounded-circle" style="width: 25px;">
                                                        @else
                                                        <img src="{{Vite::asset('resources/assets/admin/images/feedbacks/feedback-3.jpg')}}" alt="table-feedback" class="me-2 rounded-circle" style="width: 25px;">
                                                    @endif
                                                    <a href="javascript:void(0);" class="text-body fw-semibold">{{$feedback->name}}</a>
                                                </td> --}}
                                                <td class="text-light">
                                                        @if ($feedback && $feedback->created_at)
                                                            {{$feedback->created_at->format('d/m/Y H:i:s')}}
                                                            @else
                                                            -
                                                        @endif
                                                </td>

                                                <td class="d-flex gap-lg-1 justify-center text-light">
                                                    <button data-bs-toggle="modal" data-bs-target="#feedback-edit-{{$feedback->id}}" class="tabledit-edit-button btn btn-success"><span class="mdi mdi-eye"></span></button>
                                                    <div class="modal fade" id="feedback-edit-{{$feedback->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h4 class="modal-title" id="myCenterModalLabel">Responder</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                </div>
                                                                <div class="modal-body p-4">
                                                                    <div class="message mb-3 " style="border: 1px solid #c3c3c3;border-width: 1px;border-radius: 20px;padding: 10px 15px">
                                                                        <h5 class="mb-1 text-dark">{{$feedback->surname}}</h5>
                                                                        <div class="mb-3">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($i <= $feedback->rating)
                                                                                    <!-- Estrela preenchida -->
                                                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#FFDB12"/>
                                                                                    </svg>
                                                                                @else
                                                                                    <!-- Estrela vazia -->
                                                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#9D9D9D"/>
                                                                                    </svg>
                                                                                @endif
                                                                            @endfor
                                                                        </div>
                                                                        <p class="mb-3">{!!$feedback->message!!}</p>
                                                                    </div>
                                                                    <form action="{{ route('admin.dashboard.feedback.update', ['feedback' => $feedback->id]) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        @include('admin.blades.feedback.form', ['textareaId' => 'textarea-edit-' . $feedback->id])
                                                                        <div class="d-flex justify-content-end gap-2">
                                                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light">Enviar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->

                                                    <form action="{{route('admin.dashboard.feedback.destroy',['feedback' => $feedback->id])}}" method="POST">
                                                        @method('DELETE') @csrf

                                                        <button type="button" class="demo-delete-row btn btn-danger btn-xs btn-icon btSubmitDeleteItem"><i class="mdi mdi-close"></i></button>
                                                    </form>
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
