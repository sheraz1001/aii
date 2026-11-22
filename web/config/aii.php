<?php

return [
    'company_name' => env('AII_COMPANY_NAME', 'aii.ae'),
    'contact_email' => env('AII_CONTACT_EMAIL', 'hello@aii.ae'),
    'sales_email' => env('AII_SALES_EMAIL', env('AII_CONTACT_EMAIL', 'hello@aii.ae')),
    // Demo line callers can ring to hear the AI. Leave empty until it is live.
    'demo_number' => env('AII_DEMO_NUMBER'),
    // WhatsApp number in international format without +, e.g. 971500000000
    'whatsapp' => env('AII_WHATSAPP'),
    // Shared secret the Python voice agent sends as a Bearer token
    'agent_token' => env('AII_AGENT_TOKEN'),

    'overage_aed' => 1.00,
    'landline_setup_aed' => 499,

    'plans' => [
        [
            'key' => 'starter', 'name' => 'Starter', 'monthly' => 199, 'yearly' => 166,
            'minutes' => 150, 'for' => 'Solo clinics, shops and freelancers',
            'features' => ['150 call minutes a month', '1 business number', 'English and Arabic', 'Messages and booking requests', 'Call summaries by email'],
        ],
        [
            'key' => 'business', 'name' => 'Business', 'monthly' => 499, 'yearly' => 416,
            'minutes' => 500, 'for' => 'Clinics, agencies and restaurants', 'popular' => true,
            'features' => ['500 call minutes a month', '2 business numbers', 'Transfer urgent calls to staff', 'Call recordings and transcripts', 'Priority onboarding'],
        ],
        [
            'key' => 'pro', 'name' => 'Pro', 'monthly' => 999, 'yearly' => 833,
            'minutes' => 1200, 'for' => 'Busy lines and multi-branch teams',
            'features' => ['1,200 call minutes a month', '5 business numbers', 'Routing by department', 'Custom greeting and voice', 'Dedicated account manager'],
        ],
        [
            'key' => 'enterprise', 'name' => 'Enterprise', 'monthly' => null, 'yearly' => null,
            'minutes' => null, 'for' => 'Hospitals, chains and large teams',
            'features' => ['Custom minute bundles', 'Unlimited numbers', 'Custom integrations', 'Service level agreement', 'Volume pricing'],
        ],
    ],
];
