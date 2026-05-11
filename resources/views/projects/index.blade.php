@extends('layouts.app')

@section('title', __('app.projects.index.eyebrow'))

@section('content')
<section class="page-hero">
    <div class="container">
        <p class="eyebrow">{{ __('app.projects.index.eyebrow') }}</p>
        <h1>{{ __('app.projects.index.title') }}</h1>
        <p class="lead">{{ __('app.projects.index.lead') }}</p>
        <form class="filter-row" method="get" action="{{ route('projects.index') }}">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" class="chip" name="city" value="{{ request('city') }}" placeholder="{{ __('app.projects.index.filter_city') }}">
            <input type="text" class="chip" name="style" value="{{ request('style') }}" placeholder="{{ __('app.projects.index.filter_style') }}">
            <select class="chip" name="budget">
                <option value="">{{ __('app.projects.index.budget_all') }}</option>
                <option value="Low" @selected(request('budget') === 'Low')>{{ __('app.projects.index.budget_low') }}</option>
                <option value="Mid" @selected(request('budget') === 'Mid')>{{ __('app.projects.index.budget_mid') }}</option>
                <option value="High" @selected(request('budget') === 'High')>{{ __('app.projects.index.budget_high') }}</option>
            </select>
            <button class="btn btn-ghost" type="submit">{{ __('app.actions.filter') }}</button>
            <a class="btn btn-ghost" href="{{ route('projects.index') }}">{{ __('app.actions.clear') }}</a>
        </form>
        <div class="filter-row">
            <a class="chip" href="{{ route('projects.index', request()->except('page', 'category')) }}">{{ __('app.projects.index.category_all') }}</a>
            @foreach ($categories as $category)
                <a class="chip" href="{{ route('projects.index', array_merge(request()->except('page', 'category'), ['category' => $category->slug])) }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
        @if ($projects->count() === 0)
            <div class="placeholder-card">{{ __('app.projects.index.empty') }}</div>
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
                            src="{{ $project->after_image ? asset('storage/' . $project->after_image) : 'https://source.unsplash.com/800x600/?interior,design&sig=' . $project->id }}"
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
            @if (method_exists($projects, 'links'))
                <div class="pagination">{{ $projects->links('partials.pagination') }}</div>
            @endif
        @endif
    </div>
</section>
@endsection
