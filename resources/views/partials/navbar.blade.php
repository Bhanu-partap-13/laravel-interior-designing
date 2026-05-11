<header class="site-header">
    <div class="container nav-bar">
        <a class="logo" href="{{ route('home') }}">
            <span class="logo-mark"></span>
            <span class="logo-text">{{ __('app.footer.brand_title') }}</span>
        </a>
        <nav class="nav-links">
            <a href="{{ route('designers.index') }}">{{ __('app.nav.designers') }}</a>
            <a href="{{ route('projects.index') }}">{{ __('app.nav.projects') }}</a>
            <a href="{{ route('categories.show', 'living-room') }}">{{ __('app.nav.categories') }}</a>
            <a href="{{ route('dashboard.index') }}">{{ __('app.nav.dashboard') }}</a>
        </nav>
        <div class="nav-actions">
            @guest
                <a class="btn btn-ghost" href="{{ route('auth.login') }}">{{ __('app.nav.login') }}</a>
                <a class="btn btn-primary" href="{{ route('auth.register') }}">{{ __('app.nav.register') }}</a>
            @else
                <span class="chip">{{ auth()->user()->name }}</span>
                <form method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="btn btn-ghost" type="submit">{{ __('app.nav.logout') }}</button>
                </form>
            @endguest
            <button
                class="btn btn-ghost theme-toggle"
                id="theme-toggle"
                type="button"
                data-light="{{ __('app.theme.light') }}"
                data-dark="{{ __('app.theme.dark') }}"
                aria-pressed="false"
            >
                {{ __('app.theme.toggle') }}
            </button>
            <div class="nav-locale">
                <span class="chip">{{ __('app.nav.language') }}</span>
                <a class="locale-link @if (app()->getLocale() === 'en') active @endif" href="{{ route('locale.switch', 'en') }}">{{ __('app.languages.en') }}</a>
                <a class="locale-link @if (app()->getLocale() === 'hi') active @endif" href="{{ route('locale.switch', 'hi') }}">{{ __('app.languages.hi') }}</a>
                <a class="locale-link @if (app()->getLocale() === 'ta') active @endif" href="{{ route('locale.switch', 'ta') }}">{{ __('app.languages.ta') }}</a>
            </div>
        </div>
    </div>
</header>
