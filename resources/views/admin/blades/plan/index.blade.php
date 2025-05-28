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
    'titlePage' => 'Ensaios',
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
<div class="geex-content__pricing">
    <div class="geex-content__pricing__wrapper">
        <div class="row">
            @foreach ($plans as $plan)
                @php
                    $userId = Auth::guard('acompanhante')->user()->id;
                    $subscribeds = $plan->subscribeds ?? collect();

                    $activeSubscription = false;
                    $expireSubscription = false;
                    foreach ($subscribeds as $subscription) {
                        if ($subscription->companion_id == $userId && $subscription->status == 'paid') {
                            $activeSubscription = true;
                            break;
                        }
                        if ($subscription->companion_id == $userId && $subscription->status == 'expired') {
                            $expireSubscription = true;
                            break;
                        }
                    }
                @endphp

                <div class="col-lg-4 mb-40">
                    <form action="{{ route('payment.checkout') }}" method="post">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                        <div class="geex-content__pricing__single {{ $activeSubscription ? 'active' : '' }} {{ $expireSubscription ? 'active' : ''}}">
                            <div class="geex-content__pricing__header">
                                <span class="geex-content__pricing__badge">{{$plan->name}}</span>
                                <div class="geex-content__pricing__tag">
                                    <span class="geex-content__pricing__currency">R$</span>
                                    <span class="geex-content__pricing__amount">{{$plan->price}}</span>
                                    <span class="geex-content__pricing__period">por semana</span>
                                </div>
                                <span class="geex-content__pricing__subtitle">{{$plan->description}}</span>
                            </div>
                            <div class="geex-content__pricing__body">
                                <div class="geex-content__pricing__feature__list active">
                                    {!! $plan->features !!}
                                </div>
                                <div class="geex-content__pricing__btn-part">
                                    @if ($activeSubscription)
                                        <button type="button" disabled class="geex-content__pricing__btn">Assinatura atual</button>
                                    @elseif($expireSubscription)
                                        <button type="submit" class="geex-content__pricing__btn">Renovar assinatura</button>
                                    @else
                                        <button type="submit" class="geex-content__pricing__btn">Contratar nova assinatura</button>
                                    @endif
                                </div>
                                <span class="geex-content__pricing__profit">{{$plan->cancellation_policy}}</span>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach

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
@endsection
