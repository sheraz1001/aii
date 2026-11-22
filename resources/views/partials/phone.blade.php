@php
$script = [
    ['from' => 'caller', 'rtl' => true, 'text' => 'مرحبا، أبغى أحجز موعد عند الدكتور يوم الثلاثاء', 'card' => 0],
    ['from' => 'ai', 'rtl' => true, 'text' => 'أكيد! أي وقت يناسبك يوم الثلاثاء؟'],
    ['from' => 'caller', 'text' => 'Around 4 pm, please. Do you accept my insurance card?'],
    ['from' => 'ai', 'text' => "Most major cards are accepted. I've noted Tuesday at 4 pm, and the team will confirm on WhatsApp.", 'card' => 1],
    ['from' => 'caller', 'text' => 'Perfect, thank you.'],
    ['from' => 'ai', 'text' => "You're welcome. Have a lovely day!"],
];
@endphp
<div class="phone-stage" aria-label="Animation: aii automatically answers a call to a dental clinic, speaks Arabic and English, and sends the team a summary" role="img">
    <div class="phone-glow" aria-hidden="true"></div>

    <div class="float-card fc-1" aria-hidden="true">
        <span class="icon-tile"><x-icon name="globe" /></span>
        <div>Arabic detected<span>Replying in Gulf Arabic</span></div>
    </div>
    <div class="float-card fc-2" aria-hidden="true">
        <span class="icon-tile"><x-icon name="calendar" /></span>
        <div>Booking request saved<span>Tuesday · 4:00 pm</span></div>
    </div>
    <div class="float-card fc-3" aria-hidden="true">
        <span class="icon-tile"><x-icon name="mail" /></span>
        <div>Summary sent<span>To the clinic team</span></div>
    </div>

    <div class="phone" aria-hidden="true">
        <div class="screen" data-phone-sim data-script='@json($script, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS)'>
            <div class="scene is-active">
                <p class="call-label">INCOMING CALL</p>
                <div class="ring-wrap"><div class="avatar">+971</div></div>
                <p class="call-name">+971 50 ··· 4821</p>
                <p class="call-sub">Smile Dental · main line</p>
                <div class="answer-row"><span class="auto-answer"><i></i>aii is answering</span></div>
            </div>
            <div class="scene">
                <div class="live-head">
                    <span class="live-pill"><i></i>Answered by aii</span>
                    <span class="timer">00:00</span>
                </div>
                <div class="wave">@for ($i = 0; $i < 22; $i++)<b></b>@endfor</div>
                <p class="speaker"></p>
                <div class="transcript"></div>
            </div>
            <div class="scene">
                <div class="live-head">
                    <span class="live-pill" style="color:#B9BEE6"><i style="background:#8C93D8;box-shadow:none;animation:none"></i>Call ended</span>
                    <span class="timer">00:42</span>
                </div>
                <div class="summary-card">
                    <h4><x-icon name="check-circle" /> Call summary</h4>
                    <dl>
                        <div><dt>Wanted</dt><dd>Appointment on Tuesday around 4 pm; asked about insurance.</dd></div>
                        <div><dt>Done</dt><dd>Booking request saved with name and mobile number.</dd></div>
                        <div><dt>Needs you</dt><dd>Confirm the slot and the insurance card.</dd></div>
                    </dl>
                    <div class="sent-row"><x-icon name="mail" width="16" height="16" /> Sent to the clinic team</div>
                </div>
            </div>
        </div>
    </div>
</div>
