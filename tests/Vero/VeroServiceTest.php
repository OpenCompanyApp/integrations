<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Vero;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Vero\Tools\VeroAliasUser;
use OpenCompany\Integrations\Vero\Tools\VeroApiGet;
use OpenCompany\Integrations\Vero\Tools\VeroEditTags;
use OpenCompany\Integrations\Vero\Tools\VeroTrackEvent;
use OpenCompany\Integrations\Vero\VeroService;
use OpenCompany\Integrations\Vero\VeroToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Vero Track REST API path and auth handling.
 */
final class VeroServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_official_track_api_endpoints_and_query_auth(): void
    {
        Http::fake([
            'https://api.getvero.com/api/v2/*' => Http::response(['status' => 200, 'message' => 'Success.'], 200),
        ]);

        $service = new VeroService('vero_test');

        $service->identifyUser('1000', 'person@example.test', 'Example User', ['plan' => 'trial'], [
            ['type' => 'push', 'address' => 'token', 'platform' => 'android'],
        ]);
        $service->updateUser('1000', '', ['plan' => 'paid']);
        $service->aliasUser('anon_1', '1000');
        $service->unsubscribe('1000');
        $service->resubscribe('1000');
        $service->deleteUser('1000');
        $service->editTags('1000', ['prospect'], ['inactive']);
        $service->trackEvent(['id' => '1000', 'email' => 'person@example.test'], 'Viewed product', ['sku' => 'sku_1'], ['source' => 'test']);
        $service->apiGet('/campaigns', ['page' => 1]);
        $service->apiPost('/users/track', ['id' => '2000', 'email' => 'other@example.test']);
        $service->apiPut('/users/tags/edit', ['id' => '2000', 'add' => ['trial']]);
        $service->apiDelete('/example-resource/1');

        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'auth_token=vero_test'));
        Http::assertSent(static fn (Request $request): bool => ! $request->hasHeader('Authorization'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.getvero.com/api/v2/users/track?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && str_starts_with($request->url(), 'https://api.getvero.com/api/v2/users/reidentify?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.getvero.com/api/v2/users/unsubscribe?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.getvero.com/api/v2/users/resubscribe?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.getvero.com/api/v2/users/delete?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && str_starts_with($request->url(), 'https://api.getvero.com/api/v2/users/tags/edit?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.getvero.com/api/v2/events/track?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'https://api.getvero.com/api/v2/campaigns?'));
    }

    public function test_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.getvero.com/api/v2/*' => Http::response(['status' => 200, 'message' => 'Success.'], 200),
        ]);

        $service = new VeroService('vero_test');

        self::assertTrue((new VeroAliasUser($service))->execute([
            'id' => 'anon_1',
            'new_id' => '1000',
        ])->succeeded());
        self::assertTrue((new VeroEditTags($service))->execute([
            'id' => '1000',
            'add' => ['prospect'],
        ])->succeeded());
        self::assertTrue((new VeroTrackEvent($service))->execute([
            'identity' => ['id' => '1000', 'email' => 'person@example.test'],
            'event_name' => 'Viewed product',
            'data' => ['sku' => 'sku_1'],
        ])->succeeded());
        self::assertTrue((new VeroApiGet($service))->execute([
            'path' => '/campaigns',
            'params' => ['page' => 1],
        ])->succeeded());
        self::assertFalse((new VeroAliasUser($service))->execute([
            'id' => 'anon_1',
        ])->succeeded());
        self::assertFalse((new VeroApiGet($service))->execute([
            'path' => 'https://example.test/campaigns',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        $provider = new VeroToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('vero_alias_user', $tools);
        self::assertArrayHasKey('vero_delete_user', $tools);
        self::assertArrayHasKey('vero_edit_tags', $tools);
        self::assertArrayHasKey('vero_track_event', $tools);
        self::assertArrayHasKey('vero_api_put', $tools);
        self::assertArrayHasKey('vero_api_delete', $tools);
        self::assertSame(13, count($tools));
        self::assertTrue($provider->testConnection([
            'auth_token' => 'vero_test',
        ])['success']);
    }
}
