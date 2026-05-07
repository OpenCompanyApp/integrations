<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Mastodon;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Mastodon\MastodonService;
use OpenCompany\Integrations\Mastodon\MastodonToolProvider;
use OpenCompany\Integrations\Mastodon\Tools\MastodonApiGet;
use OpenCompany\Integrations\Mastodon\Tools\MastodonApiPost;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Mastodon generic API coverage and timeline mapping.
 */
final class MastodonServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_local_timeline_and_generic_api_methods(): void
    {
        Http::fake([
            'https://mastodon.test/api/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new MastodonService('mastodon_test', 'https://mastodon.test');

        $service->listStatuses('local', 10);
        $service->listStatuses('list:123', 10);
        $service->apiGet('/api/v1/notifications', ['limit' => 20]);
        $service->apiPost('/api/v1/statuses/abc/favourite', []);
        $service->apiPut('/api/v1/statuses/abc', ['status' => 'Edited']);
        $service->apiDelete('/api/v1/statuses/abc', []);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer mastodon_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://mastodon.test/api/v1/timelines/public?') && str_contains($request->url(), 'local=1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://mastodon.test/api/v1/timelines/list/123?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://mastodon.test/api/v1/notifications?') && str_contains($request->url(), 'limit=20'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://mastodon.test/api/v1/statuses/abc/favourite');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://mastodon.test/api/v1/statuses/abc' && $request['status'] === 'Edited');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://mastodon.test/api/v1/statuses/abc');
    }

    public function test_generic_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://mastodon.test/api/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new MastodonService('mastodon_test', 'https://mastodon.test');

        self::assertNull((new MastodonApiGet($service))->execute([
            'path' => '/api/v1/notifications',
            'params' => ['limit' => 20],
        ])->error);
        self::assertNull((new MastodonApiPost($service))->execute([
            'path' => '/api/v1/statuses/abc/favourite',
            'body' => [],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://mastodon.test/api/v1/notifications?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://mastodon.test/api/v1/statuses/abc/favourite');
    }

    public function test_provider_exposes_generic_api_tools_and_allowed_category(): void
    {
        $provider = new MastodonToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('mastodon_api_get', $tools);
        self::assertArrayHasKey('mastodon_api_post', $tools);
        self::assertArrayHasKey('mastodon_api_put', $tools);
        self::assertArrayHasKey('mastodon_api_delete', $tools);
        self::assertSame(10, count($tools));
    }
}
