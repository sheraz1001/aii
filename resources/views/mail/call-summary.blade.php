<div style="font-family:Arial,Helvetica,sans-serif;color:#090D38;font-size:15px;line-height:1.6;max-width:600px">
    <h2 style="margin:0 0 4px">{{ $call->business?->name }} · new call</h2>
    <p style="margin:0 0 16px;color:#5A5F80">
        From {{ $call->caller_number ?: 'unknown number' }} ·
        {{ $call->started_at?->timezone('Asia/Dubai')->format('j M Y, g:i a') }} ·
        {{ intdiv($call->duration_seconds, 60) }} min {{ $call->duration_seconds % 60 }} s
    </p>

    @if ($call->summary)
        <div style="background:#E5F7F3;border-radius:12px;padding:14px 16px;margin-bottom:16px">{!! nl2br(e($call->summary)) !!}</div>
    @endif

    @foreach ($call->messages ?? [] as $m)
        <div style="border:1px solid #E3E6EF;border-radius:12px;padding:12px 14px;margin-bottom:10px">
            @if (!empty($m['urgent']))<strong style="color:#B42318">URGENT · </strong>@endif
            <strong>{{ $m['caller_name'] ?? 'Caller' }}</strong> · {{ $m['callback_number'] ?? '' }}<br>
            {{ $m['message'] ?? '' }}
        </div>
    @endforeach

    @if ($call->transferred_to)
        <p>Call transferred to {{ $call->transferred_to }}.</p>
    @endif

    <h3 style="margin:24px 0 8px;font-size:15px">Transcript</h3>
    @foreach ($call->transcript ?? [] as $line)
        <p style="margin:0 0 6px"><strong>{{ ($line['role'] ?? '') === 'assistant' ? 'aii' : 'Caller' }}:</strong> {{ $line['text'] ?? '' }}</p>
    @endforeach
    <p style="color:#5A5F80;font-size:12px;margin-top:24px">Sent by aii.ae</p>
</div>
