@extends('layouts.site', ['title' => 'Thank you'])

@section('content')
<section class="page-hero" style="padding:120px 0">
    <div class="container">
        <div class="section-head center" style="margin-bottom:0">
            <span class="icon-tile" data-reveal="zoom" style="width:72px;height:72px;border-radius:20px;background:var(--teal);color:#fff"><x-icon name="check" width="34" height="34" /></span>
            <h1 class="display" data-reveal style="--d:.1s">We'll be in touch soon</h1>
            <p class="lead" data-reveal style="--d:.2s">We've received your request and will contact you within one working day to arrange your demo.</p>
            <div class="btn-row" data-reveal style="--d:.3s;justify-content:center">
                <a class="btn" href="{{ route('ai-secretary') }}">Explore the AI Secretary</a>
                <a class="btn btn-ghost" href="{{ route('home') }}">Back to home</a>
            </div>
        </div>
    </div>
</section>
@endsection
