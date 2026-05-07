<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Shopify;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Shopify\ShopifyService;
use OpenCompany\Integrations\Shopify\ShopifyToolProvider;
use OpenCompany\Integrations\Shopify\Tools\ShopifyApiGet;
use OpenCompany\Integrations\Shopify\Tools\ShopifyCreateProduct;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListOrders;
use OpenCompany\Integrations\Shopify\Tools\ShopifyListProducts;
use OpenCompany\Integrations\Shopify\Tools\ShopifySetInventoryLevel;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Shopify Admin REST endpoint mapping and metadata.
 */
final class ShopifyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ShopifyService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ShopifyService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_shop_domain_admin_rest_base_and_access_token_header(): void
    {
        Http::fake(['*' => Http::response(['products' => []], 200)]);

        $service = new ShopifyService(accessToken: 'token_test', shopDomain: 'demo.myshopify.com', apiVersion: '2025-10');
        $service->apiGet('/products.json', ['limit' => 10]);
        $service->apiPost('/products.json', ['product' => ['title' => 'Example']]);
        $service->apiPut('/orders/123.json', ['order' => ['note' => 'Updated']]);
        $service->apiDelete('/webhooks/456.json');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Shopify-Access-Token', 'token_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://demo.myshopify.com/admin/api/2025-10/products.json?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://demo.myshopify.com/admin/api/2025-10/products.json'
            && $request['product']['title'] === 'Example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://demo.myshopify.com/admin/api/2025-10/orders/123.json'
            && $request['order']['note'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://demo.myshopify.com/admin/api/2025-10/webhooks/456.json');
    }

    public function test_endpoint_tools_map_payload_query_and_raw_paths(): void
    {
        $service = new ShopifyService(accessToken: 'token_test', baseUrl: 'https://shop.example.test/admin/api/2025-10');

        Http::fake(['*' => Http::response(['products' => [['id' => 123]]], 200)]);
        self::assertTrue((new ShopifyListProducts($service))->execute(['limit' => 25, 'status' => 'active', 'query' => ['fields' => 'id,title']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://shop.example.test/admin/api/2025-10/products.json?')
            && str_contains($request->url(), 'limit=25')
            && str_contains($request->url(), 'status=active')
            && str_contains($request->url(), 'fields=id%2Ctitle'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['product' => ['id' => 456]], 200)]);
        self::assertTrue((new ShopifyCreateProduct($service))->execute(['payload' => ['product' => ['title' => 'Example']]])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shop.example.test/admin/api/2025-10/products.json'
            && $request['product']['title'] === 'Example');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['orders' => []], 200)]);
        self::assertTrue((new ShopifyListOrders($service))->execute(['status' => 'open', 'financial_status' => 'paid'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/orders.json?')
            && str_contains($request->url(), 'status=open')
            && str_contains($request->url(), 'financial_status=paid'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['inventory_level' => ['available' => 5]], 200)]);
        self::assertTrue((new ShopifySetInventoryLevel($service))->execute(['payload' => ['location_id' => 1, 'inventory_item_id' => 2, 'available' => 5]])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shop.example.test/admin/api/2025-10/inventory_levels/set.json'
            && $request['available'] === 5);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['count' => 10], 200)]);
        self::assertTrue((new ShopifyApiGet($service))->execute(['path' => '/products/count.json', 'query' => ['status' => 'active']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://shop.example.test/admin/api/2025-10/products/count.json?status=active');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new ShopifyToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://shopify.dev/docs/api/admin-rest', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertGreaterThanOrEqual(110, count($tools));
        self::assertArrayHasKey('shopify_api_get', $tools);
        self::assertArrayHasKey('shopify_set_inventory_level', $tools);
        self::assertArrayHasKey('shopify_calculate_order_refund', $tools);
        self::assertArrayHasKey('shopify_list_assets', $tools);

        self::assertSame(['success' => false, 'error' => 'Access token is required.'], $provider->testConnection(['shop_domain' => 'demo.myshopify.com']));
        self::assertSame(['success' => false, 'error' => 'Shop domain or base URL is required.'], $provider->testConnection(['access_token' => 'token_test']));

        Http::fake(['*' => Http::response(['shop' => ['name' => 'Demo']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Shopify Admin REST API.'], $provider->testConnection([
            'access_token' => 'token_test',
            'shop_domain' => 'demo.myshopify.com',
            'api_version' => '2025-10',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://demo.myshopify.com/admin/api/2025-10/shop.json'
            && $request->hasHeader('X-Shopify-Access-Token', 'token_test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['orders' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['shopify', 'access_token', 'store-a'] => 'account-token',
                    ['shopify', 'shop_domain', 'store-a'] => 'account.myshopify.com',
                    ['shopify', 'api_version', 'store-a'] => '2025-10',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'shopify' && $account === 'store-a';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'shopify' ? ['store-a'] : [];
            }
        });

        $tool = $provider->createTool(ShopifyListOrders::class, ['account' => 'store-a']);
        self::assertTrue($tool->execute(['limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account.myshopify.com/admin/api/2025-10/orders.json?limit=1'
            && $request->hasHeader('X-Shopify-Access-Token', 'account-token'));
    }
}
