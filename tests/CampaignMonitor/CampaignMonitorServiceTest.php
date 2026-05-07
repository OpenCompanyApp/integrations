<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CampaignMonitor;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorToolProvider;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorAddSubscriber;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorApiGet;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorCreateCampaign;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorListCampaignClicks;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorListClients;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorSendClassicEmail;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Campaign Monitor API v3.3 endpoint coverage.
 */
final class CampaignMonitorServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_uses_basic_auth_and_safe_relative_paths(): void
    {
        Http::fake([
            'https://api.createsend.com/api/v3.3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CampaignMonitorService('cm_test');

        self::assertSame(['ok' => true], $service->getCurrentUser());
        self::assertSame(['ok' => true], $service->apiGet('/clients.json'));
        self::assertSame(['ok' => true], $service->apiPost('/subscribers/list_test.json', ['EmailAddress' => 'reader@example.test']));
        self::assertSame(['ok' => true], $service->apiPut('/clients/client_test/unsuppress.json', [], ['email' => 'reader@example.test']));
        self::assertSame(['ok' => true], $service->apiDelete('/lists/list_test.json'));

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.createsend.com/api/v3.3/primarycontact.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.createsend.com/api/v3.3/clients.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.createsend.com/api/v3.3/subscribers/list_test.json' && $request['EmailAddress'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.createsend.com/api/v3.3/clients/client_test/unsuppress.json?email=reader%40example.test');
    }

    public function test_tools_delegate_to_documented_v33_endpoints(): void
    {
        Http::fake([
            'https://api.createsend.com/api/v3.3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CampaignMonitorService('cm_test');

        self::assertTrue((new CampaignMonitorListClients($service))->execute([])->succeeded());

        self::assertTrue((new CampaignMonitorCreateCampaign($service))->execute([
            'client_id' => 'client_test',
            'payload' => [
                'Name' => 'Newsletter',
                'Subject' => 'Hello',
                'FromName' => 'Ada',
                'FromEmail' => 'ada@example.test',
                'ReplyTo' => 'reply@example.test',
                'HtmlUrl' => 'https://example.test/newsletter.html',
                'ListIDs' => ['list_test'],
            ],
        ])->succeeded());

        self::assertTrue((new CampaignMonitorListCampaignClicks($service))->execute([
            'campaign_id' => 'campaign_test',
            'page' => 1,
            'pagesize' => 50,
        ])->succeeded());

        self::assertTrue((new CampaignMonitorAddSubscriber($service))->execute([
            'list_id' => 'list_test',
            'EmailAddress' => 'reader@example.test',
            'Name' => 'Ada Reader',
        ])->succeeded());

        self::assertTrue((new CampaignMonitorSendClassicEmail($service))->execute([
            'clientID' => 'client_test',
            'payload' => [
                'Subject' => 'Receipt',
                'From' => 'Billing <billing@example.test>',
                'To' => ['reader@example.test'],
                'Text' => 'Thanks',
                'ConsentToTrack' => 'No',
            ],
        ])->succeeded());

        self::assertTrue((new CampaignMonitorApiGet($service))->execute([
            'path' => '/clients.json',
        ])->succeeded());

        self::assertFalse((new CampaignMonitorApiGet($service))->execute([
            'path' => 'https://example.test/clients.json',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.createsend.com/api/v3.3/clients.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.createsend.com/api/v3.3/campaigns/client_test.json' && $request['Subject'] === 'Hello');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.createsend.com/api/v3.3/campaigns/campaign_test/clicks.json?page=1&pagesize=50');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.createsend.com/api/v3.3/subscribers/list_test.json' && $request['EmailAddress'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.createsend.com/api/v3.3/transactional/classicEmail/send?clientID=client_test' && $request['Subject'] === 'Receipt');
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.createsend.com/api/v3.3/primarycontact.json' => Http::response([
                'EmailAddress' => 'owner@example.test',
            ], 200),
        ]);

        $provider = new CampaignMonitorToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://www.campaignmonitor.com/api/v3-3/', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('campaignmonitor_list_clients', $tools);
        self::assertArrayHasKey('campaignmonitor_create_campaign', $tools);
        self::assertArrayHasKey('campaignmonitor_get_campaign_summary', $tools);
        self::assertArrayHasKey('campaignmonitor_create_custom_field', $tools);
        self::assertArrayHasKey('campaignmonitor_import_subscribers', $tools);
        self::assertArrayHasKey('campaignmonitor_create_segment', $tools);
        self::assertArrayHasKey('campaignmonitor_create_webhook', $tools);
        self::assertArrayHasKey('campaignmonitor_send_classic_email', $tools);
        self::assertArrayHasKey('campaignmonitor_api_delete', $tools);
        self::assertSame(79, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'cm_test'])['success']);
    }
}
