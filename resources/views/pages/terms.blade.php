@extends('layouts.site', ['title' => 'Terms of service'])

@section('content')
<section class="page-hero" style="padding-bottom:40px">
    <div class="container prose">
        <span class="eyebrow">Legal</span>
        <h1 class="display" style="margin-top:16px">Terms of service</h1>
        <p class="muted" style="margin-top:16px">Draft for review by a UAE lawyer before launch. Last updated {{ date('j F Y') }}.</p>
    </div>
</section>
<section class="section" style="padding-top:24px">
    <div class="container prose">
        <h2>The service</h2>
        <p>aii provides AI agents that answer calls and messages for businesses using information the business supplies. The business is responsible for the accuracy of that information and for following up on messages and booking requests.</p>
        <h2>Acceptable use</h2>
        <p>You may not use aii for unsolicited marketing calls, to mislead callers, or for any unlawful purpose. Outbound calling is not part of the service.</p>
        <h2>AI limitations</h2>
        <p>AI agents can make mistakes. aii does not give medical, legal or financial advice and should not be used for emergencies. Callers with emergencies should contact emergency services.</p>
        <h2>Plans and payment</h2>
        <p>Plans are billed monthly or yearly in advance in AED, plus VAT. Extra minutes are billed at the published rate. You may cancel at any time; access continues until the end of the paid period.</p>
        <h2>Liability</h2>
        <p>To the extent permitted by law, our total liability is limited to the fees you paid in the three months before the claim.</p>
        <h2>Governing law</h2>
        <p>These terms are governed by the laws of the United Arab Emirates as applied in the Emirate of Dubai.</p>
    </div>
</section>
@endsection
