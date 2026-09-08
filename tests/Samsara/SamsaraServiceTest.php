<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Samsara;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Samsara\SamsaraService;
use OpenCompany\Integrations\Samsara\SamsaraToolProvider;
use OpenCompany\Integrations\Samsara\Tools\SamsaraApiGet;
use OpenCompany\Integrations\Samsara\Tools\SamsaraGetVehicleStats;
use OpenCompany\Integrations\Samsara\Tools\SamsaraUpdateRoute;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Samsara REST API integration.
 */
final class SamsaraServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(SamsaraService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(SamsaraService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new SamsaraToolProvider;

        self::assertSame('samsara', $provider->appName());
        self::assertSame('Samsara', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(51, $provider->tools());
        self::assertArrayHasKey('samsara_list_vehicles', $provider->tools());
        self::assertArrayHasKey('samsara_get_vehicle_stats_history', $provider->tools());
        self::assertArrayHasKey('samsara_list_trailers', $provider->tools());
        self::assertArrayHasKey('samsara_list_equipment', $provider->tools());
        self::assertArrayHasKey('samsara_create_route', $provider->tools());
        self::assertArrayHasKey('samsara_list_documents', $provider->tools());
        self::assertArrayHasKey('samsara_api_get', $provider->tools());
    }

    public function test_service_uses_current_unversioned_paths_and_preserves_repeated_query_values(): void
    {
        Http::fake(['*' => Http::response(['data' => [['id' => 'vehicle-123']]], 200)]);

        $service = new SamsaraService('token-test', 'https://example.test');
        $stats = $service->apiGet('/fleet/vehicles/stats', [
            'types' => ['gps', 'obdOdometerMeters'],
            'vehicleIds' => ['vehicle-123', 'vehicle-456'],
            'after' => '',
        ]);

        self::assertSame('vehicle-123', $stats['data'][0]['id']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/fleet/vehicles/stats?types=gps&types=obdOdometerMeters&vehicleIds=vehicle-123&vehicleIds=vehicle-456'
            && $request->hasHeader('Authorization', 'Bearer token-test'));
    }

    public function test_service_maps_post_patch_delete_and_blocks_unsafe_paths(): void
    {
        Http::fake(['*' => Http::response(['data' => ['id' => 'route-123']], 200)]);

        $service = new SamsaraService('token-test', 'https://example.test');
        $created = $service->apiPost('/fleet/routes', ['name' => 'Morning Route']);
        $updated = $service->apiPatch('/fleet/routes/route-123', ['name' => 'Updated'], ['include' => ['stops.actualDistanceMeters']]);
        $deleted = $service->apiDelete('/fleet/routes/route-123', ['hard' => 'true']);

        self::assertSame('route-123', $created['data']['id']);
        self::assertSame('route-123', $updated['data']['id']);
        self::assertSame('route-123', $deleted['data']['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/fleet/routes'
            && $request['name'] === 'Morning Route');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://example.test/fleet/routes/route-123?include=stops.actualDistanceMeters'
            && $request['name'] === 'Updated');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://example.test/fleet/routes/route-123?hard=true');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/fleet/vehicles');
    }

    public function test_endpoint_tools_expand_paths_merge_query_and_require_configuration(): void
    {
        Http::fake(['*' => Http::response(['data' => [['id' => 'ok']]], 200)]);

        $service = new SamsaraService('token-test', 'https://example.test');

        $stats = (new SamsaraGetVehicleStats($service))->execute([
            'types' => ['gps', 'engineStates'],
            'vehicleIds' => ['vehicle-123'],
        ]);
        self::assertTrue($stats->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/fleet/vehicles/stats?types=gps&types=engineStates&vehicleIds=vehicle-123');

        $route = (new SamsaraUpdateRoute($service))->execute([
            'id' => 'route-123',
            'payload' => ['name' => 'Updated'],
            'include' => ['stops.actualDistanceMeters'],
        ]);
        self::assertTrue($route->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://example.test/fleet/routes/route-123?include=stops.actualDistanceMeters'
            && $request['name'] === 'Updated');

        $raw = (new SamsaraApiGet($service))->execute(['path' => '/users', 'limit' => 10]);
        self::assertTrue($raw->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/users?limit=10');

        $missingPath = (new SamsaraUpdateRoute($service))->execute(['payload' => ['name' => 'Updated']]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('Missing required argument: id', (string) $missingPath->error);

        $unconfigured = (new SamsaraApiGet(new SamsaraService('', 'https://example.test')))->execute(['path' => '/users']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_current_users_me_endpoint(): void
    {
        Http::fake(['*' => Http::response(['data' => ['email' => 'ops@example.test']], 200)]);

        $result = (new SamsaraToolProvider)->testConnection([
            'access_token' => 'token-test',
            'url' => 'https://example.test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/users/me'
            && $request->hasHeader('Authorization', 'Bearer token-test'));
    }
}
