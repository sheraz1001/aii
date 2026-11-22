@extends('layouts.site', ['title' => 'Request a demo', 'description' => 'Request a free demo of the aii AI Secretary, set up with your own business details.'])

@section('content')
<section class="page-hero">
    <div class="hero-dots" aria-hidden="true"></div>
    <div class="container split" style="align-items:start">
        <div style="display:grid;gap:24px;padding-top:24px">
            <span class="eyebrow" data-reveal>Request a demo</span>
            <h1 class="display" data-reveal style="--d:.08s">Hear aii answer for your business</h1>
            <p class="lead" data-reveal style="--d:.16s">Tell us a little about your business. We'll set up a demo receptionist with your details and call you to walk through it.</p>
            <ul class="checklist" data-reveal style="--d:.24s">
                <li><x-icon name="check-circle" /><span>A 20-minute call at a time that suits you</span></li>
                <li><x-icon name="check-circle" /><span>A demo set up with your own services and hours</span></li>
                <li><x-icon name="check-circle" /><span>Clear pricing and next steps, no obligation</span></li>
            </ul>
            <p class="muted" data-reveal style="--d:.3s">Prefer email? Write to <a href="mailto:{{ config('aii.contact_email') }}">{{ config('aii.contact_email') }}</a>.</p>
        </div>

        <div class="form-card" data-reveal="right">
            <form method="POST" action="{{ route('demo.store') }}" novalidate>
                @csrf
                <div class="hp" aria-hidden="true"><label for="website">Website</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
                <div class="form-grid">
                    <div class="field">
                        <label for="name">Your name</label>
                        <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name">
                        @error('name')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="field">
                        <label for="company">Business name</label>
                        <input id="company" name="company" value="{{ old('company') }}" autocomplete="organization">
                    </div>
                    <div class="field">
                        <label for="email">Work email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="field">
                        <label for="phone">Mobile number</label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="+971 5X XXX XXXX" autocomplete="tel">
                    </div>
                    <div class="field">
                        <label for="product">Interested in</label>
                        <select id="product" name="product">
                            @foreach ($products as $key => $label)
                                <option value="{{ $key }}" @selected(old('product', $selectedProduct) === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label for="plan">Plan</label>
                        <select id="plan" name="plan">
                            <option value="">Not sure yet</option>
                            @foreach (config('aii.plans') as $plan)
                                <option value="{{ $plan['key'] }}" @selected(old('plan', $selectedPlan) === $plan['key'])>{{ $plan['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field full">
                        <label for="message">What should your receptionist handle?</label>
                        <textarea id="message" name="message" placeholder="For example: clinic appointments, after-hours enquiries, Arabic-speaking callers">{{ old('message') }}</textarea>
                    </div>
                    <div class="field full">
                        <button class="btn" type="submit" style="width:100%">Request a demo <x-icon name="arrow" /></button>
                        <p class="muted" style="font-size:13px">We use your details only to arrange the demo. See our <a href="{{ route('privacy') }}">privacy policy</a>.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
