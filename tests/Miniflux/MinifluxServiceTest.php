<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Miniflux;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Miniflux\MinifluxService;
use OpenCompany\Integrations\Miniflux\MinifluxToolProvider;
use OpenCompany\Integrations\Miniflux\Tools\MinifluxApiGet;
use OpenCompany\Integrations\Miniflux\Tools\MinifluxEntriesList;
use OpenCompany\Integrations\Miniflux\Tools\MinifluxFeedsCreate;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Miniflux REST API integration.
 */
final class MinifluxServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(MinifluxService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(MinifluxService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new MinifluxToolProvider();

        self::assertSame('miniflux', $provider->appName());
        self::assertSame('Miniflux', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token_or_basic', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(56, $provider->tools());
        self::assertCount(51, MinifluxService::operations());
        self::assertArrayHasKey('miniflux_feeds_create', $provider->tools());
        self::assertArrayHasKey('miniflux_entries_update_status', $provider->tools());
        self::assertArrayHasKey('miniflux_opml_import', $provider->tools());
        self::assertArrayHasKey('miniflux_api_put', $provider->tools());
    }

    public function test_service_maps_documented_miniflux_endpoints(): void
    {
        Http::fake(['https://miniflux.test/*' => Http::response(['ok' => true], 200)]);

        $service = new MinifluxService('token', '', '', 'https://miniflux.test');
        $service->call('discover', ['url' => 'https://example.test']);
        $service->call('flush_history');
        $service->call('feeds_list');
        $service->call('category_feeds_list', ['category_id' => 2]);
        $service->call('feeds_get', ['feed_id' => 10]);
        $service->call('feed_icon_get', ['feed_id' => 10]);
        $service->call('icon_get', ['icon_id' => 5]);
        $service->call('feeds_mark_all_read', ['feed_id' => 10]);
        $service->call('feeds_create', ['feed_url' => 'https://example.test/feed.xml', 'category_id' => 2]);
        $service->call('feeds_update', ['feed_id' => 10, 'title' => 'Updated']);
        $service->call('feeds_refresh', ['feed_id' => 10]);
        $service->call('feeds_refresh_all');
        $service->call('feeds_delete', ['feed_id' => 10]);
        $service->call('feed_entry_get', ['feed_id' => 10, 'entry_id' => 99]);
        $service->call('entries_get', ['entry_id' => 99]);
        $service->call('entries_import', ['feed_id' => 10, 'url' => 'https://example.test/article', 'title' => 'Manual']);
        $service->call('entries_update', ['entry_id' => 99, 'title' => 'Updated']);
        $service->call('entries_save', ['entry_id' => 99]);
        $service->call('entries_fetch_content', ['entry_id' => 99, 'update_content' => true]);
        $service->call('feed_entries_list', ['feed_id' => 10, 'limit' => 5]);
        $service->call('category_entries_list', ['category_id' => 2, 'status' => 'unread']);
        $service->call('entries_list', ['status' => 'unread', 'direction' => 'desc']);
        $service->call('entries_update_status', ['entry_ids' => [99], 'status' => 'read']);
        $service->call('entries_toggle_bookmark', ['entry_id' => 99]);
        $service->call('enclosures_get', ['enclosure_id' => 8]);
        $service->call('enclosures_update', ['enclosure_id' => 8, 'media_progression' => 42]);
        $service->call('categories_list', ['counts' => true]);
        $service->call('categories_create', ['title' => 'Research']);
        $service->call('categories_update', ['category_id' => 2, 'title' => 'Updated']);
        $service->call('categories_refresh', ['category_id' => 2]);
        $service->call('categories_delete', ['category_id' => 2]);
        $service->call('categories_mark_all_read', ['category_id' => 2]);
        $service->call('opml_export');
        $service->call('opml_import', ['opml' => '<opml version="2.0"></opml>']);
        $service->call('users_create', ['username' => 'reader', 'password' => 'secret']);
        $service->call('users_update', ['user_id' => 7, 'timezone' => 'UTC']);
        $service->call('me_get');
        $service->call('users_get', ['user_id' => 'reader']);
        $service->call('users_list');
        $service->call('users_delete', ['user_id' => 7]);
        $service->call('integrations_status');
        $service->call('users_mark_all_read', ['user_id' => 7]);
        $service->call('feed_counters_get');
        $service->call('api_keys_list');
        $service->call('api_keys_create', ['description' => 'Agent key']);
        $service->call('api_keys_delete', ['api_key_id' => 3]);
        $service->call('healthcheck');
        $service->call('liveness');
        $service->call('readiness');
        $service->call('version_legacy');
        $raw = $service->apiPut('/v1/feeds/10', ['title' => 'Raw']);

        self::assertSame(200, $raw['status']);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Auth-Token', 'token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://miniflux.test/v1/discover' && $request->data()['url'] === 'https://example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://miniflux.test/v1/flush-history');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://miniflux.test/v1/categories/2/feeds');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://miniflux.test/v1/feeds' && $request->data()['feed_url'] === 'https://example.test/feed.xml');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://miniflux.test/v1/entries/99/fetch-content?update_content=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://miniflux.test/v1/entries' && $request->data()['status'] === 'read');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://miniflux.test/v1/import' && str_contains((string) $request->body(), '<opml'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://miniflux.test/integrations/status');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://miniflux.test/v1/api-keys/3');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://miniflux.test/healthcheck');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://miniflux.test/v1/feeds/10' && $request->data()['title'] === 'Raw');
    }

    public function test_tools_validate_paths_configuration_and_basic_auth(): void
    {
        Http::fake(['https://miniflux.test/*' => Http::response(['ok' => true], 200)]);

        $service = new MinifluxService('', 'reader', 'secret', 'https://miniflux.test');

        self::assertTrue((new MinifluxFeedsCreate($service))->execute(['feed_url' => 'https://example.test/feed.xml'])->succeeded());
        self::assertTrue((new MinifluxEntriesList($service))->execute(['payload' => ['limit' => 10]])->succeeded());

        $missing = (new MinifluxFeedsCreate($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('feed_url is required', (string) $missing->error);

        $badRaw = (new MinifluxApiGet($service))->execute(['path' => 'https://evil.example.test/v1/feeds']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new MinifluxApiGet(new MinifluxService('', '', '', 'https://miniflux.test')))->execute(['path' => '/v1/feeds']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('reader:secret')));
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new MinifluxToolProvider();

        self::assertSame(['success' => false, 'error' => 'Miniflux instance URL is required.'], $provider->testConnection([]));
        self::assertSame(['success' => false, 'error' => 'Miniflux API key or username/password is required.'], $provider->testConnection(['url' => 'https://miniflux.test']));

        Http::fake(['https://miniflux.test/v1/me' => Http::response(['id' => 1], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Miniflux API.'], $provider->testConnection([
            'url' => 'https://miniflux.test',
            'api_key' => 'token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.miniflux.test/v1/entries' => Http::response(['entries' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['miniflux', 'api_key', 'ops'] => 'account-token',
                    ['miniflux', 'url', 'ops'] => 'https://ops.miniflux.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'miniflux' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'miniflux' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(MinifluxEntriesList::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.miniflux.test/v1/entries'
            && $request->hasHeader('X-Auth-Token', 'account-token'));
    }
}
