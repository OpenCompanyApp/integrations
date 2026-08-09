<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\EasyPost;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\EasyPost\EasyPostService;
use OpenCompany\Integrations\EasyPost\EasyPostToolProvider;
use OpenCompany\Integrations\EasyPost\Tools\EasyPostAddressesCreate;
use OpenCompany\Integrations\EasyPost\Tools\EasyPostApiGet;
use OpenCompany\Integrations\EasyPost\Tools\EasyPostShipmentsList;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the EasyPost API v2 integration.
 */
final class EasyPostServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(EasyPostService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(EasyPostService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new EasyPostToolProvider();

        self::assertSame('easypost', $provider->appName());
        self::assertSame('EasyPost', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key_basic', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(67, $provider->tools());
        self::assertCount(62, EasyPostService::operations());
        self::assertArrayHasKey('easypost_shipments_buy', $provider->tools());
        self::assertArrayHasKey('easypost_batches_scan_form', $provider->tools());
        self::assertArrayHasKey('easypost_carrier_accounts_create', $provider->tools());
        self::assertArrayHasKey('easypost_api_delete', $provider->tools());

        foreach ($provider->tools() as $tool) {
            self::assertTrue(class_exists((string) $tool['class']), (string) $tool['class']);
        }
    }

    public function test_service_maps_documented_easypost_endpoints(): void
    {
        Http::fake(['https://easypost.test/v2/*' => Http::response(['ok' => true], 200)]);

        $service = new EasyPostService('ez-key', 'https://easypost.test/v2');
        $service->call('addresses_create', ['street1' => '417 Montgomery St', 'city' => 'San Francisco']);
        $service->call('addresses_get', ['address_id' => 'adr_123']);
        $service->call('addresses_verify', ['address_id' => 'adr_123']);
        $service->call('parcels_create', ['weight' => 16]);
        $service->call('parcels_get', ['parcel_id' => 'prcl_123']);
        $service->call('customs_items_create', ['description' => 'T-shirt', 'weight' => 5]);
        $service->call('customs_items_get', ['customs_item_id' => 'cstitem_123']);
        $service->call('customs_infos_create', ['contents_type' => 'merchandise']);
        $service->call('customs_infos_get', ['customs_info_id' => 'cstinfo_123']);
        $service->call('shipments_create', ['to_address' => ['id' => 'adr_to'], 'from_address' => ['id' => 'adr_from'], 'parcel' => ['id' => 'prcl_123']]);
        $service->call('shipments_buy', ['shipment_id' => 'shp_123', 'rate' => ['id' => 'rate_123']]);
        $service->call('shipments_list', ['page_size' => 10, 'before_id' => 'shp_before']);
        $service->call('shipments_get', ['shipment_id' => 'shp_123']);
        $service->call('shipments_label', ['shipment_id' => 'shp_123', 'file_format' => 'PDF']);
        $service->call('shipments_insure', ['shipment_id' => 'shp_123', 'amount' => '100.00']);
        $service->call('shipments_refund', ['shipment_id' => 'shp_123']);
        $service->call('trackers_create', ['tracking_code' => 'EZ1000000001', 'carrier' => 'USPS']);
        $service->call('trackers_list', ['tracking_code' => 'EZ1000000001']);
        $service->call('trackers_get', ['tracker_id' => 'trk_123']);
        $service->call('orders_create', ['shipments' => [['parcel' => ['id' => 'prcl_123']]]]);
        $service->call('orders_buy', ['order_id' => 'order_123', 'carrier' => 'USPS', 'service' => 'GroundAdvantage']);
        $service->call('orders_get', ['order_id' => 'order_123']);
        $service->call('batches_create', ['shipments' => [['id' => 'shp_123']]]);
        $service->call('batches_add_shipments', ['batch_id' => 'batch_123', 'shipments' => [['id' => 'shp_124']]]);
        $service->call('batches_remove_shipments', ['batch_id' => 'batch_123', 'shipments' => [['id' => 'shp_124']]]);
        $service->call('batches_buy', ['batch_id' => 'batch_123']);
        $service->call('batches_label', ['batch_id' => 'batch_123', 'file_format' => 'PDF']);
        $service->call('batches_scan_form', ['batch_id' => 'batch_123']);
        $service->call('batches_list', ['page_size' => 5]);
        $service->call('batches_get', ['batch_id' => 'batch_123']);
        $service->call('pickups_create', ['address' => ['id' => 'adr_123'], 'shipment' => ['id' => 'shp_123']]);
        $service->call('pickups_buy', ['pickup_id' => 'pickup_123', 'carrier' => 'USPS', 'service' => 'NextDay']);
        $service->call('pickups_cancel', ['pickup_id' => 'pickup_123']);
        $service->call('pickups_list', ['page_size' => 5]);
        $service->call('pickups_get', ['pickup_id' => 'pickup_123']);
        $service->call('scan_forms_create', ['shipments' => [['id' => 'shp_123']]]);
        $service->call('scan_forms_list', ['page_size' => 5]);
        $service->call('scan_forms_get', ['scan_form_id' => 'sf_123']);
        $service->call('refunds_create', ['carrier' => 'USPS', 'tracking_codes' => ['EZ1000000001']]);
        $service->call('refunds_list', ['page_size' => 5]);
        $service->call('refunds_get', ['refund_id' => 'rfnd_123']);
        $service->call('insurances_create', ['tracking_code' => 'EZ1000000001', 'amount' => '100.00']);
        $service->call('insurances_list', ['page_size' => 5]);
        $service->call('insurances_get', ['insurance_id' => 'ins_123']);
        $service->call('insurances_refund', ['insurance_id' => 'ins_123']);
        $service->call('carrier_accounts_list');
        $service->call('carrier_accounts_get', ['carrier_account_id' => 'ca_123']);
        $service->call('carrier_accounts_create', ['type' => 'UspsAccount']);
        $service->call('carrier_accounts_update', ['carrier_account_id' => 'ca_123', 'description' => 'Updated']);
        $service->call('carrier_accounts_delete', ['carrier_account_id' => 'ca_123']);
        $service->call('carrier_types_list');
        $service->call('webhooks_create', ['url' => 'https://example.test/easypost']);
        $service->call('webhooks_list');
        $service->call('webhooks_get', ['webhook_id' => 'hook_123']);
        $service->call('webhooks_update', ['webhook_id' => 'hook_123', 'url' => 'https://example.test/new']);
        $service->call('webhooks_delete', ['webhook_id' => 'hook_123']);
        $service->call('events_list', ['page_size' => 5]);
        $service->call('events_get', ['event_id' => 'evt_123']);
        $service->call('reports_create', ['report_type' => 'shipments', 'start_date' => '2026-05-01']);
        $service->call('reports_list', ['report_type' => 'shipments']);
        $service->call('reports_get', ['report_type' => 'shipments', 'report_id' => 'shprep_123']);
        $raw = $service->apiGet('/shipments', ['page_size' => 2]);

        self::assertSame(200, $raw['status']);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('ez-key:')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://easypost.test/v2/addresses' && $request->data()['address']['street1'] === '417 Montgomery St');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://easypost.test/v2/shipments' && $request->data()['shipment']['parcel']['id'] === 'prcl_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://easypost.test/v2/shipments/shp_123/buy' && $request->data()['rate']['id'] === 'rate_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://easypost.test/v2/shipments?') && str_contains($request->url(), 'page_size=10'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://easypost.test/v2/batches/batch_123/add_shipments' && $request->data()['shipments'][0]['id'] === 'shp_124');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://easypost.test/v2/refunds' && $request->data()['refund']['carrier'] === 'USPS');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://easypost.test/v2/carrier_accounts/ca_123' && $request->data()['carrier_account']['description'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://easypost.test/v2/reports/shipments' && $request->data()['report']['start_date'] === '2026-05-01');
    }

    public function test_tools_validate_paths_and_configuration(): void
    {
        Http::fake(['https://easypost.test/v2/*' => Http::response(['ok' => true], 200)]);

        $service = new EasyPostService('ez-key', 'https://easypost.test/v2');

        self::assertTrue((new EasyPostAddressesCreate($service))->execute(['street1' => '417 Montgomery St'])->succeeded());
        self::assertTrue((new EasyPostShipmentsList($service))->execute(['payload' => ['page_size' => 10]])->succeeded());

        $missing = (new \OpenCompany\Integrations\EasyPost\Tools\EasyPostShipmentsGet($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('shipment_id is required', (string) $missing->error);

        $badRaw = (new EasyPostApiGet($service))->execute(['path' => 'https://evil.example.test/shipments']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new EasyPostApiGet(new EasyPostService('', 'https://easypost.test/v2')))->execute(['path' => '/shipments']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new EasyPostToolProvider();

        self::assertSame(['success' => false, 'error' => 'EasyPost API key is required.'], $provider->testConnection([]));

        Http::fake(['https://api.easypost.com/v2/api_keys' => Http::response(['keys' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to EasyPost API.'], $provider->testConnection([
            'api_key' => 'ez-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.easypost.test/v2/shipments' => Http::response(['shipments' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['easypost', 'api_key', 'ops'] => 'account-key',
                    ['easypost', 'url', 'ops'] => 'https://ops.easypost.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'easypost' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'easypost' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(EasyPostShipmentsList::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.easypost.test/v2/shipments'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('account-key:')));
    }
}
