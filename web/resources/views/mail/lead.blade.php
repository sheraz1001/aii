<div style="font-family:Arial,Helvetica,sans-serif;color:#090D38;font-size:15px;line-height:1.6">
    <h2 style="margin:0 0 12px">New demo request</h2>
    <table cellpadding="6" style="border-collapse:collapse">
        <tr><td><strong>Name</strong></td><td>{{ $lead->name }}</td></tr>
        <tr><td><strong>Business</strong></td><td>{{ $lead->company ?: '—' }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $lead->email }}</td></tr>
        <tr><td><strong>Phone</strong></td><td>{{ $lead->phone ?: '—' }}</td></tr>
        <tr><td><strong>Product</strong></td><td>{{ \App\Http\Controllers\LeadController::PRODUCTS[$lead->product] ?? '—' }}</td></tr>
        <tr><td><strong>Plan</strong></td><td>{{ $lead->plan ?: 'Not sure yet' }}</td></tr>
    </table>
    @if ($lead->message)
        <p style="margin-top:16px"><strong>Message</strong><br>{!! nl2br(e($lead->message)) !!}</p>
    @endif
    <p style="color:#5A5F80;font-size:13px">Received {{ $lead->created_at->timezone('Asia/Dubai')->format('j M Y, g:i a') }} (Dubai time)</p>
</div>
