<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MailerSend;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\MailerSend\MailerSendService;
use OpenCompany\Integrations\MailerSend\MailerSendToolProvider;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendCreateInboundRoute;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendCreateWebhook;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetAnalyticsByDate;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendSendBulkEmail;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for MailerSend API V1 endpoint mapping.
 */
final class MailerSendServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_mailersend_endpoints(): void
    {
        Http::fake([
            'https://api.mailersend.test/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new MailerSendService('token_test', 'https://api.mailersend.test/v1');

        $service->sendEmail(
            ['email' => 'noreply@example.test', 'name' => 'Example'],
            [['email' => 'ada@example.test']],
            'Welcome',
            '<p>Hello</p>',
            'Hello',
            ['template_id' => 'tpl_123', 'tags' => ['onboarding']]
        );
        $service->sendBulkEmail([['from' => ['email' => 'noreply@example.test'], 'to' => [['email' => 'ada@example.test']], 'subject' => 'Bulk']]);
        $service->apiGet('/activity/domain_123', ['date_from' => 1778112000, 'date_to' => 1778198400, 'event' => ['sent', 'delivered']]);
        $service->apiPut('/domains/domain_123/settings', ['track_clicks' => true]);
        $service->apiDelete('/webhooks/webhook_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer token_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mailersend.test/v1/email' && $request['template_id'] === 'tpl_123' && $request['tags'] === ['onboarding']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mailersend.test/v1/bulk-email');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.mailersend.test/v1/activity/domain_123?') && str_contains($request->url(), 'event%5B%5D=sent') && str_contains($request->url(), 'event%5B%5D=delivered'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.mailersend.test/v1/domains/domain_123/settings' && $request['track_clicks'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.mailersend.test/v1/webhooks/webhook_123');
    }

    public function test_tools_delegate_to_expanded_endpoint_surface(): void
    {
        Http::fake([
            'https://api.mailersend.test/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new MailerSendService('token_test', 'https://api.mailersend.test/v1');

        self::assertNull((new MailerSendSendBulkEmail($service))->execute([
            'messages' => [
                [
                    'from' => ['email' => 'noreply@example.test'],
                    'to' => [['email' => 'ada@example.test']],
                    'subject' => 'Bulk',
                ],
            ],
        ])->error);

        self::assertNull((new MailerSendGetAnalyticsByDate($service))->execute([
            'date_from' => 1778112000,
            'date_to' => 1778198400,
            'event' => ['sent'],
            'group_by' => 'days',
        ])->error);

        self::assertNull((new MailerSendCreateWebhook($service))->execute([
            'domain_id' => 'domain_123',
            'name' => 'Events',
            'url' => 'https://example.test/hooks/mailersend',
            'events' => ['activity.sent'],
            'enabled' => true,
        ])->error);

        self::assertNull((new MailerSendCreateInboundRoute($service))->execute([
            'domain_id' => 'domain_123',
            'name' => 'Replies',
            'domain_enabled' => true,
            'inbound_domain' => 'inbound.example.test',
            'inbound_priority' => 10,
            'catch_filter' => ['type' => 'catch_all', 'filters' => []],
            'match_filter' => ['type' => 'match_all', 'filters' => []],
            'forwards' => [['type' => 'webhook', 'value' => 'https://example.test/inbound']],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.mailersend.test/v1/analytics/date?') && str_contains($request->url(), 'event%5B%5D=sent'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mailersend.test/v1/webhooks' && $request['domain_id'] === 'domain_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mailersend.test/v1/inbound' && $request['inbound_domain'] === 'inbound.example.test');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://api.mailersend.com/v1/domains*' => Http::response(['data' => []], 200),
        ]);

        $provider = new MailerSendToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.mailersend.com/api/v1/', $provider->integrationMeta()['docs_url']);
        self::assertSame(47, count($tools));
        self::assertArrayHasKey('mailer_send_send_bulk_email', $tools);
        self::assertArrayHasKey('mailer_send_get_analytics_by_date', $tools);
        self::assertArrayHasKey('mailer_send_get_domain_dns_records', $tools);
        self::assertArrayHasKey('mailer_send_list_webhooks', $tools);
        self::assertArrayHasKey('mailer_send_create_inbound_route', $tools);
        self::assertArrayHasKey('mailer_send_create_smtp_user', $tools);

        self::assertTrue($provider->testConnection([
            'api_token' => 'token_test',
        ])['success']);
    }
}
