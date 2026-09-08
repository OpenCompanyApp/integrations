<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ShipStation;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ShipStation\ShipStationService;
use OpenCompany\Integrations\ShipStation\ShipStationToolProvider;
use OpenCompany\Integrations\ShipStation\Tools\ShipStationApiGet;
use OpenCompany\Integrations\ShipStation\Tools\ShipStationShipmentsGet;
use OpenCompany\Integrations\ShipStation\Tools\ShipStationShipmentsList;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the ShipStation V2 integration.
 */
final class ShipStationServiceTest extends TestCase
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
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_tools_and_docs(): void
    {
        $provider = new ShipStationToolProvider;
        $tools = $provider->tools();

        self::assertSame('shipstation', $provider->appName());
        self::assertSame('ShipStation', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.shipstation.com/apis/openapi', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_key_header', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(98, ShipStationService::operations());
        self::assertCount(103, $tools);
        self::assertArrayHasKey('shipstation_shipments_create', $tools);
        self::assertArrayHasKey('shipstation_labels_create_from_rate', $tools);
        self::assertArrayHasKey('shipstation_purchase_orders_shipping_details', $tools);
        self::assertArrayHasKey('shipstation_webhooks_create', $tools);
        self::assertArrayHasKey('shipstation_api_delete', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_every_documented_operation_and_raw_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShipStationService('ss_test_key', 'https://shipstation.example.test');

        foreach (ShipStationService::operations() as $operation => $definition) {
            $params = [];

            foreach ($definition[2] as $field) {
                $params[$field] = $field === 'filename' ? 'label.pdf' : $field.'_123';
            }

            $service->call($operation, $params);
        }

        $service->call('batches_create', ['name' => 'Batch A']);
        $service->call('batches_add', ['batch_id' => 'batch_123', 'shipment_ids' => ['shp_1']]);
        $service->call('labels_create_from_rate', ['rate_id' => 'rate_123', 'label_format' => 'pdf']);
        $service->call('labels_void', ['label_id' => 'label_123']);
        $service->call('purchase_orders_status', ['purchase_order_id' => 'po_123', 'status' => 'closed']);
        $service->call('shipments_get_external', ['external_shipment_id' => 'ext_123']);
        $service->call('shipments_add_tag', ['shipment_id' => 'shp_123', 'tag_name' => 'urgent']);
        $service->call('shipments_remove_tag', ['shipment_id' => 'shp_123', 'tag_name' => 'urgent']);
        $service->call('webhooks_create', ['event' => 'label_created', 'url' => 'https://example.test/webhook']);
        $service->apiGet('/v2/shipments', ['page_size' => 2]);

        Http::assertSentCount(108);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipstation.example.test/v2/carriers'
            && $request->hasHeader('API-Key', 'ss_test_key'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipstation.example.test/v2/carriers/carrier_id_123/services');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipstation.example.test/v2/downloads/dir_123/subdir_123/label.pdf');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shipstation.example.test/v2/batches'
            && isset($request->data()['name'])
            && $request->data()['name'] === 'Batch A');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shipstation.example.test/v2/batches/batch_123/add'
            && $request->data()['shipment_ids'][0] === 'shp_1');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shipstation.example.test/v2/labels/rates/rate_123'
            && $request->data()['label_format'] === 'pdf');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://shipstation.example.test/v2/labels/label_123/void');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shipstation.example.test/v2/purchase_orders/po_123/status'
            && $request->data()['status'] === 'closed');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipstation.example.test/v2/shipments/external_shipment_id/ext_123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shipstation.example.test/v2/shipments/shp_123/tags/urgent');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://shipstation.example.test/v2/shipments/shp_123/tags/urgent');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shipstation.example.test/v2/environment/webhooks'
            && isset($request->data()['event'])
            && $request->data()['event'] === 'label_created');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipstation.example.test/v2/shipments?page_size=2');
    }

    public function test_tools_validate_paths_and_configuration(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShipStationService('ss_test_key', 'https://shipstation.example.test');

        self::assertTrue((new ShipStationShipmentsGet($service))->execute(['shipment_id' => 'shp_123'])->succeeded());
        self::assertTrue((new ShipStationShipmentsList($service))->execute(['payload' => ['page_size' => 2]])->succeeded());
        self::assertTrue((new ShipStationApiGet($service))->execute(['path' => '/v2/shipments', 'payload' => ['page_size' => 2]])->succeeded());

        $missingPathParam = (new ShipStationShipmentsGet($service))->execute([]);
        $absoluteRawPath = (new ShipStationApiGet($service))->execute(['path' => 'https://evil.example.test/v2/shipments']);
        $unconfigured = (new ShipStationShipmentsList(new ShipStationService('', 'https://shipstation.example.test')))->execute([]);

        self::assertFalse($missingPathParam->succeeded());
        self::assertStringContainsString('shipment_id is required', (string) $missingPathParam->error);
        self::assertFalse($absoluteRawPath->succeeded());
        self::assertStringContainsString('relative path', (string) $absoluteRawPath->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new ShipStationToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'shipstation.example.test/v2/carriers' => Http::response(['carriers' => []], 200),
            'ops.shipstation.example.test/v2/shipments' => Http::response(['shipments' => []], 200),
        ]);

        $result = $provider->testConnection([
            'api_key' => 'ss_test_key',
            'url' => 'https://shipstation.example.test',
        ]);

        self::assertTrue($result['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'api_key' => $account === 'ops' ? 'ss_ops_key' : 'ss_default_key',
                    'url' => 'https://ops.shipstation.example.test',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['ops'];
            }
        });

        $tool = $provider->createTool(ShipStationShipmentsList::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shipstation.example.test/v2/carriers'
            && $request->hasHeader('API-Key', 'ss_test_key'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://ops.shipstation.example.test/v2/shipments'
            && $request->hasHeader('API-Key', 'ss_ops_key'));
    }
}
