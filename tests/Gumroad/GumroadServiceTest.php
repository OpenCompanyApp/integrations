<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Gumroad;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Gumroad\GumroadService;
use OpenCompany\Integrations\Gumroad\GumroadToolProvider;
use OpenCompany\Integrations\Gumroad\Tools\GumroadApiGet;
use OpenCompany\Integrations\Gumroad\Tools\GumroadListSales;
use OpenCompany\Integrations\Gumroad\Tools\GumroadRefundSale;
use OpenCompany\Integrations\Gumroad\Tools\GumroadVerifyLicense;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Gumroad endpoint mapping and metadata.
 */
final class GumroadServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(GumroadService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(GumroadService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_maps_methods_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['success' => true], 200)]);

        $service = new GumroadService('token_test', 'https://api.example.test/v2');
        $service->apiGet('/sales', ['page' => 2]);
        $service->apiPost('/licenses/verify', ['product_permalink' => 'demo']);
        $service->apiPut('/sales/sale_123/refund', ['reason' => 'requested']);
        $service->apiDelete('/resource_subscriptions/sub_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer token_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.example.test/v2/sales?page=2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.example.test/v2/licenses/verify' && $request['product_permalink'] === 'demo');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.example.test/v2/sales/sale_123/refund' && $request['reason'] === 'requested');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.example.test/v2/resource_subscriptions/sub_123');
    }

    public function test_endpoint_tools_map_query_body_and_raw_paths(): void
    {
        $service = new GumroadService('token_test', 'https://api.example.test/v2');

        Http::fake(['*' => Http::response(['sales' => []], 200)]);
        self::assertTrue((new GumroadListSales($service))->execute(['product_id' => 'prod_123', 'page' => 2])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/v2/sales?page=2&product_id=prod_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['purchase' => ['license_key' => 'AAAA']], 200)]);
        self::assertTrue((new GumroadVerifyLicense($service))->execute(['product_permalink' => 'demo', 'license_key' => 'AAAA'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.example.test/v2/licenses/verify' && $request['license_key'] === 'AAAA');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true], 200)]);
        self::assertTrue((new GumroadRefundSale($service))->execute(['sale_id' => 'sale_123', 'payload' => ['reason' => 'requested']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.example.test/v2/sales/sale_123/refund' && $request['reason'] === 'requested');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['sale' => ['id' => 'sale_123']], 200)]);
        self::assertTrue((new GumroadApiGet($service))->execute(['path' => '/sales/sale_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/v2/sales/sale_123');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new GumroadToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://help.gumroad.com/article/280-gumroad-api', $provider->integrationMeta()['docs_url']);
        self::assertCount(27, $tools);
        self::assertArrayHasKey('gumroad_verify_license', $tools);
        self::assertArrayHasKey('gumroad_create_resource_subscription', $tools);
        self::assertArrayHasKey('gumroad_api_get', $tools);

        self::assertSame(['success' => false, 'error' => 'Access token is required.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['user' => ['name' => 'Ada']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Gumroad API as Ada.'], $provider->testConnection(['access_token' => 'token_test']));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.gumroad.com/v2/user' && $request->hasHeader('Authorization', 'Bearer token_test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['sales' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['gumroad', 'access_token', 'seller'] => 'account-token',
                    ['gumroad', 'url', 'seller'] => 'https://gumroad.example.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'gumroad' && $account === 'seller';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'gumroad' ? ['seller'] : [];
            }
        });

        $tool = $provider->createTool(GumroadListSales::class, ['account' => 'seller']);
        self::assertTrue($tool->execute(['page' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://gumroad.example.test/v2/sales?page=1' && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
