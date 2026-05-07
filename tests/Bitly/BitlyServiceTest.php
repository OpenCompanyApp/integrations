<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Bitly;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\Integrations\Bitly\BitlyToolProvider;
use OpenCompany\Integrations\Bitly\Tools\BitlyApiGet;
use OpenCompany\Integrations\Bitly\Tools\BitlyCreateQrCode;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetClickSummary;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Bitly API v4 endpoint coverage.
 */
final class BitlyServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_link_analytics_qr_webhook_and_generic_endpoints(): void
    {
        Http::fake([
            'https://api-ssl.bitly.test/v4/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new BitlyService('bitly_test', 'https://api-ssl.bitly.test/v4');

        $service->shortenLink('https://example.test/long');
        $service->createBitlink('https://example.test/landing', 'Campaign', ['campaign']);
        $service->getLink('bit.ly/abc123');
        $service->updateLink('bit.ly/abc123', ['title' => 'Updated']);
        $service->expandBitlink('bit.ly/abc123');
        $service->addCustomBitlink('links.example.test/campaign', 'links.example.test/abc123');
        $service->getClicks('bit.ly/abc123', 'day', 30);
        $service->getClickSummary('bit.ly/abc123', ['unit' => 'day']);
        $service->getClickCountries('bit.ly/abc123', ['size' => 10]);
        $service->getClickReferrers('bit.ly/abc123', ['size' => 10]);
        $service->listGroups();
        $service->getGroup('group_guid');
        $service->listGroupBitlinks('group_guid', ['size' => 25]);
        $service->createQrCode(['destination' => ['bitlink_id' => 'bit.ly/abc123']]);
        $service->getQrCode('qr_123');
        $service->listOrganizationWebhooks('org_guid');
        $service->createOrganizationWebhook('org_guid', ['url' => 'https://example.test/webhook']);
        $service->getCurrentUser();
        $service->apiGet('/groups');
        $service->apiPost('/qr-codes', ['title' => 'QR']);
        $service->apiPatch('/bitlinks/bit.ly%2Fabc123', ['title' => 'Patched']);
        $service->apiDelete('/webhooks/webhook_guid');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer bitly_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api-ssl.bitly.test/v4/shorten' && $request['long_url'] === 'https://example.test/long');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api-ssl.bitly.test/v4/bitlinks' && $request['title'] === 'Campaign');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api-ssl.bitly.test/v4/bitlinks/bit.ly%2Fabc123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api-ssl.bitly.test/v4/expand' && $request['bitlink_id'] === 'bit.ly/abc123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api-ssl.bitly.test/v4/custom_bitlinks' && $request['custom_bitlink'] === 'links.example.test/campaign');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api-ssl.bitly.test/v4/bitlinks/bit.ly%2Fabc123/clicks/summary?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api-ssl.bitly.test/v4/bitlinks/bit.ly%2Fabc123/countries?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api-ssl.bitly.test/v4/groups/group_guid/bitlinks?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api-ssl.bitly.test/v4/qr-codes');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api-ssl.bitly.test/v4/qr-codes/qr_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api-ssl.bitly.test/v4/organizations/org_guid/webhooks');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api-ssl.bitly.test/v4/organizations/org_guid/webhooks');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api-ssl.bitly.test/v4/webhooks/webhook_guid');
    }

    public function test_new_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://api-ssl.bitly.test/v4/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new BitlyService('bitly_test', 'https://api-ssl.bitly.test/v4');

        self::assertTrue((new BitlyGetClickSummary($service))->execute([
            'bitlink' => 'bit.ly/abc123',
            'params' => ['unit' => 'day'],
        ])->succeeded());
        self::assertTrue((new BitlyCreateQrCode($service))->execute([
            'body' => ['destination' => ['bitlink_id' => 'bit.ly/abc123']],
        ])->succeeded());
        self::assertTrue((new BitlyApiGet($service))->execute([
            'path' => '/groups',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/clicks/summary?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api-ssl.bitly.test/v4/qr-codes');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api-ssl.bitly.test/v4/groups');
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api-ssl.bitly.com/v4/user' => Http::response(['login' => 'jane'], 200),
        ]);

        $provider = new BitlyToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('bitly_list_group_bitlinks', $tools);
        self::assertArrayHasKey('bitly_expand_bitlink', $tools);
        self::assertArrayHasKey('bitly_create_qr_code', $tools);
        self::assertArrayHasKey('bitly_create_organization_webhook', $tools);
        self::assertArrayHasKey('bitly_api_get', $tools);
        self::assertSame(22, count($tools));
        self::assertTrue($provider->testConnection(['access_token' => 'bitly_test'])['success']);
    }
}
