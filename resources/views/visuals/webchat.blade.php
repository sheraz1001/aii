@php
$lines = [
    ['from' => 'in', 'text' => 'Do you offer teeth whitening?'],
    ['from' => 'out', 'text' => 'Yes. Whitening starts from AED 1,200, and the dentist confirms the final price after a check-up.'],
    ['from' => 'in', 'text' => 'Are you open on Friday?'],
    ['from' => 'out', 'text' => 'On Fridays we are open 4 pm to 9 pm. Would you like the team to call you to book?'],
    ['from' => 'in', 'text' => 'Yes please, 050 123 4567'],
    ['from' => 'out', 'text' => 'Thank you! The team will call you today.'],
];
@endphp
<div class="panel" role="img" aria-label="Animation: a website visitor chats with the aii assistant about teeth whitening">
    <div class="panel-head"><span class="dots"><i></i><i></i><i></i></span> yourwebsite.ae</div>
    <div class="webchat-grid" style="display:grid;grid-template-columns:1fr 300px;min-height:460px">
        <div style="padding:28px;display:grid;gap:14px;align-content:start;background:var(--mint-2)" aria-hidden="true">
            <div style="height:16px;width:60%;border-radius:8px;background:#D7EFE9"></div>
            <div style="height:36px;width:85%;border-radius:10px;background:#C6E9E0"></div>
            <div style="height:12px;width:90%;border-radius:6px;background:#E1F3EF"></div>
            <div style="height:12px;width:76%;border-radius:6px;background:#E1F3EF"></div>
            <div style="height:120px;border-radius:16px;background:#D7EFE9;margin-top:8px"></div>
            <div style="height:12px;width:70%;border-radius:6px;background:#E1F3EF"></div>
        </div>
        <div style="border-left:1px solid var(--line);display:flex;flex-direction:column;background:#fff">
            <div style="padding:14px 16px;background:var(--midnight);color:#fff;display:flex;align-items:center;gap:10px">
                <img src="{{ asset('favicon.svg') }}" alt="" width="28" height="28" style="border-radius:8px">
                <div style="line-height:1.2"><strong style="font-size:13px">Ask Smile Dental</strong><br><span style="font-size:11px;color:#7FF0D9">Online now</span></div>
            </div>
            <div class="chat" data-chat-sim='@json($lines, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS)' style="flex:1;min-height:0;padding:14px;font-size:13px"></div>
            <div class="chat-input"><span>Type your message…</span></div>
        </div>
    </div>
</div>
