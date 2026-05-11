@extends('layouts.app')

@section('title', __('app.dashboard.inquiries.title'))

@section('content')
@php
$statusLabels = [
    'pending' => __('app.dashboard.inquiries.status_pending'),
    'replied' => __('app.dashboard.inquiries.status_replied'),
    'closed' => __('app.dashboard.inquiries.status_closed'),
];
@endphp
<section class="page-hero">
    <div class="container">
        <p class="eyebrow">{{ __('app.dashboard.inquiries.eyebrow') }}</p>
        <h1>{{ __('app.dashboard.inquiries.heading') }}</h1>
        <p class="lead">{{ __('app.dashboard.inquiries.lead') }}</p>
        <div class="actions">
            <a class="btn btn-ghost" href="{{ route('dashboard.projects.index') }}">{{ __('app.dashboard.inquiries.back_projects') }}</a>
        </div>
        @if (session('status'))
            <div class="status-banner">{{ session('status') }}</div>
        @endif
        @if ($inquiries instanceof \Illuminate\Support\Collection && $inquiries->isEmpty())
            <div class="placeholder-card">{{ __('app.dashboard.inquiries.empty') }}</div>
        @elseif ($inquiries->count() === 0)
            <div class="placeholder-card">{{ __('app.dashboard.inquiries.empty') }}</div>
        @else
            <div class="card-grid">
                @foreach ($inquiries as $inquiry)
                    <article class="card">
                        <div class="card-top">
                            <span class="chip">{{ $inquiry->project?->title ?? __('app.projects.index.project_fallback') }}</span>
                            <span class="card-meta">{{ $statusLabels[$inquiry->status] ?? $inquiry->status }}</span>
                        </div>
                        <h3>{{ $inquiry->visitor_name }}</h3>
                        <p>{{ $inquiry->visitor_email }}</p>
                        <p>{{ $inquiry->message }}</p>
                        <form class="form-row" method="post" action="{{ route('dashboard.inquiries.update', $inquiry) }}">
                            @csrf
                            @method('patch')
                            <select name="status">
                                <option value="pending" @selected($inquiry->status === 'pending')>{{ __('app.dashboard.inquiries.status_pending') }}</option>
                                <option value="replied" @selected($inquiry->status === 'replied')>{{ __('app.dashboard.inquiries.status_replied') }}</option>
                                <option value="closed" @selected($inquiry->status === 'closed')>{{ __('app.dashboard.inquiries.status_closed') }}</option>
                            </select>
                            <button class="btn btn-ghost" type="submit">{{ __('app.dashboard.inquiries.update') }}</button>
                        </form>
                    </article>
                @endforeach
            </div>
            @if (method_exists($inquiries, 'links'))
                <div class="pagination">{{ $inquiries->links('partials.pagination') }}</div>
            @endif
        @endif
    </div>
</section>
@endsection
