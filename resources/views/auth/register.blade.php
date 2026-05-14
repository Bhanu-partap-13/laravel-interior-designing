@extends('layouts.app')

@section('title', __('app.auth.register.title'))

@section('content')
<section class="page-hero auth-hero">
    <div class="container auth-layout">
        <div class="auth-media auth-media-register" role="img" aria-label="Elegant bedroom interior with soft lighting"></div>
        <div class="auth-panel">
            <p class="eyebrow">{{ __('app.auth.register.eyebrow') }}</p>
            <h1>{{ __('app.auth.register.heading') }}</h1>
            <p class="lead">{{ __('app.auth.register.lead') }}</p>
            <div class="thank-you-message">
                <p>Thank you for choosing to join our community! We're excited to have you here.</p>
            </div>
            @if (session('status'))
                <div class="status-banner">{{ session('status') }}</div>
            @endif
            <form class="form-card" method="post" action="{{ route('auth.register.store') }}">
                @csrf
                <label class="field">
                    <span>{{ __('app.auth.register.role') }}</span>
                    <select name="role" id="role-select">
                        <option value="client" @selected(old('role', 'client') === 'client')>{{ __('app.auth.register.role_client') }}</option>
                        <option value="designer" @selected(old('role') === 'designer')>{{ __('app.auth.register.role_designer') }}</option>
                    </select>
                    @error('role')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="field">
                    <span>{{ __('app.auth.register.name') }}</span>
                    <input type="text" name="name" placeholder="{{ __('app.auth.register.name_placeholder') }}" autocomplete="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="field">
                    <span>{{ __('app.auth.register.email') }}</span>
                    <input type="email" name="email" placeholder="{{ __('app.auth.register.email_placeholder') }}" autocomplete="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="field">
                    <span>{{ __('app.auth.register.password') }}</span>
                    <input type="password" name="password" placeholder="{{ __('app.auth.register.password_placeholder') }}" autocomplete="new-password">
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="field">
                    <span>{{ __('app.auth.register.password_confirm') }}</span>
                    <input type="password" name="password_confirmation" placeholder="{{ __('app.auth.register.password_confirm_placeholder') }}" autocomplete="new-password">
                </label>
                <div data-role="client">
                    <label class="field">
                        <span>{{ __('app.auth.register.design_type') }}</span>
                        <input type="text" name="design_type" placeholder="{{ __('app.auth.register.design_type_placeholder') }}" value="{{ old('design_type') }}">
                        @error('design_type')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="field">
                        <span>{{ __('app.auth.register.budget') }}</span>
                        <input type="text" name="budget_range" placeholder="{{ __('app.auth.register.budget_placeholder') }}" value="{{ old('budget_range') }}">
                        @error('budget_range')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="field">
                        <span>{{ __('app.auth.register.location') }}</span>
                        <input type="text" name="location" placeholder="{{ __('app.auth.register.location_placeholder') }}" value="{{ old('location') }}">
                        @error('location')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="field">
                        <span>{{ __('app.auth.register.timeline') }}</span>
                        <input type="text" name="timeline" placeholder="{{ __('app.auth.register.timeline_placeholder') }}" value="{{ old('timeline') }}">
                        @error('timeline')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="field">
                        <span>{{ __('app.auth.register.property_size') }}</span>
                        <input type="text" name="property_size" placeholder="{{ __('app.auth.register.property_size_placeholder') }}" value="{{ old('property_size') }}">
                        @error('property_size')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="field">
                        <span>{{ __('app.auth.register.style_preference') }}</span>
                        <input type="text" name="style_preference" placeholder="{{ __('app.auth.register.style_preference_placeholder') }}" value="{{ old('style_preference') }}">
                        @error('style_preference')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="field">
                        <span>{{ __('app.auth.register.notes') }}</span>
                        <textarea name="notes" placeholder="{{ __('app.auth.register.notes_placeholder') }}">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div data-role="designer">
                    <p>{{ __('app.auth.register.designer_hint') }}</p>
                </div>
                <button class="btn btn-primary" type="submit">{{ __('app.auth.register.submit') }}</button>
            </form>
        </div>
    </div>
</section>
<script>
    (function () {
        const select = document.getElementById('role-select');
        const sections = document.querySelectorAll('[data-role]');

        function toggleSections() {
            const role = select ? select.value : 'client';
            sections.forEach((section) => {
                section.style.display = section.getAttribute('data-role') === role ? '' : 'none';
            });
        }

        if (select) {
            select.addEventListener('change', toggleSections);
            toggleSections();
        }
    })();
</script>
@endsection
