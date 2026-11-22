<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title.' · aii.ae' : 'aii.ae · AI receptionist and AI agents for UAE businesses' }}</title>
    <meta name="description" content="{{ $description ?? 'aii answers your business calls in English and Arabic, takes messages and booking requests, and sends your team a summary of every call.' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#090D38">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="aii.ae">
    <meta property="og:title" content="{{ $title ?? 'AI receptionist for UAE businesses' }}">
    <meta property="og:description" content="{{ $description ?? 'Answer every call in English and Arabic, 24 hours a day.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">

    <script type="application/ld+json">
    {!! json_encode(['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => 'aii.ae', 'url' => url('/'), 'logo' => asset('img/logo.png'), 'email' => config('aii.contact_email')], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @stack('head')
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
@include('partials.header')

<main id="main">
    @yield('content')
</main>

@include('partials.footer')
<script src="{{ asset('js/site.js') }}?v={{ filemtime(public_path('js/site.js')) }}" defer></script>
</body>
</html>
