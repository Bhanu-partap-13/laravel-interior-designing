<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('app.emails.inquiry.title') }}</title>
</head>
<body>
    <h2>{{ __('app.emails.inquiry.heading') }}</h2>
    <p><strong>{{ __('app.emails.inquiry.project') }}:</strong> {{ $inquiry->project->title ?? __('app.projects.index.project_fallback') }}</p>
    <p><strong>{{ __('app.emails.inquiry.from') }}:</strong> {{ $inquiry->visitor_name }} ({{ $inquiry->visitor_email }})</p>
    <p><strong>{{ __('app.emails.inquiry.message') }}:</strong></p>
    <p>{{ $inquiry->message }}</p>
</body>
</html>
