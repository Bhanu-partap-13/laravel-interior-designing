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
            <div class="dashboard-actions">
                <a class="btn btn-primary" href="{{ route('dashboard.projects.index') }}">{{ __('app.dashboard.index.manage_projects') }}</a>
                <a class="btn btn-ghost" href="{{ route('dashboard.projects.create') }}">{{ __('app.dashboard.projects.new_project') }}</a>
                <a class="btn btn-ghost" href="{{ route('dashboard.inquiries.index') }}">{{ __('app.dashboard.index.view_inquiries') }}</a>
            </div>
            <form method="post" action="{{ route('auth.logout') }}">
                @csrf
                <button class="btn btn-ghost" type="submit">{{ __('app.nav.logout') }}</button>
            </form>
        </div>

        <div class="dashboard-intro">
            @php
                $fullName = $designer?->user?->name ?? __('app.designers.show.title_fallback');
                $nameParts = explode(' ', $fullName, 2);
                $firstName = $nameParts[0] ?? $fullName;
                $lastName = $nameParts[1] ?? '';
            @endphp
            <h1 class="bold-heading">Welcome back, <span class="text-accent">{{ $firstName }}</span></h1>
            <p class="lead">{{ __('app.dashboard.index.lead') }}</p>
        </div>

        <div class="profile-panel-premium">
            <div class="profile-aside">
                <div class="profile-photo-large">
                    @if ($designer && $designer->profile_photo)
                        <img src="{{ asset('storage/' . $designer->profile_photo) }}" alt="{{ $fullName }}">
                    @else
                        <span>{{ strtoupper(substr($firstName, 0, 1)) }}</span>
                    @endif
                </div>
                <p class="profile-status-italic"><i>Currently active & available</i></p>
            </div>
            
            <div class="profile-details-main">
                <div class="details-grid">
                    <div class="detail-group">
                        <label>First Name</label>
                        <p>{{ $firstName }}</p>
                    </div>
                    <div class="detail-group">
                        <label>Last Name</label>
                        <p>{{ $lastName ?: '-' }}</p>
                    </div>
                    <div class="detail-group">
                        <label>Email Address</label>
                        <p>{{ $designer?->user?->email }}</p>
                    </div>
                    <div class="detail-group">
                        <label>Phone Number</label>
                        <p>{{ $designer?->phone ?? 'Not provided' }}</p>
                    </div>
                </div>
                
                <div class="profile-footer-actions">
                    <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-ghost">{{ __('app.dashboard.projects.edit_profile') }}</a>
                </div>
            </div>

            <div class="profile-stats-brief">
                <div class="brief-stat">
                    <span class="brief-label">{{ __('app.dashboard.index.published_title') }}</span>
                    <span class="brief-value">{{ $projects->where('is_published', true)->count() }}</span>
                </div>
                <div class="brief-stat">
                    <span class="brief-label">Total Views</span>
                    <span class="brief-value">1.2k</span>
                </div>
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
