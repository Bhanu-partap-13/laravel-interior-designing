@extends('layouts.app')

@section('title', __('app.footer.brand_title'))

@section('content')
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-content">
            <p class="eyebrow">{{ __('app.home.hero.eyebrow') }}</p>
            <h1>{{ __('app.home.hero.title') }}</h1>
            <p class="lead">{{ __('app.home.hero.lead') }}</p>
            <div class="actions">
                <a class="btn btn-primary" href="{{ route('projects.index') }}">{{ __('app.home.hero.primary') }}</a>
                <a class="btn btn-ghost" href="{{ route('designers.index') }}">{{ __('app.home.hero.secondary') }}</a>
            </div>
            <div class="stat-grid">
                <div class="stat">
                    <span class="stat-value">120+</span>
                    <span class="stat-label">{{ __('app.home.stats.studios') }}</span>
                </div>
                <div class="stat">
                    <span class="stat-value">540</span>
                    <span class="stat-label">{{ __('app.home.stats.projects') }}</span>
                </div>
                <div class="stat">
                    <span class="stat-value">36</span>
                    <span class="stat-label">{{ __('app.home.stats.cities') }}</span>
                </div>
            </div>
        </div>
        <div class="hero-art">
            <div class="hero-frame">
                <div class="hero-frame-inner">
                    <img
                        class="hero-photo"
                        src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80"
                        alt="{{ __('app.home.hero.featured_label') }}"
                    >
                    <p class="frame-label">{{ __('app.home.hero.featured_label') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container section-head">
        <div>
            <p class="eyebrow">{{ __('app.home.featured.eyebrow') }}</p>
            <h2>{{ __('app.home.featured.title') }}</h2>
        </div>
        <p class="section-lead">{{ __('app.home.featured.lead') }}</p>
    </div>
    <div class="container card-grid">
        <article class="card">
            <div class="card-top">
                <span class="chip">{{ __('app.home.featured_cards.sunlit.category') }}</span>
                <span class="card-meta">{{ __('app.home.featured_cards.sunlit.city') }}</span>
            </div>
            <img
                class="card-image"
                src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80"
                alt="{{ __('app.home.featured_cards.sunlit.title') }}"
            >
            <h3>{{ __('app.home.featured_cards.sunlit.title') }}</h3>
            <p>{{ __('app.home.featured_cards.sunlit.text') }}</p>
            <div class="card-bottom">
                <span>{{ __('app.home.featured_cards.sunlit.budget') }}</span>
                <span>{{ __('app.home.featured_cards.sunlit.duration') }}</span>
            </div>
        </article>
        <article class="card">
            <div class="card-top">
                <span class="chip">{{ __('app.home.featured_cards.coastal.category') }}</span>
                <span class="card-meta">{{ __('app.home.featured_cards.coastal.city') }}</span>
            </div>
            <img
                class="card-image"
                src="https://images.unsplash.com/photo-1501045661006-fcebe0257c3f?auto=format&fit=crop&w=900&q=80"
                alt="{{ __('app.home.featured_cards.coastal.title') }}"
            >
            <h3>{{ __('app.home.featured_cards.coastal.title') }}</h3>
            <p>{{ __('app.home.featured_cards.coastal.text') }}</p>
            <div class="card-bottom">
                <span>{{ __('app.home.featured_cards.coastal.budget') }}</span>
                <span>{{ __('app.home.featured_cards.coastal.duration') }}</span>
            </div>
        </article>
        <article class="card">
            <div class="card-top">
                <span class="chip">{{ __('app.home.featured_cards.heritage.category') }}</span>
                <span class="card-meta">{{ __('app.home.featured_cards.heritage.city') }}</span>
            </div>
            <img
                class="card-image"
                src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80"
                alt="{{ __('app.home.featured_cards.heritage.title') }}"
            >
            <h3>{{ __('app.home.featured_cards.heritage.title') }}</h3>
            <p>{{ __('app.home.featured_cards.heritage.text') }}</p>
            <div class="card-bottom">
                <span>{{ __('app.home.featured_cards.heritage.budget') }}</span>
                <span>{{ __('app.home.featured_cards.heritage.duration') }}</span>
            </div>
        </article>
    </div>
</section>

<section class="section alt">
    <div class="container section-head">
        <div>
            <p class="eyebrow">{{ __('app.home.categories.eyebrow') }}</p>
            <h2>{{ __('app.home.categories.title') }}</h2>
        </div>
        <p class="section-lead">{{ __('app.home.categories.lead') }}</p>
    </div>
    <div class="container chip-grid">
        <a class="chip large" href="{{ route('categories.show', 'living-room') }}">{{ __('app.home.categories.items.living-room') }}</a>
        <a class="chip large" href="{{ route('categories.show', 'bedroom') }}">{{ __('app.home.categories.items.bedroom') }}</a>
        <a class="chip large" href="{{ route('categories.show', 'kitchen') }}">{{ __('app.home.categories.items.kitchen') }}</a>
        <a class="chip large" href="{{ route('categories.show', 'office') }}">{{ __('app.home.categories.items.office') }}</a>
        <a class="chip large" href="{{ route('categories.show', 'outdoor') }}">{{ __('app.home.categories.items.outdoor') }}</a>
        <a class="chip large" href="{{ route('categories.show', 'commercial') }}">{{ __('app.home.categories.items.commercial') }}</a>
    </div>
</section>

<section class="section">
    <div class="container section-head">
        <div>
            <p class="eyebrow">{{ __('app.home.steps.eyebrow') }}</p>
            <h2>{{ __('app.home.steps.title') }}</h2>
        </div>
        <p class="section-lead">{{ __('app.home.steps.lead') }}</p>
    </div>
    <div class="container step-grid">
        <div class="step">
            <span class="step-count">01</span>
            <h3>{{ __('app.home.steps.items.one.title') }}</h3>
            <p>{{ __('app.home.steps.items.one.text') }}</p>
        </div>
        <div class="step">
            <span class="step-count">02</span>
            <h3>{{ __('app.home.steps.items.two.title') }}</h3>
            <p>{{ __('app.home.steps.items.two.text') }}</p>
        </div>
        <div class="step">
            <span class="step-count">03</span>
            <h3>{{ __('app.home.steps.items.three.title') }}</h3>
            <p>{{ __('app.home.steps.items.three.text') }}</p>
        </div>
        <div class="step">
            <span class="step-count">04</span>
            <h3>{{ __('app.home.steps.items.four.title') }}</h3>
            <p>{{ __('app.home.steps.items.four.text') }}</p>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container contact-callout-inner">
        <div>
            <p class="eyebrow">{{ __('app.home.contact.eyebrow') }}</p>
            <h2>{{ __('app.home.contact.title') }}</h2>
            <p class="section-lead">{{ __('app.home.contact.lead') }}</p>
            <div class="actions">
                <a class="btn btn-primary" href="{{ route('contact') }}">{{ __('app.home.contact.primary') }}</a>
                <a class="btn btn-ghost" href="{{ route('designers.index') }}">{{ __('app.home.contact.secondary') }}</a>
            </div>
        </div>
        <div class="contact-card-grid">
            <div class="contact-card">
                <span class="chip">{{ __('app.home.contact.cards.email.label') }}</span>
                <p>{{ __('app.home.contact.cards.email.value') }}</p>
                <a class="text-link" href="mailto:{{ __('app.home.contact.cards.email.value') }}">{{ __('app.home.contact.cards.email.action') }}</a>
            </div>
            <div class="contact-card">
                <span class="chip">{{ __('app.home.contact.cards.phone.label') }}</span>
                <p>{{ __('app.home.contact.cards.phone.value') }}</p>
                <a class="text-link" href="tel:{{ __('app.home.contact.cards.phone.value') }}">{{ __('app.home.contact.cards.phone.action') }}</a>
            </div>
            <div class="contact-card">
                <span class="chip">{{ __('app.home.contact.cards.location.label') }}</span>
                <p>{{ __('app.home.contact.cards.location.value') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container section-head">
        <div>
            <p class="eyebrow">{{ __('app.home.faq.eyebrow') }}</p>
            <h2>{{ __('app.home.faq.title') }}</h2>
        </div>
        <p class="section-lead">{{ __('app.home.faq.lead') }}</p>
    </div>
    <div class="container faq-grid">
        <details class="faq-item">
            <summary class="faq-question">{{ __('app.home.faq.items.one.question') }}</summary>
            <p class="faq-answer">{{ __('app.home.faq.items.one.answer') }}</p>
        </details>
        <details class="faq-item">
            <summary class="faq-question">{{ __('app.home.faq.items.two.question') }}</summary>
            <p class="faq-answer">{{ __('app.home.faq.items.two.answer') }}</p>
        </details>
        <details class="faq-item">
            <summary class="faq-question">{{ __('app.home.faq.items.three.question') }}</summary>
            <p class="faq-answer">{{ __('app.home.faq.items.three.answer') }}</p>
        </details>
        <details class="faq-item">
            <summary class="faq-question">{{ __('app.home.faq.items.four.question') }}</summary>
            <p class="faq-answer">{{ __('app.home.faq.items.four.answer') }}</p>
        </details>
        <details class="faq-item">
            <summary class="faq-question">{{ __('app.home.faq.items.five.question') }}</summary>
            <p class="faq-answer">{{ __('app.home.faq.items.five.answer') }}</p>
        </details>
        <details class="faq-item">
            <summary class="faq-question">{{ __('app.home.faq.items.six.question') }}</summary>
            <p class="faq-answer">{{ __('app.home.faq.items.six.answer') }}</p>
        </details>
    </div>
</section>

<section class="section cta">
    <div class="container cta-inner">
        <div>
            <p class="eyebrow">{{ __('app.home.cta.eyebrow') }}</p>
            <h2>{{ __('app.home.cta.title') }}</h2>
            <p class="section-lead">{{ __('app.home.cta.lead') }}</p>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ route('auth.register') }}">{{ __('app.home.cta.primary') }}</a>
            <a class="btn btn-ghost" href="{{ route('projects.index') }}">{{ __('app.home.cta.secondary') }}</a>
        </div>
    </div>
</section>
@endsection
