<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Mailgun;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Mailgun\MailgunService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Mailgun endpoint mappings against the current API docs.
 */
final class MailgunServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_domain_list_uses_current_v4_endpoint(): void
    {
        Http::fake([
            'https://api.mailgun.net/v4/domains*' => Http::response(['items' => []], 200),
        ]);

        $service = new MailgunService(apiKey: 'key-test', domain: 'mg.example.test');
        $service->listDomains(['limit' => 25, 'skip' => 10]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'GET'
                && $request->url() === 'https://api.mailgun.net/v4/domains?limit=25&skip=10';
        });
    }

    public function test_domain_detail_uses_current_v4_endpoint(): void
    {
        Http::fake([
            'https://api.mailgun.net/v4/domains/mg.example.test' => Http::response([
                'domain' => ['name' => 'mg.example.test', 'state' => 'active'],
                'sending_dns_records' => [],
            ], 200),
        ]);

        $service = new MailgunService(apiKey: 'key-test', domain: 'mg.example.test');
        $domain = $service->getDomain('mg.example.test');

        self::assertSame('mg.example.test', $domain['domain']['name']);
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'GET'
                && $request->url() === 'https://api.mailgun.net/v4/domains/mg.example.test';
        });
    }

    public function test_send_email_remains_on_v3_messages_endpoint(): void
    {
        Http::fake([
            'https://api.mailgun.net/v3/mg.example.test/messages' => Http::response(['id' => 'message-1'], 200),
        ]);

        $service = new MailgunService(apiKey: 'key-test', domain: 'mg.example.test');
        $service->sendEmail([
            'from' => 'Sender <sender@example.test>',
            'to' => ['recipient@example.test'],
            'subject' => 'Demo',
            'text' => 'Hello',
        ]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.mailgun.net/v3/mg.example.test/messages';
        });
    }
}
