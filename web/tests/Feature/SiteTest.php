<?php

namespace Tests\Feature;

use App\Mail\CallSummaryMail;
use App\Mail\LeadReceivedMail;
use App\Models\Business;
use App\Models\Call;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    public static function pages(): array
    {
        return array_map(fn ($p) => [$p], ['/', '/ai-secretary', '/whatsapp-agent', '/website-chat', '/call-analytics', '/pricing', '/request-a-demo', '/request-a-demo/thank-you', '/privacy', '/terms', '/sitemap.xml']);
    }

    #[DataProvider('pages')]
    public function test_page_loads(string $path): void
    {
        $this->get($path)->assertOk();
    }

    public function test_demo_request_is_saved_and_emailed(): void
    {
        Mail::fake();
        $this->post('/request-a-demo', ['name' => 'Aisha', 'email' => 'aisha@example.com', 'product' => 'ai-secretary'])
            ->assertRedirect(route('demo.thanks'));
        $this->assertDatabaseHas('leads', ['email' => 'aisha@example.com']);
        Mail::assertSent(LeadReceivedMail::class);
    }

    public function test_demo_request_validates(): void
    {
        $this->post('/request-a-demo', ['name' => '', 'email' => 'nope'])->assertSessionHasErrors(['name', 'email']);
    }

    public function test_honeypot_blocks_bots(): void
    {
        $this->post('/request-a-demo', ['name' => 'Bot', 'email' => 'bot@example.com', 'website' => 'spam'])->assertRedirect();
        $this->assertSame(0, Lead::count());
    }

    public function test_agent_api_requires_token(): void
    {
        config(['aii.agent_token' => 'secret']);
        $this->getJson('/api/agent/business?number=971400000000')->assertUnauthorized();
    }

    public function test_agent_can_load_business_and_report_call(): void
    {
        Mail::fake();
        config(['aii.agent_token' => 'secret']);
        $b = Business::create(['name' => 'Smile Dental', 'phone_number' => '+97143334444', 'owner_email' => 'owner@example.com', 'languages' => ['English', 'Arabic']]);
        $h = ['Authorization' => 'Bearer secret'];

        $this->getJson('/api/agent/business?number=%2B971%204%20333%204444', $h)
            ->assertOk()->assertJsonPath('data.name', 'Smile Dental');
        $this->getJson('/api/agent/business?number=971500000000', $h)->assertNotFound();

        $this->postJson('/api/agent/calls', [
            'business_id' => $b->id, 'caller_number' => '+971501234567', 'called_number' => '+97143334444',
            'started_at' => time() - 90, 'ended_at' => time(), 'duration_seconds' => 90,
            'transcript' => [['role' => 'user', 'text' => 'Hello']],
            'messages' => [['caller_name' => 'Ali', 'callback_number' => '0501234567', 'message' => 'Book Tuesday', 'urgent' => true]],
            'summary' => "Wanted: booking\nDone: saved\nNeeds you: confirm",
        ], $h)->assertCreated();

        $this->assertSame(1, Call::count());
        Mail::assertSent(CallSummaryMail::class, fn ($m) => $m->hasTo('owner@example.com'));
    }
}
