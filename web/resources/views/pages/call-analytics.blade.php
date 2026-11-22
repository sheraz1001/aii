@extends('layouts.site', ['title' => 'Call Analytics', 'description' => 'aii Call Analytics will transcribe your team\'s calls in English and Arabic and show what customers ask, which calls were missed and where sales slip. Join the waitlist.'])

@section('content')
@include('partials.service-soon', [
    'product' => 'call-analytics',
    'eyebrow' => 'Call Analytics',
    'heading' => 'See what happens on every sales call',
    'lead' => 'Call Analytics will transcribe your team\'s calls in English and Arabic and show you the questions customers ask, the calls that went unanswered and the follow-ups that slipped.',
    'visual' => 'visuals.analytics',
    'plansHeading' => 'Answers you can act on every week',
    'plans' => [
        ['file', 'Searchable transcripts', 'Find any call by name, number or topic.'],
        ['search', 'Top questions', 'Spot the questions your website or team should answer better.'],
        ['clock', 'Missed and late calls', 'See busy hours and calls that never got a call back.'],
        ['star', 'Quality checks', 'Check greetings, follow-up offers and the information shared on each call.'],
        ['users', 'Team view', 'Compare branches or team members fairly.'],
        ['mail', 'Weekly report', 'A short email with what changed and what to fix.'],
    ],
    'faqs' => [
        ['Which phone systems will it work with?', 'Calls that run through aii first, then common cloud phone systems. Tell us yours when you join the waitlist.'],
        ['Is it legal to record calls?', 'Callers must be told that calls are recorded. We will help you set up the right notice.'],
        ['When does it launch?', 'After the WhatsApp Agent. Join the waitlist to get early access.'],
    ],
])
@endsection
