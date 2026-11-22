@extends('layouts.site', ['title' => 'Privacy policy'])

@section('content')
<section class="page-hero" style="padding-bottom:40px">
    <div class="container prose">
        <span class="eyebrow">Legal</span>
        <h1 class="display" style="margin-top:16px">Privacy policy</h1>
        <p class="muted" style="margin-top:16px">Draft for review by a UAE lawyer before launch. Last updated {{ date('j F Y') }}.</p>
    </div>
</section>
<section class="section" style="padding-top:24px">
    <div class="container prose">
        <h2>Who we are</h2>
        <p>aii.ae is operated by {{ config('aii.company_name') }}, Dubai, United Arab Emirates. Contact us at <a href="mailto:{{ config('aii.contact_email') }}">{{ config('aii.contact_email') }}</a>.</p>
        <h2>Information we collect</h2>
        <p>When you request a demo we collect your name, business name, email, phone number and message. When our AI Secretary answers calls for a customer, it processes the caller's phone number, the conversation transcript and any details the caller shares, on behalf of that customer.</p>
        <h2>How we use it</h2>
        <p>To arrange demos and provide our services; to deliver call summaries and transcripts to the business that was called; to keep our services secure; and to meet legal obligations. We do not sell personal data.</p>
        <h2>Callers</h2>
        <p>Every call answered by aii begins with a notice that the caller is speaking with an AI assistant and that the call may be recorded. The business that was called controls the call data, and requests about it should be sent to that business.</p>
        <h2>Service providers</h2>
        <p>We use trusted providers for telephony, speech recognition, voice generation, AI language processing, hosting and email. They process data only to provide their services to us.</p>
        <h2>Retention</h2>
        <p>Demo requests are kept for up to 24 months. Call data is kept for as long as the customer's plan and settings require, then deleted.</p>
        <h2>Your rights</h2>
        <p>Under the UAE Personal Data Protection Law you may ask to access, correct or delete your personal data. Email us and we will respond within 30 days.</p>
    </div>
</section>
@endsection
