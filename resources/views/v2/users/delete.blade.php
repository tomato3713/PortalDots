@extends('v2.layouts.app')

@section('title', __('ユーザー設定'))

{{-- TODO: 完全にLaravel化したら、以下のdrawerセクションは完全削除する --}}
@section('drawer')
<a class="drawer-header" href="{{ url('/') }}" data-turbolinks="false">
    {{ config('app.name') }}
</a>
<nav class="drawer-nav">
    <ul class="drawer-nav__list">
        <li class="drawer-nav__item">
            <a href="{{ url('/') }}" class="drawer-nav__link" data-turbolinks="false">
                {{ __('ホームに戻る') }}
            </a>
        </li>
    </ul>
</nav>
@endsection

@section('bottom_tabs')
{{-- TODO: 完全にLaravel化したら、このセクションは完全削除する --}}
@endsection

@section('content')
@include('v2.includes.user_settings_tab_strip')
<header class="header">
    <app-container>
        <h1 class="header__title">
            {{ __('アカウント削除') }}
        </h1>
    </app-container>
</header>
<app-container>
    @if ($belong)
        <p class="card-text">{{ __('団体に所属しているため、アカウント削除はできません') }}</p>
        <p class="card-text">{{ __('詳細については :admin_name までお問い合わせください', ['admin_name' => config('portal.admin_name')]) }}</p>
        <p>
            {{-- リンク先が Turbolinks に対応したら data-turbolinks="false" は削除する --}}
            <a href="{{ url('/') }}" class="btn is-primary is-block" data-turbolinks="false">
                {{ __('ホームに戻る') }}
            </a>
        </p>
    @else
        <p class="card-text">
            {{ __('アカウントを削除した場合、申請の手続きなどができなくなります。') }}
        </p>
        <form-with-confirm
            action="{{ route('user.destroy') }}"
            method="post"
            confirm-message="{{ __('本当にアカウントを削除しますか？') }}"
        >
            @method('delete')
            @csrf
            <button type="submit" class="btn is-danger is-block">
                <strong>{{ __('アカウント削除') }}</strong>
            </button>
        </form-with-confirm>
    @endif
</app-container>
@endsection
