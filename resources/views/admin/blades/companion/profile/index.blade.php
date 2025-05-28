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
    <div class="geex-content__section geex-content__form">
        <form action="{{route('admin.dashboard.companion.profile.update', ['companion' => $companion->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('admin.blades.companion.profile.form', ['textareaId' => 'textarea-edit-' . $companion->id])

            <div class="d-flex justify-content-end gap-3">
                <a href="" class="geex-btn">Cancelar</a>
                {{-- <button class="geex-btn">Cancelar</button> --}}
                <button type="submit" class="geex-btn geex-btn--primary">Salvar</button>
            </div>
        </form>
    </div>

@endsection
