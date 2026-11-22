<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="{{ asset('img/logo-white-480.webp') }}" alt="aii.ae" width="102" height="34" >
                <p>AI receptionist and AI agents for businesses in the United Arab Emirates. Every caller gets a clear next step.</p>
            </div>
            <div>
                <h4>Products</h4>
                <ul>
                    <li><a href="{{ route('ai-secretary') }}">AI Secretary</a></li>
                    <li><a href="{{ route('whatsapp-agent') }}">WhatsApp Agent</a></li>
                    <li><a href="{{ route('website-chat') }}">Website Chat</a></li>
                    <li><a href="{{ route('call-analytics') }}">Call Analytics</a></li>
                </ul>
            </div>
            <div>
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('pricing') }}">Pricing</a></li>
                    <li><a href="{{ route('demo') }}">Request a demo</a></li>
                    <li><a href="mailto:{{ config('aii.contact_email') }}">{{ config('aii.contact_email') }}</a></li>
                    @if (config('aii.whatsapp'))
                        <li><a href="https://wa.me/{{ config('aii.whatsapp') }}" rel="noopener">WhatsApp us</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <h4>Legal</h4>
                <ul>
                    <li><a href="{{ route('privacy') }}">Privacy policy</a></li>
                    <li><a href="{{ route('terms') }}">Terms of service</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} {{ config('aii.company_name') }}. All rights reserved.</span>
            <span>Dubai, United Arab Emirates</span>
        </div>
    </div>
</footer>
