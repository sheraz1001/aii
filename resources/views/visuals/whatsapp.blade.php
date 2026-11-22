@php
$lines = [
    ['from' => 'in', 'text' => 'Hi, is the 2-bedroom in JVC still available?'],
    ['from' => 'out', 'text' => 'Hi! Yes, it is. Are you looking to rent or buy, and what is your budget?'],
    ['from' => 'in', 'text' => 'Rent, around 95k a year. Can I see it this weekend?'],
    ['from' => 'out', 'text' => "Great. I'll ask our agent Omar to confirm a Saturday viewing with you."],
    ['from' => 'in', 'rtl' => true, 'text' => 'ممتاز، شكراً'],
    ['from' => 'out', 'rtl' => true, 'text' => 'العفو! عمر بيتواصل معك قريباً.'],
];
@endphp
<div class="phone-stage" style="min-height:600px">
    <div class="phone-glow" aria-hidden="true"></div>
    <div class="phone" style="height:600px" role="img" aria-label="Animation: a WhatsApp enquiry about a rental apartment answered by the aii agent">
        <div class="screen" style="background:#F3F5FA;color:var(--ink)">
            <div style="position:absolute;top:0;left:0;right:0;padding:56px 18px 12px;background:var(--midnight);color:#fff;display:flex;align-items:center;gap:10px;z-index:2">
                <img src="{{ asset('favicon.svg') }}" alt="" width="34" height="34" style="border-radius:10px">
                <div style="line-height:1.25"><strong style="font-size:14px">Marina Homes</strong><br><span style="font-size:12px;color:#7FF0D9">Replies instantly</span></div>
            </div>
            <div class="chat" data-chat-sim='@json($lines, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS)' style="position:absolute;inset:110px 0 0;min-height:0;padding:16px 14px 24px"></div>
        </div>
    </div>
</div>
