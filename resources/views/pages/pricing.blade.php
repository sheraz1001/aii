@extends('layouts.site', ['title' => 'Pricing', 'description' => 'aii AI Secretary plans from AED 199 a month. Monthly or yearly billing, prices in AED excluding VAT.'])

@section('content')
<section class="page-hero" style="padding-bottom:48px">
    <div class="hero-dots" aria-hidden="true"></div>
    <div class="container">
        <div class="section-head center" style="margin-bottom:32px">
            <span class="eyebrow" data-reveal>Pricing</span>
            <h1 class="display" data-reveal style="--d:.08s">Plans that cost less than a missed customer</h1>
            <p class="lead" data-reveal style="--d:.16s">Every plan includes English and Arabic, booking requests, and call summaries. Prices in AED, excluding 5% VAT.</p>
            <div data-reveal style="--d:.24s;display:flex;align-items:center;gap:12px;flex-wrap:wrap;justify-content:center">
                <div class="toggle" data-billing role="group" aria-label="Billing period">
                    <button type="button" data-period="monthly" aria-pressed="true">Monthly</button>
                    <button type="button" data-period="yearly" aria-pressed="false">Yearly</button>
                </div>
                <span class="save">2 months free on yearly</span>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:24px">
    <div class="container">
        <div class="price-grid">
            @foreach (config('aii.plans') as $i => $plan)
                <div class="price {{ !empty($plan['popular']) ? 'featured' : '' }}" data-reveal style="--d:{{ $i * 0.08 }}s">
                    @if (!empty($plan['popular']))<span class="popular">Most popular</span>@endif
                    <h2 class="h3">{{ $plan['name'] }}</h2>
                    @if ($plan['monthly'])
                        <p class="amount"><span data-monthly="{{ $plan['monthly'] }}" data-yearly="{{ $plan['yearly'] }}">{{ number_format($plan['monthly']) }}</span> <small data-period-note>AED / month</small></p>
                    @else
                        <p class="amount">Custom <small>volume pricing</small></p>
                    @endif
                    <p>{{ $plan['for'] }}</p>
                    <ul class="checklist">
                        @foreach ($plan['features'] as $f)
                            <li><x-icon name="check" /><span>{{ $f }}</span></li>
                        @endforeach
                    </ul>
                    <a class="btn {{ !empty($plan['popular']) ? 'btn-light' : 'btn-ghost' }}" href="{{ route('demo', ['plan' => $plan['key']]) }}">{{ $plan['monthly'] ? 'Request a demo' : 'Talk to sales' }}</a>
                </div>
            @endforeach
        </div>

        <div class="grid-3" style="margin-top:56px">
            <div class="card" data-reveal><span class="icon-tile"><x-icon name="clock" /></span><h3 class="h3">Extra minutes</h3><p>AED {{ number_format(config('aii.overage_aed'), 2) }} per minute after your plan's minutes. We email you before you reach your limit.</p></div>
            <div class="card" data-reveal style="--d:.08s"><span class="icon-tile"><x-icon name="phone" /></span><h3 class="h3">Mobile forwarding</h3><p>Free setup. Your mobile plan's local call rate applies to forwarded calls.</p></div>
            <div class="card" data-reveal style="--d:.16s"><span class="icon-tile"><x-icon name="settings" /></span><h3 class="h3">Landline connection</h3><p>AED {{ config('aii.landline_setup_aed') }} one-time to connect your e&amp; or du landline directly.</p></div>
        </div>
    </div>
</section>

<section class="section bg-mint-soft">
    <div class="container">
        <div class="section-head center" data-reveal><span class="eyebrow">Billing questions</span><h2 class="h2">Good to know</h2></div>
        <div class="faq" data-reveal>
            @include('partials.faq-items', ['faqs' => [
                ['What counts as a minute?', 'Time aii spends on a call, rounded up to the next minute per call. Calls transferred to your team stop counting once transferred.'],
                ['Can I change plans?', 'Yes, upgrade or downgrade at any time. Changes apply from your next billing date.'],
                ['Do unused minutes roll over?', 'No. Minutes reset each month, so choose the plan that matches a typical month.'],
                ['How do I pay?', 'By card, monthly or yearly. VAT invoices are issued for every payment.'],
            ]])
        </div>
    </div>
</section>

@include('partials.cta')
@endsection
