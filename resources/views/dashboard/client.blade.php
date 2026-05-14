@extends('layouts.app')

@section('title', 'Client Dashboard')

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
                <button class="btn btn-ghost" type="submit">Logout</button>
            </form>
            <div class="dashboard-actions">
                <a class="btn btn-primary" href="{{ route('projects.index') }}">Browse projects</a>
                <a class="btn btn-ghost" href="{{ route('contact') }}">Contact us</a>
            </div>
        </div>
        <div class="profile-panel">
            <div class="profile-photo">
                <span>{{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}</span>
            </div>
            <div class="profile-info">
                <p class="eyebrow">Client dashboard</p>
                <h2>{{ auth()->user()->name }}</h2>
                <p class="profile-role">Design preferences</p>
                <p class="lead">
                    {{ $client?->notes ?? 'Tell us about your project goals whenever you are ready.' }}
                </p>
            </div>
            <div class="profile-meta">
                <p><strong>Design type:</strong> {{ $client?->design_type ?? 'Not set' }}</p>
                <p><strong>Budget range:</strong> {{ $client?->budget_range ?? 'Not set' }}</p>
                <p><strong>Location:</strong> {{ $client?->location ?? 'Not set' }}</p>
                <p><strong>Mobile:</strong> {{ auth()->user()->phone ?? 'Not set' }}</p>
                <p><strong>Timeline:</strong> {{ $client?->timeline ?? 'Not set' }}</p>
                <p><strong>Property size:</strong> {{ $client?->property_size ?? 'Not set' }}</p>
                <p><strong>Style preference:</strong> {{ $client?->style_preference ?? 'Not set' }}</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <p class="eyebrow">Project details</p>
        <h2>Tell us about your space</h2>
        <p class="lead">Add the details beyond your name, email, password, and mobile number.</p>
        <form class="form-card multi-step-form" method="post" action="{{ route('client.profile.update') }}">
            @csrf
            @method('put')
            
            <div class="step-indicators">
                <div class="step-dot active" data-step="1"></div>
                <div class="step-dot" data-step="2"></div>
                <div class="step-dot" data-step="3"></div>
                <div class="step-dot" data-step="4"></div>
            </div>

            <!-- Step 1: Project Overview -->
            <div class="form-step active" data-step="1">
                <h3>Step 1: Project Overview</h3>
                <label class="field">
                    <span>Design type</span>
                    <input type="text" name="design_type" value="{{ old('design_type', $client?->design_type ?? '') }}" placeholder="Residential, office, retail">
                    @error('design_type')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="field">
                    <span>Property size</span>
                    <input type="text" name="property_size" value="{{ old('property_size', $client?->property_size ?? '') }}" placeholder="Room count or sqft">
                    @error('property_size')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <div class="form-actions">
                    <button type="button" class="btn btn-primary next-step">Next Step</button>
                </div>
            </div>

            <!-- Step 2: Preferences -->
            <div class="form-step" data-step="2" style="display: none;">
                <h3>Step 2: Preferences</h3>
                <label class="field">
                    <span>Style preference</span>
                    <input type="text" name="style_preference" value="{{ old('style_preference', $client?->style_preference ?? '') }}" placeholder="Minimal, modern, classic">
                    @error('style_preference')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="field">
                    <span>Budget range</span>
                    <input type="text" name="budget_range" value="{{ old('budget_range', $client?->budget_range ?? '') }}" placeholder="Low, Mid, High">
                    @error('budget_range')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <div class="form-actions">
                    <button type="button" class="btn btn-ghost prev-step">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next Step</button>
                </div>
            </div>

            <!-- Step 3: Location & Timeline -->
            <div class="form-step" data-step="3" style="display: none;">
                <h3>Step 3: Location & Timeline</h3>
                <label class="field">
                    <span>Location</span>
                    <input type="text" name="location" value="{{ old('location', $client?->location ?? '') }}" placeholder="City or area">
                    @error('location')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="field">
                    <span>Timeline</span>
                    <input type="text" name="timeline" value="{{ old('timeline', $client?->timeline ?? '') }}" placeholder="Preferred timeline">
                    @error('timeline')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <div class="form-actions">
                    <button type="button" class="btn btn-ghost prev-step">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next Step</button>
                </div>
            </div>

            <!-- Step 4: Notes -->
            <div class="form-step" data-step="4" style="display: none;">
                <h3>Step 4: Additional Notes</h3>
                <label class="field">
                    <span>Notes</span>
                    <textarea name="notes" placeholder="Project goals and notes">{{ old('notes', $client?->notes ?? '') }}</textarea>
                    @error('notes')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <div class="form-actions">
                    <button type="button" class="btn btn-ghost prev-step">Previous</button>
                    <button class="btn btn-primary" type="submit">Save details</button>
                </div>
            </div>
        </form>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.form-step');
            const nextBtns = document.querySelectorAll('.next-step');
            const prevBtns = document.querySelectorAll('.prev-step');
            const dots = document.querySelectorAll('.step-dot');

            function updateDots(index) {
                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }

            nextBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const currentStep = btn.closest('.form-step');
                    const nextStep = currentStep.nextElementSibling;
                    if (nextStep && nextStep.classList.contains('form-step')) {
                        currentStep.style.display = 'none';
                        currentStep.classList.remove('active');
                        nextStep.style.display = 'block';
                        nextStep.classList.add('active');
                        updateDots(parseInt(nextStep.dataset.step) - 1);
                    }
                });
            });

            prevBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const currentStep = btn.closest('.form-step');
                    const prevStep = currentStep.previousElementSibling;
                    if (prevStep && prevStep.classList.contains('form-step')) {
                        currentStep.style.display = 'none';
                        currentStep.classList.remove('active');
                        prevStep.style.display = 'block';
                        prevStep.classList.add('active');
                        updateDots(parseInt(prevStep.dataset.step) - 1);
                    }
                });
            });
        });
        </script>
    </div>
</section>

<section class="section dashboard-projects">
    <div class="container">
        <div class="section-head">
            <div>
                <p class="eyebrow">Projects</p>
                <h2>Explore designers</h2>
            </div>
            <a class="btn btn-ghost" href="{{ route('projects.index') }}">View all</a>
        </div>
        @if ($featuredProjects->isEmpty())
            <div class="placeholder-card">No published projects yet.</div>
        @else
            <div class="card-grid">
                @foreach ($featuredProjects as $project)
                    <article class="card">
                        <div class="card-top">
                            <span class="chip">{{ $project->category?->name ?? 'Interior' }}</span>
                            <span class="card-meta">{{ $project->designer?->city ?? 'Location' }}</span>
                        </div>
                        <img
                            class="card-image"
                            src="{{ $project->after_image ? asset('storage/' . $project->after_image) : 'https://source.unsplash.com/800x600/?interior,design&sig=' . $project->id }}"
                            alt="{{ $project->title }}"
                        >
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->description ?? 'View this project for full details.' }}</p>
                        <div class="card-bottom">
                            <span>Budget: {{ $project->budget_range ?? 'Flexible' }}</span>
                            <a class="text-link" href="{{ route('projects.show', $project->slug) }}">View project</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
