{{-- Vars (all optional): $ctaHeading, $ctaText, $ctaButton, $ctaProduct --}}
<section class="section-sm">
    <div class="container">
        <div class="cta-band" data-reveal="zoom">
            <div class="cta-orb" aria-hidden="true"></div>
            <div style="display:grid;gap:16px">
                <h2 class="h2">{{ $ctaHeading ?? 'Give every caller a clear next step' }}</h2>
                <p class="lead">{{ $ctaText ?? 'See aii answer a call for your business in a 20-minute demo. We set it up with your own details.' }}</p>
            </div>
            <div class="btn-row">
                <a class="btn btn-light" href="{{ route('demo', ['product' => $ctaProduct ?? 'ai-secretary']) }}">{{ $ctaButton ?? 'Request a demo' }} <x-icon name="arrow" /></a>
                @if (config('aii.demo_number'))
                    <a class="btn btn-outline-light" href="tel:{{ config('aii.demo_number') }}">Hear a sample</a>
                @endif
            </div>
        </div>
    </div>
</section>
