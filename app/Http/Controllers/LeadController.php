<?php

namespace App\Http\Controllers;

use App\Mail\LeadReceivedMail;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LeadController extends Controller
{
    public const PRODUCTS = [
        'ai-secretary' => 'AI Secretary',
        'whatsapp-agent' => 'WhatsApp Agent',
        'website-chat' => 'Website Chat',
        'call-analytics' => 'Call Analytics',
    ];

    public function create(Request $request): View
    {
        return view('pages.demo', [
            'products' => self::PRODUCTS,
            'selectedProduct' => $request->query('product', 'ai-secretary'),
            'selectedPlan' => $request->query('plan'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Honeypot: real people never fill the hidden "website" field.
        if ($request->filled('website')) {
            return redirect()->route('demo.thanks');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'product' => ['nullable', 'in:'.implode(',', array_keys(self::PRODUCTS))],
            'plan' => ['nullable', 'string', 'max:40'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $lead = Lead::create([
            ...$data,
            'source' => $request->headers->get('referer'),
            'ip' => $request->ip(),
        ]);

        try {
            Mail::to(config('aii.sales_email'))->send(new LeadReceivedMail($lead));
        } catch (\Throwable $e) {
            Log::error('Lead email failed', ['lead' => $lead->id, 'error' => $e->getMessage()]);
        }

        return redirect()->route('demo.thanks');
    }

    public function thanks(): View
    {
        return view('pages.thanks');
    }
}
