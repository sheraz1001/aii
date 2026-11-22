@extends('layouts.site', ['title' => 'Website Chat', 'description' => 'aii Website Chat will answer visitor questions on your website in English and Arabic and capture enquiries for your team. Join the waitlist.'])

@section('content')
@include('partials.service-soon', [
    'product' => 'website-chat',
    'eyebrow' => 'Website Chat',
    'heading' => 'Turn website visitors into enquiries',
    'lead' => 'A chat assistant on your website that will answer questions about your services, prices and hours, and collect contact details when a visitor is ready.',
    'visual' => 'visuals.webchat',
    'plansHeading' => 'A helpful answer on every page',
    'plans' => [
        ['window', 'One line of code', 'Add the chat to any website, including WordPress and Shopify.'],
        ['globe', 'English and Arabic', 'Right-to-left Arabic support built in.'],
        ['message', 'Answers from your content', 'Uses your business details and website pages, nothing invented.'],
        ['mail', 'Enquiries to your inbox', 'Sends each new enquiry to your team with the chat attached.'],
        ['settings', 'Your brand', 'Matches your colours, logo and greeting.'],
        ['chart', 'Top questions', 'Shows what visitors ask most, so you can improve your pages.'],
    ],
    'faqs' => [
        ['Will it slow down my website?', 'The chat loads after your page, so it does not delay what visitors see first.'],
        ['When does it launch?', 'Early-access businesses get it first. Join the waitlist and we will be in touch.'],
        ['Can I use it with the AI Secretary?', 'Yes. Both share your business details, so you only set things up once.'],
    ],
])
@endsection
