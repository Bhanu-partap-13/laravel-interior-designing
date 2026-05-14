<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <title>@yield('title', __('app.footer.brand_title'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="page-loader" id="page-loader" role="status" aria-live="polite">
        <div class="loader-stack">
            <div class="loader-mark" aria-hidden="true">
                <span class="loader-letter">R</span>
                <span class="loader-ring"></span>
            </div>
            <div class="loader-text">
                Loading
                <span class="loader-dots" aria-hidden="true">
                    <span>.</span>
                    <span>.</span>
                    <span>.</span>
                </span>
            </div>
        </div>
    </div>
    <div class="page">
        @include('partials.navbar')
        <main class="main">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
</body>
</html>
