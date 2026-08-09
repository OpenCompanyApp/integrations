<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ShipEngine;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ShipEngine\ShipEngineService;
use OpenCompany\Integrations\ShipEngine\ShipEngineToolProvider;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineCreateShipments;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineGetShipmentById;
use OpenCompany\Integrations\ShipEngine\Tools\ShipEngineListLabels;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated ShipEngine OpenAPI integration.
 */
final class ShipEngineServiceTest extends TestCase
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

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new ShipEngineToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/shipengine/shipengine-openapi-manifest.json'), true);

        self::assertSame(97, $manifest['method_count']);
        self::assertSame('3.0.0', $manifest['openapi']);
        self::assertSame(97, $manifest['auth']['api_key']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('ShipEngine', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('shipengine_list_carriers', array_keys($provider->tools()));
        self::assertContains('shipengine_create_shipments', array_keys($provider->tools()));
        self::assertContains('shipengine_create_tag_2', array_keys($provider->tools()));
    }

    public function test_service_maps_api_key_path_query_arrays_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShipEngineService('se_test_key', 'https://shipengine.example.test');
        $service->request('GET', '/v1/shipments/{shipment_id}', ['shipment_id' => 'se 123']);
        $service->request('GET', '/v1/labels', [], ['refund_status' => ['pending', 'approved'], 'page_size' => 25], [], [], ['refund_status' => 'comma']);
        $service->request('POST', '/v1/shipments', [], [], [], ['shipments' => [['external_shipment_id' => 'shipment-1']]]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipengine.example.test/v1/shipments/se%20123'
            && $request->hasHeader('API-Key', 'se_test_key'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipengine.example.test/v1/labels?refund_status=pending%2Capproved&page_size=25');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shipengine.example.test/v1/shipments'
            && $request->data()['shipments'][0]['external_shipment_id'] === 'shipment-1');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShipEngineService('se_test_key', 'https://shipengine.example.test');

        self::assertTrue((new ShipEngineGetShipmentById($service))->execute(['shipment_id' => 'se-123'])->succeeded());
        self::assertTrue((new ShipEngineListLabels($service))->execute(['refund_status' => ['pending', 'approved'], 'page_size' => 25])->succeeded());
        self::assertTrue((new ShipEngineCreateShipments($service))->execute(['body' => ['shipments' => [['external_shipment_id' => 'shipment-1']]]])->succeeded());

        $missingPath = (new ShipEngineGetShipmentById($service))->execute([]);
        $badBody = (new ShipEngineCreateShipments($service))->execute(['body' => 'not-object']);
        $missingBody = (new ShipEngineCreateShipments($service))->execute([]);
        $unconfigured = (new ShipEngineGetShipmentById(new ShipEngineService('', 'https://shipengine.example.test')))->execute(['shipment_id' => 'se-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('shipment_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_lightweight_account_settings_request(): void
    {
        Http::fake(['shipengine.example.test/v1/account/settings' => Http::response(['default_label_layout' => '4x6'], 200)]);

        $result = (new ShipEngineToolProvider)->testConnection([
            'api_key' => 'se_test_key',
            'url' => 'https://shipengine.example.test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipengine.example.test/v1/account/settings'
            && $request->hasHeader('API-Key', 'se_test_key'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'api_key' => $account === 'work' ? 'se_work_key' : 'se_default_key',
                    'url' => 'https://shipengine.example.test',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = (new ShipEngineToolProvider)->createTool(ShipEngineGetShipmentById::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['shipment_id' => 'se-123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('API-Key', 'se_work_key'));
    }
}
