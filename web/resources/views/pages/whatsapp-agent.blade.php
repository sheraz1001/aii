@extends('layouts.site', ['title' => 'WhatsApp Agent', 'description' => 'The aii WhatsApp Agent will reply to WhatsApp enquiries in English and Arabic and pass qualified leads to your team. Join the waitlist.'])

@section('content')
@include('partials.service-soon', [
    'product' => 'whatsapp-agent',
    'eyebrow' => 'WhatsApp Agent',
    'heading' => 'Reply to every WhatsApp message in seconds',
    'lead' => 'Most UAE customers message before they call. The WhatsApp Agent will answer their questions in English or Arabic, collect their details and hand warm leads to your team.',
    'visual' => 'visuals.whatsapp',
    'plansHeading' => 'Your fastest salesperson on WhatsApp',
    'plans' => [
        ['bolt', 'Instant replies', 'Answers enquiries at 2 am with the same care as 2 pm.'],
        ['globe', 'English and Arabic', 'Replies in the language the customer writes in.'],
        ['users', 'Lead qualification', 'Asks your questions, such as budget, area or date, before passing the lead on.'],
        ['calendar', 'Booking requests', 'Collects preferred times and sends them to your team to confirm.'],
        ['transfer', 'Human handover', 'Hands the chat to your staff whenever a person should take over.'],
        ['file', 'Shared knowledge', 'Uses the same business details as your AI Secretary.'],
    ],
    'faqs' => [
        ['Will it use my existing WhatsApp number?', 'It will work with a WhatsApp Business API number. We will help you set one up or move your business number across.'],
        ['When does it launch?', 'We are onboarding early-access businesses first. Join the waitlist and we will contact you with dates.'],
        ['Can my team still reply themselves?', 'Yes. Your team can take over any conversation at any time.'],
    ],
])
@endsection
