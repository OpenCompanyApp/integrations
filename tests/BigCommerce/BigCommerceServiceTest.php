<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\BigCommerce;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\Integrations\BigCommerce\BigCommerceToolProvider;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceCreateProduct;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceDeleteCustomers;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceGetCustomer;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListOrders;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListProducts;
use OpenCompany\Integrations\BigCommerce\Tools\BigCommerceUpdateOrderShipment;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for BigCommerce endpoint mapping and metadata.
 */
final class BigCommerceServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BigCommerceService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BigCommerceService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_store_scoped_base_url_versions_and_x_auth_token(): void
    {
        Http::fake(['*' => Http::response(['data' => ['ok' => true]], 200)]);

        $service = new BigCommerceService(accessToken: 'token_test', storeHash: 'storehash');
        $service->apiGet('/v3/catalog/products', ['limit' => 10]);
        $service->apiPost('/v3/catalog/products', ['name' => 'Example']);
        $service->apiPut('/v2/orders/123', ['status_id' => 2]);
        $service->apiDelete('/v3/customers', ['id:in' => '1,2']);
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Auth-Token', 'token_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.bigcommerce.com/stores/storehash/v3/catalog/products?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.bigcommerce.com/stores/storehash/v3/catalog/products'
            && $request['name'] === 'Example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.bigcommerce.com/stores/storehash/v2/orders/123'
            && $request['status_id'] === 2);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.bigcommerce.com/stores/storehash/v3/customers?id%3Ain=1%2C2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.bigcommerce.com/stores/storehash/v3/storefront/status');
    }

    public function test_generic_tools_map_payload_query_and_interpolated_routes(): void
    {
        $service = new BigCommerceService(accessToken: 'token_test', baseUrl: 'https://api.example.test/stores/demo/v3');

        Http::fake(['*' => Http::response(['data' => [['id' => 123]]], 200)]);
        self::assertTrue((new BigCommerceListProducts($service))->execute([
            'limit' => 25,
            'include' => 'variants,images',
            'query' => ['is_visible' => true],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/stores/demo/v3/catalog/products?')
            && str_contains($request->url(), 'limit=25')
            && str_contains($request->url(), 'include=variants%2Cimages')
            && str_contains($request->url(), 'is_visible=1'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 456]], 200)]);
        self::assertTrue((new BigCommerceCreateProduct($service))->execute([
            'payload' => ['name' => 'Example', 'type' => 'physical', 'price' => 29.99],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/stores/demo/v3/catalog/products'
            && $request['name'] === 'Example');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 789]]], 200)]);
        self::assertTrue((new BigCommerceGetCustomer($service))->execute(['customer_id' => 789])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/stores/demo/v3/customers?id%3Ain=789');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new BigCommerceDeleteCustomers($service))->execute(['customer_ids' => '1,2'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.example.test/stores/demo/v3/customers?id%3Ain=1%2C2');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 999], 200)]);
        self::assertTrue((new BigCommerceUpdateOrderShipment($service))->execute([
            'order_id' => 123,
            'shipment_id' => 999,
            'payload' => ['tracking_number' => 'TRACK123'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/stores/demo/v2/orders/123/shipments/999'
            && $request['tracking_number'] === 'TRACK123');
    }

    public function test_provider_metadata_connection_errors_and_multi_account(): void
    {
        $provider = new BigCommerceToolProvider;
        $tools = $provider->tools();

        self::assertSame('bigcommerce', $provider->appName());
        self::assertSame('BigCommerce', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.bigcommerce.com/developer/api-reference/rest/admin/overview', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertGreaterThanOrEqual(90, count($tools));
        self::assertArrayHasKey('bigcommerce_list_product_variants', $tools);
        self::assertArrayHasKey('bigcommerce_update_order_shipment', $tools);
        self::assertArrayHasKey('bigcommerce_delete_customers', $tools);
        self::assertArrayHasKey('bigcommerce_list_webhooks', $tools);

        self::assertSame(['success' => false, 'error' => 'Access token is required.'], $provider->testConnection(['store_hash' => 'demo']));
        self::assertSame(['success' => false, 'error' => 'Store hash or base URL is required.'], $provider->testConnection(['access_token' => 'token_test']));

        Http::fake(['*' => Http::response(['data' => ['status' => 'launched']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to BigCommerce API.'], $provider->testConnection([
            'access_token' => 'token_test',
            'store_hash' => 'demo',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bigcommerce.com/stores/demo/v3/storefront/status'
            && $request->hasHeader('X-Auth-Token', 'token_test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 101]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['bigcommerce', 'access_token', 'store-a'] => 'account-token',
                    ['bigcommerce', 'store_hash', 'store-a'] => 'account-hash',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'bigcommerce' && $account === 'store-a';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'bigcommerce' ? ['store-a'] : [];
            }
        });

        $tool = $provider->createTool(BigCommerceListOrders::class, ['account' => 'store-a']);
        self::assertTrue($tool->execute(['limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bigcommerce.com/stores/account-hash/v2/orders?limit=1'
            && $request->hasHeader('X-Auth-Token', 'account-token'));
    }
}
