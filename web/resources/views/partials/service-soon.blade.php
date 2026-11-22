{{-- Shared layout for products that are not live yet.
     Vars: $product, $eyebrow, $heading, $lead, $visual (view name), $plans (list of [icon, title, text]), $faqs --}}
<section class="page-hero">
    <div class="hero-dots" aria-hidden="true"></div>
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="breadcrumb" data-reveal><a href="{{ route('home') }}">Home</a> / {{ $eyebrow }}</p>
            <span class="eyebrow" data-reveal>{{ $eyebrow }} · coming soon</span>
            <h1 class="display" data-reveal style="--d:.08s">{{ $heading }}</h1>
            <p class="lead" data-reveal style="--d:.16s">{{ $lead }}</p>
            <div class="btn-row" data-reveal style="--d:.24s">
                <a class="btn" href="{{ route('demo', ['product' => $product]) }}">Join the waitlist <x-icon name="arrow" /></a>
                <a class="btn btn-ghost" href="{{ route('ai-secretary') }}">See the AI Secretary</a>
            </div>
            <p class="muted" style="font-size:14px;--d:.3s" data-reveal>Early-access businesses get setup help and launch pricing.</p>
        </div>
        <div data-reveal="zoom" style="--d:.2s">@include($visual)</div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head" data-reveal>
            <span class="eyebrow">What it will do</span>
            <h2 class="h2">{{ $plansHeading }}</h2>
            <p class="lead">It shares the same business knowledge as your AI Secretary, so you set things up once.</p>
        </div>
        <div class="grid-3">
            @foreach ($plans as $i => [$icon, $title, $text])
                <article class="card" data-reveal style="--d:{{ ($i % 3) * 0.08 }}s">
                    <span class="icon-tile"><x-icon :name="$icon" /></span>
                    <h3 class="h3">{{ $title }}</h3>
                    <p>{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section bg-mint-soft">
    <div class="container">
        <div class="section-head center" data-reveal>
            <span class="eyebrow">Questions</span>
            <h2 class="h2">About {{ $eyebrow }}</h2>
        </div>
        <div class="faq" data-reveal>@include('partials.faq-items', ['faqs' => $faqs])</div>
    </div>
</section>

@include('partials.cta', ['ctaHeading' => 'Be first to use '.$eyebrow, 'ctaText' => 'Join the waitlist and we will set it up with you as soon as it launches. Your AI Secretary can start today.', 'ctaButton' => 'Join the waitlist', 'ctaProduct' => $product])
