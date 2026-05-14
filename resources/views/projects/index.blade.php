@extends('layouts.app')

@section('title', __('app.projects.index.eyebrow'))

@section('content')
<section class="page-hero">
    <div class="container">
        <p class="eyebrow">{{ __('app.projects.index.eyebrow') }}</p>
        <h1>{{ __('app.projects.index.title') }}</h1>
        <p class="lead">{{ __('app.projects.index.lead') }}</p>
        @php
            $designer = auth()->user()?->designer;
        @endphp
        @if ($designer)
            <div class="projects-actions">
                <button class="btn btn-emphasis" type="button" data-modal-open="project-modal">
                    Create project
                </button>
            </div>
        @endif
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
@if ($designer)
    <div class="modal" id="project-modal" aria-hidden="true">
        <div class="modal-backdrop" data-modal-close></div>
        <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="project-modal-title">
            <div class="modal-head">
                <div>
                    <p class="eyebrow">New project</p>
                    <h2 id="project-modal-title">Create a draft</h2>
                    <p class="lead">Finish the last step to save a draft to your dashboard.</p>
                </div>
                <button class="modal-close" type="button" aria-label="Close" data-modal-close>&times;</button>
            </div>
            <form class="modal-form" method="post" action="{{ route('dashboard.projects.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="is_published" value="0">
                <input type="hidden" name="redirect_to" value="dashboard.index">
                <div class="modal-steps">
                    <div class="modal-step is-active" data-step="1">
                        <label class="field">
                            <span>Title</span>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Project title" required>
                        </label>
                        <label class="field">
                            <span>Category</span>
                            <select name="category_id" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="field">
                            <span>Description</span>
                            <textarea name="description" placeholder="Describe the project.">{{ old('description') }}</textarea>
                        </label>
                    </div>
                    <div class="modal-step" data-step="2">
                        <label class="field">
                            <span>Company name</span>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Company name for this project">
                        </label>
                        <label class="field">
                            <span>Budget range</span>
                            <input type="text" name="budget_range" value="{{ old('budget_range') }}" placeholder="Low, Mid, High">
                        </label>
                        <label class="field">
                            <span>Duration (days)</span>
                            <input type="number" name="duration_days" value="{{ old('duration_days') }}" min="1" placeholder="45">
                        </label>
                        <label class="field">
                            <span>Style tags</span>
                            <input type="text" name="style_tags" value="{{ old('style_tags') }}" placeholder="minimal, warm, coastal">
                        </label>
                    </div>
                    <div class="modal-step" data-step="3">
                        <label class="field">
                            <span>Payment status</span>
                            <select name="payment_status">
                                <option value="" disabled selected>Select payment status</option>
                                <option value="paid" @selected(old('payment_status') === 'paid')>Paid</option>
                                <option value="free" @selected(old('payment_status') === 'free')>Free</option>
                            </select>
                        </label>
                        <label class="field">
                            <span>Amount paid</span>
                            <input type="number" name="amount_paid" value="{{ old('amount_paid') }}" min="0" step="0.01" placeholder="0.00">
                        </label>
                    </div>
                    <div class="modal-step" data-step="4">
                        <label class="field">
                            <span>Video</span>
                            <input type="file" name="video" accept="video/*">
                        </label>
                        <label class="field">
                            <span>Before image</span>
                            <input type="file" name="before_image" accept="image/*">
                        </label>
                        <label class="field">
                            <span>After image</span>
                            <input type="file" name="after_image" accept="image/*">
                        </label>
                        <label class="field">
                            <span>Project media</span>
                            <input type="file" name="media[]" accept="image/*,video/*" multiple>
                        </label>
                        <label class="field">
                            <span>Invoice proof (optional)</span>
                            <input type="file" name="invoice_proof" accept="application/pdf,image/*">
                        </label>
                    </div>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-ghost" type="button" data-step-prev>Back</button>
                    <button class="btn btn-ghost" type="button" data-step-next>Next</button>
                    <button class="btn btn-emphasis" type="submit" data-step-submit>Save draft</button>
                </div>
            </form>
        </div>
    </div>
@endif
@endsection
