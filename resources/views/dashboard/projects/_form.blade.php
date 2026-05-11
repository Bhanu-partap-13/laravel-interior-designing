@php
$styleTags = old('style_tags', isset($project) && $project->style_tags ? implode(', ', $project->style_tags) : '');
@endphp

<label class="field">
    <span>{{ __('app.dashboard.projects.form.title') }}</span>
    <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" placeholder="{{ __('app.dashboard.projects.form.title_placeholder') }}">
    @error('title')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.category') }}</span>
    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $project->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.description') }}</span>
    <textarea name="description" placeholder="{{ __('app.dashboard.projects.form.description_placeholder') }}">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.budget') }}</span>
    <input type="text" name="budget_range" value="{{ old('budget_range', $project->budget_range ?? '') }}" placeholder="{{ __('app.dashboard.projects.form.budget_placeholder') }}">
    @error('budget_range')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.duration') }}</span>
    <input type="number" name="duration_days" value="{{ old('duration_days', $project->duration_days ?? '') }}" min="1">
    @error('duration_days')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.tags') }}</span>
    <input type="text" name="style_tags" value="{{ $styleTags }}" placeholder="{{ __('app.dashboard.projects.form.tags_placeholder') }}">
    @error('style_tags')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.before') }}</span>
    <input type="file" name="before_image" accept="image/*">
    @error('before_image')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.after') }}</span>
    <input type="file" name="after_image" accept="image/*">
    @error('after_image')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.media') }}</span>
    <input type="file" name="media[]" accept="image/*,video/*" multiple>
    <p>{{ __('app.dashboard.projects.form.media_help') }}</p>
    @error('media')
        <span class="form-error">{{ $message }}</span>
    @enderror
    @error('media.*')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="field">
    <span>{{ __('app.dashboard.projects.form.invoice') }}</span>
    <input type="file" name="invoice_proof" accept="application/pdf,image/*">
    <p>{{ __('app.dashboard.projects.form.invoice_help') }}</p>
    @error('invoice_proof')
        <span class="form-error">{{ $message }}</span>
    @enderror
</label>
<label class="checkbox">
    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project->is_published ?? false))>
    <span>{{ __('app.dashboard.projects.form.publish') }}</span>
</label>
