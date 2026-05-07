<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CustomerIO;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\Integrations\CustomerIO\CustomerIOToolProvider;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOTrackIdentify;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Customer.io API coverage and request mapping.
 */
final class CustomerIOServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_provider_exposes_official_customerio_surface(): void
    {
        $provider = new CustomerIOToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.customer.io/api/', $provider->integrationMeta()['docs_url']);
        self::assertCount(183, $tools);
        self::assertArrayHasKey('customerio_app_list_campaigns', $tools);
        self::assertArrayHasKey('customerio_track_identify', $tools);
        self::assertArrayHasKey('customerio_pipelines_identify', $tools);
        self::assertArrayNotHasKey('customerio_identify_customer', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/customerio/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_app_query_and_bearer_requests(): void
    {
        Http::fake(['*' => Http::response(['campaigns' => []], 200)]);

        $service = new CustomerIOService('app-key', 'https://api.example.test');
        $service->call('customerio_app_list_campaigns', ['limit' => 5]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v1/campaigns?limit=5'
            && $request->hasHeader('Authorization', 'Bearer app-key'));
    }

    public function test_service_maps_track_path_json_and_basic_auth_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CustomerIOService(
            siteId: 'site-id',
            trackApiKey: 'track-key',
            trackBaseUrl: 'https://track.example.test',
        );

        $service->call('customerio_track_identify', [
            'identifier' => 'user-123',
            'payload' => ['email' => 'person@example.test'],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://track.example.test/api/v1/customers/user-123'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('site-id:track-key'))
            && $request['email'] === 'person@example.test');
    }

    public function test_service_maps_pipelines_json_and_basic_auth_requests(): void
    {
        Http::fake(['*' => Http::response(['success' => true], 200)]);

        $service = new CustomerIOService(
            pipelinesApiKey: 'pipeline-key',
            pipelinesBaseUrl: 'https://cdp.example.test/v1',
        );

        $service->call('customerio_pipelines_identify', [
            'payload' => [
                'userId' => 'user-123',
                'traits' => ['plan' => 'pro'],
            ],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://cdp.example.test/v1/identify'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('pipeline-key:'))
            && $request['userId'] === 'user-123'
            && $request['traits']['plan'] === 'pro');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new CustomerIOTrackIdentify(new CustomerIOService(siteId: 'site-id', trackApiKey: 'track-key'));
        $result = $tool->execute(['payload' => ['email' => 'person@example.test']]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('identifier is required', (string) $result->error);
    }
}
