@extends('layouts.app')

@section('title', __('app.dashboard.index.title'))

@section('content')
<section class="page-hero">
    <div class="container">
        @if (session('status'))
            <div class="toast" role="status" data-toast>
                <span>{{ session('status') }}</span>
                <button class="toast-close" type="button" aria-label="Close" data-toast-close>&times;</button>
            </div>
        @endif
        <div class="dashboard-topbar">
            <form method="post" action="{{ route('auth.logout') }}">
                @csrf
                <button class="btn btn-ghost" type="submit">{{ __('app.nav.logout') }}</button>
            </form>
            <div class="dashboard-actions">
                <a class="btn btn-primary" href="{{ route('dashboard.projects.index') }}">{{ __('app.dashboard.index.manage_projects') }}</a>
                <a class="btn btn-ghost" href="{{ route('dashboard.inquiries.index') }}">{{ __('app.dashboard.index.view_inquiries') }}</a>
            </div>
        </div>
        <div class="profile-panel">
            <div class="profile-photo">
                @if ($designer && $designer->profile_photo)
                    <img src="{{ asset('storage/' . $designer->profile_photo) }}" alt="{{ $designer->user?->name ?? __('app.designers.show.title_fallback') }}">
                @else
                    <span>{{ strtoupper(substr($designer?->user?->name ?? 'D', 0, 1)) }}</span>
                @endif
            </div>
            <div class="profile-info">
                <p class="eyebrow">{{ __('app.dashboard.index.eyebrow') }}</p>
                <h2>{{ $designer?->user?->name ?? __('app.designers.show.title_fallback') }}</h2>
                <p class="profile-role">
                    {{ $designer?->specialization ?? __('app.designers.show.specialty_fallback') }}
                </p>
                <p class="lead">
                    {{ $designer?->bio ?? __('app.designers.show.bio_fallback') }}
                </p>
            </div>
            <div class="profile-meta">
                <p><strong>{{ __('app.dashboard.profile.city') }}:</strong> {{ $designer?->city ?? __('app.designers.index.city_fallback') }}</p>
                <p><strong>{{ __('app.dashboard.profile.education') }}:</strong> {{ $designer?->education ?? __('app.dashboard.profile.complete_required') }}</p>
                <p><strong>{{ __('app.dashboard.profile.certifications') }}:</strong> {{ $designer?->certifications ?? __('app.dashboard.profile.complete_required') }}</p>
                <p><strong>{{ __('app.dashboard.profile.phone') }}:</strong> {{ $designer?->phone ?? __('app.dashboard.profile.phone_placeholder') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="section dashboard-projects">
    <div class="container">
        <div class="section-head">
            <div>
                <p class="eyebrow">Projects</p>
                <h2>Recent work</h2>
            </div>
            <a class="btn btn-ghost" href="{{ route('dashboard.projects.index') }}">Show more</a>
        </div>
        @if ($projects->isEmpty())
            <div class="placeholder-card">{{ __('app.dashboard.projects.empty_first') }}</div>
        @else
            <div class="project-list">
                @foreach ($projects as $project)
                    <article class="project-item">
                        <div class="project-thumb">
                            <img
                                src="{{ $project->after_image ? asset('storage/' . $project->after_image) : 'https://source.unsplash.com/600x400/?interior,design&sig=' . $project->id }}"
                                alt="{{ $project->title }}"
                            >
                        </div>
                        <div class="project-body">
                            <div class="card-top">
                                <span class="chip">{{ $project->category?->name ?? __('app.dashboard.projects.category_fallback') }}</span>
                                <span class="card-meta">
                                    {{ $project->is_published ? __('app.dashboard.projects.published') : __('app.dashboard.projects.draft') }}
                                </span>
                            </div>
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->description ?? __('app.dashboard.projects.description_fallback') }}</p>
                            <div class="project-meta">
                                <span>{{ __('app.dashboard.projects.budget_label') }}: {{ $project->budget_range ?? __('app.projects.show.details_budget_fallback') }}</span>
                                <a class="text-link" href="{{ route('dashboard.projects.edit', $project) }}">Show more</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
