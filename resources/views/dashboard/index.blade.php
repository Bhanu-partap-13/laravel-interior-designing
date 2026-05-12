@extends('layouts.app')

@section('title', __('app.dashboard.index.title'))

@section('content')
<section class="page-hero">
    <div class="container">
        <p class="eyebrow">{{ __('app.dashboard.index.eyebrow') }}</p>
        <h1>{{ __('app.dashboard.index.heading') }}</h1>
        <p class="lead">{{ __('app.dashboard.index.lead') }}</p>
        @if (session('status'))
            <div class="status-banner">{{ session('status') }}</div>
        @endif
        <div class="actions">
            <a class="btn btn-primary" href="{{ route('dashboard.projects.index') }}">{{ __('app.dashboard.index.manage_projects') }}</a>
            <a class="btn btn-ghost" href="{{ route('dashboard.inquiries.index') }}">{{ __('app.dashboard.index.view_inquiries') }}</a>
            <form method="post" action="{{ route('auth.logout') }}">
                @csrf
                <button class="btn btn-ghost" type="submit">{{ __('app.nav.logout') }}</button>
            </form>
        </div>
        <div class="card-grid">
            <div class="card">
                <h3>{{ __('app.dashboard.index.published_title') }}</h3>
                <p class="stat-value">{{ $metrics['published'] }}</p>
                <p class="card-meta">{{ __('app.dashboard.index.drafts_ready', ['count' => $metrics['drafts']]) }}</p>
            </div>
            <div class="card">
                <h3>{{ __('app.dashboard.index.inquiries_title') }}</h3>
                <p class="stat-value">{{ $metrics['inquiries'] }}</p>
                <p class="card-meta">{{ __('app.dashboard.index.inquiries_total') }}</p>
            </div>
            <div class="card">
                <h3>{{ __('app.dashboard.index.profile_title') }}</h3>
                <p class="stat-value">{{ $metrics['profile'] }}%</p>
                <p class="card-meta">{{ __('app.dashboard.index.profile_hint') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
