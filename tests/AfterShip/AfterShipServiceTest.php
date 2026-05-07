<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AfterShip;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\AfterShip\AfterShipService;
use OpenCompany\Integrations\AfterShip\AfterShipToolProvider;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipCreateTracking;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipDetectCourier;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipGetTracking;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipListCouriers;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipListTrackings;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipMarkTrackingCompleted;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipPredictEstimatedDeliveryDate;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipUpdateCourierConnection;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipUpdateTracking;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the AfterShip integration.
 */
final class AfterShipServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AfterShipService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AfterShipService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new AfterShipToolProvider;

        self::assertSame('aftership', $provider->appName());
        self::assertSame('AfterShip', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(16, $provider->tools());
        self::assertContains('aftership_create_tracking', array_keys($provider->tools()));
        self::assertContains('aftership_detect_courier', array_keys($provider->tools()));
        self::assertContains('aftership_batch_predict_estimated_delivery_date', array_keys($provider->tools()));
    }

    public function test_tracking_routes_headers_envelopes_and_query_mapping(): void
    {
        $service = new AfterShipService(apiKey: 'test-key', baseUrl: 'https://aftership.example.test/tracking/2026-01');

        Http::fake(['*' => Http::response(['data' => ['trackings' => []]], 200)]);
        self::assertTrue((new AfterShipListTrackings($service))->execute(['limit' => 20, 'delivery_status' => 'InTransit', 'slug' => 'usps'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://aftership.example.test/tracking/2026-01/trackings?')
            && $request->hasHeader('as-api-key', 'test-key')
            && str_contains($request->url(), 'limit=20')
            && str_contains($request->url(), 'delivery_status=InTransit')
            && str_contains($request->url(), 'slug=usps'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['tracking' => ['id' => 'trk_123']]], 201)]);
        self::assertTrue((new AfterShipCreateTracking($service))->execute(['tracking_number' => 'TEST123', 'slug' => 'usps', 'title' => 'Order TEST'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://aftership.example.test/tracking/2026-01/trackings'
            && ($request->data()['tracking']['tracking_number'] ?? null) === 'TEST123'
            && ($request->data()['tracking']['slug'] ?? null) === 'usps'
            && ($request->data()['tracking']['title'] ?? null) === 'Order TEST');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['tracking' => ['id' => 'trk_123']]], 200)]);
        self::assertTrue((new AfterShipGetTracking($service))->execute(['id' => 'trk_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://aftership.example.test/tracking/2026-01/trackings/trk_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['tracking' => ['id' => 'trk_123']]], 200)]);
        self::assertTrue((new AfterShipUpdateTracking($service))->execute(['id' => 'trk_123', 'title' => 'Updated'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://aftership.example.test/tracking/2026-01/trackings/trk_123'
            && ($request->data()['tracking']['title'] ?? null) === 'Updated');
    }

    public function test_courier_completion_connection_and_edd_routes_are_mapped(): void
    {
        $service = new AfterShipService(apiKey: 'test-key', baseUrl: 'https://aftership.example.test/tracking/2026-01');

        Http::fake(['*' => Http::response(['data' => ['couriers' => [['slug' => 'usps']]]], 200)]);
        self::assertTrue((new AfterShipListCouriers($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://aftership.example.test/tracking/2026-01/couriers');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['couriers' => [['slug' => 'ups']]]], 200)]);
        self::assertTrue((new AfterShipDetectCourier($service))->execute(['tracking_number' => 'TEST123', 'destination_country_region' => 'USA'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://aftership.example.test/tracking/2026-01/couriers/detect'
            && ($request->data()['tracking']['tracking_number'] ?? null) === 'TEST123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['tracking' => ['id' => 'trk_123']]], 200)]);
        self::assertTrue((new AfterShipMarkTrackingCompleted($service))->execute(['id' => 'trk_123', 'reason' => 'manual'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://aftership.example.test/tracking/2026-01/trackings/trk_123/mark-as-completed'
            && ($request->data()['reason'] ?? null) === 'manual');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['courier_connection' => ['id' => 'conn_123']]], 200)]);
        self::assertTrue((new AfterShipUpdateCourierConnection($service))->execute(['id' => 'conn_123', 'active' => false])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://aftership.example.test/tracking/2026-01/courier-connections/conn_123'
            && ($request->data()['active'] ?? null) === false);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['estimated_delivery_date' => '2026-05-10']], 200)]);
        self::assertTrue((new AfterShipPredictEstimatedDeliveryDate($service))->execute(['slug' => 'usps', 'destination_country_region' => 'USA'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://aftership.example.test/tracking/2026-01/estimated-delivery-date/predict'
            && ($request->data()['slug'] ?? null) === 'usps');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new AfterShipService(apiKey: 'test-key', baseUrl: 'https://aftership.example.test/tracking/2026-01');

        $missingTracking = (new AfterShipCreateTracking($service))->execute([]);
        self::assertFalse($missingTracking->succeeded());
        self::assertStringContainsString('tracking_number is required', (string) $missingTracking->error);

        $missingId = (new AfterShipGetTracking($service))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('id is required', (string) $missingId->error);

        Http::fake(['*' => Http::response(['meta' => ['code' => 401, 'message' => 'Bad key']], 401)]);
        $apiError = (new AfterShipListCouriers($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Bad key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['couriers' => []]], 200)]);
        self::assertSame(['success' => true, 'message' => 'AfterShip API key accepted.'], (new AfterShipToolProvider)->testConnection(['api_key' => 'test-key']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['couriers' => []]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'aftership' && $key === 'api_key' && $account === 'shipping' ? 'account-key' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'aftership' && $account === 'shipping';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'aftership' ? ['shipping'] : [];
            }
        });

        $tool = (new AfterShipToolProvider)->createTool(AfterShipListCouriers::class, ['account' => 'shipping']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('as-api-key', 'account-key'));
    }
}
