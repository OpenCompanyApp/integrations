<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\LemonSqueezy;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyToolProvider;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyApiGet;
use OpenCompany\Integrations\LemonSqueezy\Tools\LemonSqueezyCreateCheckout;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Lemon Squeezy API integration.
 */
final class LemonSqueezyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(LemonSqueezyService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(LemonSqueezyService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new LemonSqueezyToolProvider;

        self::assertSame('lemon-squeezy', $provider->appName());
        self::assertSame('Lemon Squeezy', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(56, $provider->tools());
        self::assertArrayHasKey('lemonsqueezy_list_stores', $provider->tools());
        self::assertArrayHasKey('lemonsqueezy_create_checkout', $provider->tools());
        self::assertArrayHasKey('lemonsqueezy_update_subscription_item', $provider->tools());
        self::assertArrayHasKey('lemonsqueezy_list_license_keys', $provider->tools());
        self::assertArrayHasKey('lemonsqueezy_api_delete', $provider->tools());
    }

    public function test_service_maps_json_api_resources_special_actions_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new LemonSqueezyService('token-test', 'https://example.test');
        $service->listResource('stores', ['page[size]' => 25, 'include' => ['products', 'orders']]);
        $service->getResource('products', 123);
        $service->createResource('customers', ['name' => 'Ada'], ['store' => ['data' => ['type' => 'stores', 'id' => '1']]]);
        $service->updateResource('subscription-items', 456, ['quantity' => 10]);
        $service->deleteResource('discounts', 77);
        $service->generateOrderInvoice(88, ['name' => 'Ada']);
        $service->refundOrder(99, ['amount' => 500]);
        $service->apiGet('/v1/orders', ['filter[store_id]' => 1, 'include' => ['customer', 'order-items']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/stores?page%5Bsize%5D=25&include=products&include=orders'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/products/123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/customers'
            && $request['data']['type'] === 'customers'
            && $request['data']['attributes']['name'] === 'Ada'
            && $request['data']['relationships']['store']['data']['id'] === '1');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://example.test/v1/subscription-items/456'
            && $request['data']['id'] === '456'
            && $request['data']['attributes']['quantity'] === 10);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://example.test/v1/discounts/77');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/orders/88/generate-invoice'
            && $request['name'] === 'Ada');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/orders/99/refund'
            && $request['amount'] === 500);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/orders?filter%5Bstore_id%5D=1&include=customer&include=order-items');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/v1/orders');
    }

    public function test_tools_validate_arguments_and_unconfigured_service(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new LemonSqueezyService('token-test', 'https://example.test');
        $checkout = (new LemonSqueezyCreateCheckout($service))->execute([
            'attributes' => ['custom_price' => 1200],
            'relationships' => ['store' => ['data' => ['type' => 'stores', 'id' => '1']]],
        ]);
        $raw = (new LemonSqueezyApiGet($service))->execute(['path' => '/v1/stores']);

        self::assertTrue($checkout->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new LemonSqueezyApiGet($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('path is required', (string) $missing->error);

        $unconfigured = (new LemonSqueezyApiGet(new LemonSqueezyService('', 'https://example.test')))->execute(['path' => '/v1/stores']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_current_user_endpoint(): void
    {
        Http::fake(['*' => Http::response(['data' => ['attributes' => ['name' => 'Ada', 'email' => 'ada@example.test']]], 200)]);

        $result = (new LemonSqueezyToolProvider)->testConnection([
            'api_key' => 'token-test',
            'url' => 'https://example.test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/users/me'
            && $request->hasHeader('Authorization', 'Bearer token-test'));
    }
}
