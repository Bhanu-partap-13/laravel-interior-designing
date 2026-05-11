@extends('layouts.app')

@section('title', __('app.categories.show.title'))

@section('content')
<section class="page-hero">
    <div class="container">
        <p class="eyebrow">{{ __('app.categories.show.eyebrow') }}</p>
        <h1>{{ $category->name }}</h1>
        <p class="lead">{{ $category->description ?? __('app.categories.show.description_fallback') }}</p>
        @if ($projects->isEmpty())
            <div class="placeholder-card">{{ __('app.categories.show.empty') }}</div>
        @else
            <div class="card-grid">
                @foreach ($projects as $project)
                    <article class="card">
                        <div class="card-top">
                            <span class="chip">{{ $project->category?->name ?? __('app.projects.index.project_fallback') }}</span>
                            <span class="card-meta">{{ $project->designer?->city ?? __('app.projects.index.city_fallback') }}</span>
                        </div>
                        <img
                            class="card-image"
                            src="{{ $project->after_image ? asset('storage/' . $project->after_image) : 'https://source.unsplash.com/800x600/?interior,home&sig=' . $project->id }}"
                            alt="{{ $project->title }}"
                        >
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->description ?? __('app.projects.index.description_fallback') }}</p>
                        <div class="card-bottom">
                            <span>{{ __('app.projects.index.budget_prefix') }}: {{ $project->budget_range ?? __('app.projects.show.details_budget_fallback') }}</span>
                            <a class="text-link" href="{{ route('projects.show', $project->slug) }}">{{ __('app.projects.index.view_project') }}</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
