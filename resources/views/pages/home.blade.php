@extends('layouts.site')

@section('content')
{{-- Hero --}}
<section class="hero">
    <div class="hero-dots" aria-hidden="true"></div>
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow" data-reveal>AI receptionist for UAE businesses</span>
            <h1 class="display" data-reveal style="--d:.08s">Answer every call in English and Arabic</h1>
            <p class="lead" data-reveal style="--d:.16s">aii picks up when your team can't. It answers questions about your business, takes messages and booking requests, transfers urgent calls, and sends your team a summary of every conversation.</p>
            <div class="btn-row" data-reveal style="--d:.24s">
                <a class="btn" href="{{ route('demo') }}">Request a demo <x-icon name="arrow" /></a>
                @if (config('aii.demo_number'))
                    <a class="btn btn-ghost" href="tel:{{ config('aii.demo_number') }}"><x-icon name="play" /> Hear a sample</a>
                @else
                    <a class="btn btn-ghost" href="#how-it-works">See how it works</a>
                @endif
            </div>
            <div class="hero-meta" data-reveal style="--d:.32s">
                <span><x-icon name="phone" /> Keep your e&amp; or du number</span>
                <span><x-icon name="clock" /> Answers 24 hours a day</span>
                <span><x-icon name="globe" /> English and Gulf Arabic</span>
            </div>
        </div>
        <div data-reveal="zoom" style="--d:.2s">
            @include('partials.phone')
        </div>
    </div>
</section>

{{-- Moving strip --}}
<div class="strip" aria-hidden="true">
    <div class="marquee">
        @foreach (range(1, 2) as $loopCopy)
            <span>Dental and medical clinics</span><span>Real estate agencies</span><span>Restaurants and cafés</span>
            <span>Salons and spas</span><span>Car service centres</span><span>Law and accounting firms</span>
            <span>Schools and nurseries</span><span>Hotels and holiday homes</span>
        @endforeach
    </div>
</div>

{{-- Products --}}
<section class="section" id="products">
    <div class="container">
        <div class="section-head" data-reveal>
            <span class="eyebrow">Products</span>
            <h2 class="h2">One AI team for every channel</h2>
            <p class="lead">Tell aii about your business once. The same knowledge answers your phone today, with WhatsApp and website chat next.</p>
        </div>
        <div class="grid-4">
            @php
            $cards = [
                ['ai-secretary', 'phone', 'AI Secretary', 'Answers your landline or mobile, takes messages and booking requests, and transfers urgent calls.', 'Available now', true],
                ['whatsapp-agent', 'chat', 'WhatsApp Agent', 'Replies to WhatsApp enquiries in seconds and passes qualified leads to your team.', 'Coming soon', false],
                ['website-chat', 'window', 'Website Chat', 'A chat assistant on your website that answers questions and captures enquiries.', 'Coming soon', false],
                ['call-analytics', 'chart', 'Call Analytics', "Transcribes your team's calls and shows what customers ask most.", 'Coming soon', false],
            ];
            @endphp
            @foreach ($cards as $i => [$route, $icon, $name, $text, $status, $live])
                <article class="card" data-reveal style="--d:{{ $i * 0.08 }}s">
                    <span class="icon-tile"><x-icon :name="$icon" /></span>
                    <span class="tag {{ $live ? 'dark' : '' }}">{{ $status }}</span>
                    <h3 class="h3">{{ $name }}</h3>
                    <p>{{ $text }}</p>
                    <a class="link" href="{{ route($route) }}">{{ $live ? 'Explore' : 'Join the waitlist' }} <x-icon name="arrow" /></a>
                    <a class="card-link" href="{{ route($route) }}" aria-label="{{ $name }}" tabindex="-1"></a>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- How it works --}}
<section class="section bg-midnight" id="how-it-works">
    <div class="container">
        <div class="section-head" data-reveal>
            <span class="eyebrow">How it works</span>
            <h2 class="h2">Live in three steps</h2>
            <p class="lead">No new phone system and no new number for your customers to learn.</p>
        </div>
        <div class="steps">
            <div class="steps-line" aria-hidden="true"></div>
            <div class="step" data-reveal>
                <span class="step-num">1</span>
                <h3>Tell aii about your business</h3>
                <p>Opening hours, services, prices, location and common questions. We turn them into your receptionist's script.</p>
            </div>
            <div class="step" data-reveal style="--d:.15s">
                <span class="step-num">2</span>
                <h3>Connect your number</h3>
                <p>Forward your mobile with one dial code, or we connect your e&amp; or du landline for you.</p>
            </div>
            <div class="step" data-reveal style="--d:.3s">
                <span class="step-num">3</span>
                <h3>Read every call in a summary</h3>
                <p>After each call your team gets who called, what they wanted and what to do next.</p>
            </div>
        </div>
    </div>
</section>

{{-- What happens on a call --}}
<section class="section">
    <div class="container split">
        <div style="display:grid;gap:24px" data-reveal="left">
            <span class="eyebrow">On every call</span>
            <h2 class="h2">A receptionist that never puts callers on hold</h2>
            <p class="lead">aii follows your rules: what to say, what to book, and when a person must take over.</p>
            <ul class="checklist">
                <li><x-icon name="check-circle" /><span><strong>Answers in the caller's language.</strong> English or Gulf Arabic, switching when the caller does.</span></li>
                <li><x-icon name="check-circle" /><span><strong>Takes messages and booking requests.</strong> Name, number, preferred time and the reason for calling.</span></li>
                <li><x-icon name="check-circle" /><span><strong>Transfers urgent calls.</strong> Straight to the staff number you choose.</span></li>
                <li><x-icon name="check-circle" /><span><strong>Says it is an AI.</strong> Every call opens with a short, clear notice.</span></li>
            </ul>
        </div>
        <div class="panel" data-reveal="right">
            <div class="panel-head"><span class="dots"><i></i><i></i><i></i></span> Call flow · Smile Dental</div>
            <div class="flow" data-flow>
                <div class="flow-node"><span class="icon-tile"><x-icon name="phone" /></span><div>Call arrives on your number<span>Forwarded from 050 or your landline</span></div></div>
                <div class="flow-node"><span class="icon-tile"><x-icon name="mic" /></span><div>aii answers instantly<span>Greets callers with your business name</span></div></div>
                <div class="flow-split">
                    <div class="flow-node"><span class="icon-tile"><x-icon name="message" /></span>Takes a message</div>
                    <div class="flow-node"><span class="icon-tile"><x-icon name="calendar" /></span>Booking request</div>
                    <div class="flow-node"><span class="icon-tile"><x-icon name="transfer" /></span>Transfers to staff</div>
                </div>
                <div class="flow-node"><span class="icon-tile"><x-icon name="mail" /></span><div>Your team gets the summary<span>Who called, what they wanted, what's next</span></div></div>
            </div>
        </div>
    </div>
</section>

{{-- Industries --}}
<section class="section bg-mint-soft" id="industries">
    <div class="container">
        <div class="section-head center" data-reveal>
            <span class="eyebrow">Industries</span>
            <h2 class="h2">Built for businesses that live on the phone</h2>
        </div>
        <div class="grid-4">
            @php
            $industries = [
                ['pulse', 'Clinics', 'Collects booking requests, answers timing and insurance questions, and flags urgent cases.'],
                ['home', 'Real estate', 'Asks budget, area and move-in date, then passes qualified enquiries to the right agent.'],
                ['utensils', 'Restaurants and salons', 'Takes reservations and appointment requests at rush hour without a busy tone.'],
                ['briefcase', 'Professional services', 'Screens new enquiries for law, accounting and business setup firms after hours.'],
            ];
            @endphp
            @foreach ($industries as $i => [$icon, $name, $text])
                <article class="card" data-reveal style="--d:{{ $i * 0.08 }}s">
                    <span class="icon-tile"><x-icon :name="$icon" /></span>
                    <h3 class="h3">{{ $name }}</h3>
                    <p>{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- Pricing teaser --}}
<section class="section" id="pricing">
    <div class="container">
        <div class="section-head center" data-reveal>
            <span class="eyebrow">Pricing</span>
            <h2 class="h2">Simple monthly plans</h2>
            <p class="lead">Prices in AED, excluding VAT. Start with a free demo set up for your business.</p>
        </div>
        <div class="grid-3">
            @foreach (array_slice(config('aii.plans'), 0, 3) as $i => $plan)
                <div class="price {{ !empty($plan['popular']) ? 'featured' : '' }}" data-reveal style="--d:{{ $i * 0.1 }}s">
                    @if (!empty($plan['popular']))<span class="popular">Most popular</span>@endif
                    <h3 class="h3">{{ $plan['name'] }}</h3>
                    <p class="amount">{{ number_format($plan['monthly']) }} <small>AED / month</small></p>
                    <p>{{ $plan['for'] }}</p>
                    <ul class="checklist">
                        @foreach (array_slice($plan['features'], 0, 3) as $f)
                            <li><x-icon name="check" /><span>{{ $f }}</span></li>
                        @endforeach
                    </ul>
                    <a class="btn {{ !empty($plan['popular']) ? 'btn-light' : 'btn-ghost' }}" href="{{ route('demo', ['plan' => $plan['key']]) }}">Request a demo</a>
                </div>
            @endforeach
        </div>
        <p style="text-align:center;margin-top:32px" data-reveal><a href="{{ route('pricing') }}"><strong>Compare all plans, including Enterprise</strong></a></p>
    </div>
</section>

{{-- FAQ --}}
<section class="section bg-mint-soft" id="faq">
    <div class="container">
        <div class="section-head center" data-reveal>
            <span class="eyebrow">FAQ</span>
            <h2 class="h2">Questions businesses ask us</h2>
        </div>
        <div class="faq" data-reveal>
            @include('partials.faq-items')
        </div>
    </div>
</section>

@include('partials.cta')
@endsection
