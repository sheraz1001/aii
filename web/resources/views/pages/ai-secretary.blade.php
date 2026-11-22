@extends('layouts.site', ['title' => 'AI Secretary', 'description' => 'aii AI Secretary answers your business calls in English and Arabic, takes messages and booking requests, transfers urgent calls and emails your team a summary.'])

@section('content')
<section class="hero">
    <div class="hero-dots" aria-hidden="true"></div>
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="breadcrumb" data-reveal><a href="{{ route('home') }}">Home</a> / AI Secretary</p>
            <span class="eyebrow" data-reveal>AI Secretary</span>
            <h1 class="display" data-reveal style="--d:.08s">Never miss a business call again</h1>
            <p class="lead" data-reveal style="--d:.16s">Your AI Secretary answers the number your customers already call. It speaks English and Gulf Arabic, knows your services and hours, and makes sure your team can follow up on every caller.</p>
            <div class="btn-row" data-reveal style="--d:.24s">
                <a class="btn" href="{{ route('demo', ['product' => 'ai-secretary']) }}">Request a demo <x-icon name="arrow" /></a>
                @if (config('aii.demo_number'))
                    <a class="btn btn-ghost" href="tel:{{ config('aii.demo_number') }}"><x-icon name="play" /> Hear a sample</a>
                @else
                    <a class="btn btn-ghost" href="#connect">How to connect</a>
                @endif
            </div>
        </div>
        <div data-reveal="zoom" style="--d:.2s">@include('partials.phone')</div>
    </div>
</section>

<section class="section" id="connect">
    <div class="container">
        <div class="section-head" data-reveal>
            <span class="eyebrow">Connect your number</span>
            <h2 class="h2">Keep your number and connect in minutes</h2>
            <p class="lead">Customers call the same e&amp; or du number they always have. aii picks up.</p>
        </div>
        <div class="grid-2">
            <article class="card" data-reveal>
                <span class="tag">Mobile number · free setup</span>
                <h3 class="h3">Forward calls from your 050, 052, 054, 055, 056 or 058 mobile</h3>
                <p>Dial one code on your phone. Forward every call, or only the calls you can't answer.</p>
                <div class="panel" style="box-shadow:none;background:var(--midnight);border:0;color:#fff">
                    <div style="display:grid;gap:14px;padding:22px">
                        <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap"><span style="color:#B9BEE6">All calls</span><strong>**21*your aii number#</strong></div>
                        <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap"><span style="color:#B9BEE6">When you don't answer</span><strong>**61*your aii number**20#</strong></div>
                        <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap"><span style="color:#B9BEE6">Turn it off</span><strong>##002#</strong></div>
                    </div>
                </div>
                <p class="muted" style="font-size:14px">Forwarded calls use your mobile plan's local call rate. We give you your aii number and test it with you.</p>
            </article>
            <article class="card" data-reveal style="--d:.1s">
                <span class="tag">Office landline · we set it up</span>
                <h3 class="h3">Connect your e&amp; or du landline</h3>
                <p>We arrange a direct connection for your 04, 02, 06 or 600 number with your provider. Your number, contract and bill stay the same.</p>
                <ul class="checklist">
                    <li><x-icon name="check-circle" /><span>Send us your number and trade licence</span></li>
                    <li><x-icon name="check-circle" /><span>We request the connection from e&amp; or du</span></li>
                    <li><x-icon name="check-circle" /><span>We test it with you, then go live</span></li>
                </ul>
                <p class="muted" style="font-size:14px">One-time setup fee: AED {{ config('aii.landline_setup_aed') }}.</p>
            </article>
        </div>
    </div>
</section>

<section class="section bg-midnight">
    <div class="container">
        <div class="section-head" data-reveal>
            <span class="eyebrow">What it does</span>
            <h2 class="h2">Everything a good front desk does on the phone</h2>
        </div>
        <div class="grid-3">
            @php
            $features = [
                ['globe', 'Speaks your callers\' language', 'English and Gulf Arabic, switching mid-call when the caller does.'],
                ['file', 'Knows your business', 'Answers from your hours, services, prices, location and FAQs, and nothing else.'],
                ['calendar', 'Takes booking requests', 'Collects name, number, preferred time and reason, ready for your team to confirm.'],
                ['transfer', 'Transfers urgent calls', 'Puts callers through to the staff number you choose when a person is needed.'],
                ['shield', 'Tells callers it is an AI', 'Every call opens with a short notice that it is an AI assistant and may be recorded.'],
                ['mail', 'Summarises every call', 'Your team gets a summary and the full transcript by email after each call.'],
            ];
            @endphp
            @foreach ($features as $i => [$icon, $name, $text])
                <div class="step" data-reveal style="--d:{{ ($i % 3) * 0.1 }}s">
                    <span class="step-num"><x-icon :name="$icon" width="24" height="24" /></span>
                    <h3>{{ $name }}</h3>
                    <p>{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div style="display:grid;gap:24px" data-reveal="left">
            <span class="eyebrow">After every call</span>
            <h2 class="h2">Know who called and what to do next</h2>
            <p class="lead">Seconds after the caller hangs up, your team gets a three-line summary: what the caller wanted, what aii did, and what still needs a person.</p>
            <ul class="checklist">
                <li><x-icon name="check-circle" /><span>Urgent messages are marked in the subject line</span></li>
                <li><x-icon name="check-circle" /><span>The full transcript is attached to every summary</span></li>
                <li><x-icon name="check-circle" /><span>Send summaries to one inbox or several</span></li>
            </ul>
        </div>
        <div class="panel" data-reveal="right">
            <div class="panel-head"><span class="dots"><i></i><i></i><i></i></span> New call from +971 50 ··· 4821</div>
            <div style="padding:28px;display:grid;gap:16px;font-size:15px">
                <p style="font-weight:800;color:var(--ink);font-size:18px">Smile Dental · call summary</p>
                <p><strong style="color:var(--ink)">Wanted:</strong> appointment on Tuesday around 4 pm; asked whether their insurance card is accepted.</p>
                <p><strong style="color:var(--ink)">Done:</strong> booking request saved with name and mobile number.</p>
                <p style="padding:12px 14px;border-radius:12px;background:var(--mint)"><strong style="color:var(--ink)">Needs you:</strong> confirm the slot and the insurance card on WhatsApp.</p>
                <p class="muted" style="font-size:13px">Duration 2 min 41 s · Language: Arabic, then English · Transcript attached</p>
            </div>
        </div>
    </div>
</section>

<section class="section bg-mint-soft">
    <div class="container">
        <div class="section-head center" data-reveal>
            <span class="eyebrow">Questions</span>
            <h2 class="h2">About the AI Secretary</h2>
        </div>
        <div class="faq" data-reveal>
            @include('partials.faq-items', ['faqs' => [
                ['Can it book straight into my calendar?', 'Today aii collects complete booking requests and your team confirms them. Direct calendar booking is on our roadmap.'],
                ['Can I change what it says?', 'Yes. Update your hours, services, prices or rules at any time and aii uses the new details on the next call.'],
                ['What happens if many people call at once?', 'Each call is answered separately, so callers never hear a busy tone because another caller is on the line.'],
                ['Is there a contract?', 'Plans are monthly. Pay yearly and you get two months free.'],
            ]])
        </div>
    </div>
</section>

@include('partials.cta', ['ctaHeading' => 'Hear your AI Secretary answer for your business', 'ctaProduct' => 'ai-secretary'])
@endsection
