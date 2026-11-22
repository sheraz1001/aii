@php
$products = [
    ['route' => 'ai-secretary', 'icon' => 'phone', 'name' => 'AI Secretary', 'text' => 'Answers your business calls in English and Arabic.'],
    ['route' => 'whatsapp-agent', 'icon' => 'chat', 'name' => 'WhatsApp Agent', 'text' => 'Replies to WhatsApp enquiries around the clock.', 'soon' => true],
    ['route' => 'website-chat', 'icon' => 'window', 'name' => 'Website Chat', 'text' => 'A chat assistant that knows your business.', 'soon' => true],
    ['route' => 'call-analytics', 'icon' => 'chart', 'name' => 'Call Analytics', 'text' => 'See what callers ask and where sales slip.', 'soon' => true],
];
@endphp
<header class="site-header">
    <div class="container nav">
        <a class="brand" href="{{ route('home') }}" aria-label="aii.ae home">
            <img src="{{ asset('img/logo-480.webp') }}" alt="aii.ae" width="102" height="34">
        </a>

        <nav aria-label="Main">
            <ul class="nav-links">
                <li class="has-menu">
                    <button class="nav-link" type="button" aria-haspopup="true">Products <x-icon name="chevron" /></button>
                    <div class="menu">
                        @foreach ($products as $p)
                            <a href="{{ route($p['route']) }}">
                                <span class="icon-tile"><x-icon :name="$p['icon']" /></span>
                                <span><strong>{{ $p['name'] }}@if (!empty($p['soon']))<span class="badge-soon">Soon</span>@endif</strong>{{ $p['text'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </li>
                <li><a class="nav-link" href="{{ route('ai-secretary') }}" @if (request()->routeIs('ai-secretary')) aria-current="page" @endif>AI Secretary</a></li>
                <li><a class="nav-link" href="{{ route('home') }}#industries">Industries</a></li>
                <li><a class="nav-link" href="{{ route('pricing') }}" @if (request()->routeIs('pricing')) aria-current="page" @endif>Pricing</a></li>
                <li><a class="nav-link" href="{{ route('home') }}#faq">FAQ</a></li>
            </ul>
        </nav>

        <div class="nav-cta">
            @if (config('aii.demo_number'))
                <a class="btn btn-ghost btn-sm" href="tel:{{ config('aii.demo_number') }}">Hear a sample</a>
            @endif
            <a class="btn btn-sm" href="{{ route('demo') }}">Request a demo</a>
            <button class="menu-toggle" type="button" aria-label="Open menu" aria-expanded="false"><span></span><span></span><span></span></button>
        </div>
    </div>
</header>
