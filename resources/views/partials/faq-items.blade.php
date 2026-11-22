@php
$faqs = $faqs ?? [
    ['Do my customers need a new number?', 'No. Your customers keep calling the number they already know. Mobile numbers forward calls to aii with a short dial code, and office landlines on e& or du can be connected directly.'],
    ['What if the caller asks something aii doesn\'t know?', 'aii only answers from the details you give it. If it doesn\'t know, it says so, takes a message and, if you allow it, transfers the call to your team.'],
    ['Which languages does aii speak?', 'English and Arabic, including Gulf Arabic. It replies in the language the caller uses and can switch during the call.'],
    ['Do callers know they are speaking to an AI?', 'Yes. Every call starts with a short notice that the caller is speaking with an AI assistant and that the call may be recorded.'],
    ['Can I turn it off?', 'Any time. Cancel call forwarding on your phone, or pause aii from your account, and calls ring your team as before.'],
    ['How long does setup take?', 'We prepare your receptionist from a short form and test it with you before it goes live on your number.'],
];
@endphp
@foreach ($faqs as [$q, $a])
    <details>
        <summary>{{ $q }} <i aria-hidden="true"></i></summary>
        <p class="answer">{{ $a }}</p>
    </details>
@endforeach
