@extends('v2.layouts.app')

@section('title', $schedule->name)

@section('navbar')
<a href="{{ route('schedules.index') }}" class="navbar-back">
    <i class="fas fa-chevron-left navbar-back__icon"></i>
    {{ __('スケジュール') }}
</a>
@endsection

@section('content')
<header class="header">
    <app-container>
        <h1 class="header__title">
            {{ $schedule->name }}
        </h1>
        <p class="header__date">
            @datetime($schedule->start_at)〜 • {{ $schedule->place }}
        </p>
    </app-container>
</header>
<app-container component-is="main" class="pb-spacing-lg">
    <div class="markdown">
        @markdown($schedule->description)
    </div>
</app-container>
@if (count($schedule->documents) > 0)
<app-container>
    <list-view header-title="{{ __('配布資料') }}">
        @foreach ($schedule->documents as $document)
        <list-view-item
            href="{{ url("uploads/documents/{$document->id}") }}"
            newtab
        >
            <template v-slot:title>
                @if ($document->is_important)
                <i class="fas fa-exclamation-circle fa-fw text-danger"></i>
                @else
                <i class="far fa-file-alt fa-fw"></i>
                @endif
                {{ $document->name }}
            </template>
            <template v-slot:meta>
                {{ __('更新 :') }}
                @datetime($document->updated_at)
                @isset($document->schedule)
                •
                {{ __(':schedule_name で配布', ['schedule_name' => $document->schedule->name]) }}
                @endisset
            </template>
            @summary($document->description)
        </list-view-item>
        @endforeach
    </list-view>
</app-container>
@endif
@endsection
