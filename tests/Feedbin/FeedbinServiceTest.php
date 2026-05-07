<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Feedbin;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Feedbin\FeedbinService;
use OpenCompany\Integrations\Feedbin\FeedbinToolProvider;
use OpenCompany\Integrations\Feedbin\Tools\FeedbinApiGet;
use OpenCompany\Integrations\Feedbin\Tools\FeedbinEntriesList;
use OpenCompany\Integrations\Feedbin\Tools\FeedbinSubscriptionsCreate;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Feedbin API V2.
 */
final class FeedbinServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(FeedbinService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(FeedbinService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new FeedbinToolProvider();

        self::assertSame('feedbin', $provider->appName());
        self::assertSame('Feedbin', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('basic', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(46, $provider->tools());
        self::assertCount(42, FeedbinService::operations());
        self::assertArrayHasKey('feedbin_subscriptions_create', $provider->tools());
        self::assertArrayHasKey('feedbin_unread_entries_delete_post', $provider->tools());
        self::assertArrayHasKey('feedbin_imports_create', $provider->tools());
        self::assertArrayHasKey('feedbin_api_get', $provider->tools());
    }

    public function test_service_maps_documented_feedbin_endpoints(): void
    {
        Http::fake(['https://feedbin.test/v2/*' => Http::response(['ok' => true], 200, ['X-Feedbin-Record-Count' => '9'])]);

        $service = new FeedbinService('reader@example.test', 'secret', 'https://feedbin.test/v2');
        $service->call('authentication_check');
        $service->call('subscriptions_list', ['since' => '2026-05-07T00:00:00Z']);
        $service->call('subscriptions_create', ['feed_url' => 'https://example.test/feed.xml']);
        $service->call('subscriptions_update', ['subscription_id' => '10', 'title' => 'Custom']);
        $service->call('subscriptions_delete', ['subscription_id' => '10']);
        $service->call('feeds_get', ['feed_id' => '47']);
        $service->call('entries_list', ['ids' => '1,2,3']);
        $service->call('feed_entries_list', ['feed_id' => '47', 'page' => 2]);
        $service->call('entries_get', ['entry_id' => '1']);
        $service->call('unread_entries_create', ['unread_entries' => [1, 2]]);
        $service->call('unread_entries_delete_post', ['unread_entries' => [1]]);
        $service->call('starred_entries_create', ['starred_entries' => [1]]);
        $service->call('starred_entries_delete', ['starred_entries' => [1]]);
        $service->call('taggings_create', ['feed_id' => 47, 'name' => 'Research']);
        $service->call('tags_create', ['old_name' => 'old', 'new_name' => 'new']);
        $service->call('saved_searches_create', ['name' => 'Unread', 'query' => 'is:unread']);
        $service->call('saved_searches_update_post', ['saved_search_id' => '2', 'name' => 'Updated']);
        $service->call('recently_read_entries_create', ['recently_read_entries' => [1]]);
        $service->call('updated_entries_delete', ['updated_entries' => [1]]);
        $service->call('icons_list');
        $service->call('imports_create', ['opml' => '<opml version="2.0"></opml>']);
        $service->call('imports_get', ['import_id' => '6']);
        $service->call('pages_create', ['url' => 'https://example.test/article']);
        $service->call('pages_delete', ['page_id' => '3']);
        $raw = $service->apiGet('/entries.json', ['per_page' => 5]);

        self::assertSame('9', $raw['record_count']);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('reader@example.test:secret')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://feedbin.test/v2/subscriptions.json?since='));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://feedbin.test/v2/subscriptions.json' && $request->data()['feed_url'] === 'https://example.test/feed.xml');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://feedbin.test/v2/subscriptions/10.json' && $request->data()['title'] === 'Custom');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://feedbin.test/v2/subscriptions/10.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://feedbin.test/v2/feeds/47/entries.json?page=2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://feedbin.test/v2/unread_entries.json' && $request->data()['unread_entries'][0] === 1);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://feedbin.test/v2/unread_entries/delete.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://feedbin.test/v2/starred_entries.json' && $request->data()['starred_entries'][0] === 1);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://feedbin.test/v2/taggings.json' && $request->data()['feed_id'] === 47);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://feedbin.test/v2/imports.json' && str_contains((string) $request->body(), '<opml'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://feedbin.test/v2/pages.json' && $request->data()['url'] === 'https://example.test/article');
    }

    public function test_tools_validate_paths_and_configuration(): void
    {
        Http::fake(['https://feedbin.test/v2/*' => Http::response(['ok' => true], 200)]);

        $service = new FeedbinService('reader@example.test', 'secret', 'https://feedbin.test/v2');

        self::assertTrue((new FeedbinSubscriptionsCreate($service))->execute(['feed_url' => 'https://example.test/feed.xml'])->succeeded());
        self::assertTrue((new FeedbinEntriesList($service))->execute(['payload' => ['per_page' => 10]])->succeeded());

        $missing = (new FeedbinSubscriptionsCreate($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('feed_url is required', (string) $missing->error);

        $badRaw = (new FeedbinApiGet($service))->execute(['path' => 'https://evil.example.test/entries.json']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new FeedbinApiGet(new FeedbinService('', '', 'https://feedbin.test/v2')))->execute(['path' => '/entries.json']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new FeedbinToolProvider();

        self::assertSame(['success' => false, 'error' => 'Feedbin username and password are required.'], $provider->testConnection([]));

        Http::fake(['https://api.feedbin.com/v2/authentication.json' => Http::response(['ok' => true], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Feedbin API.'], $provider->testConnection([
            'username' => 'reader@example.test',
            'password' => 'secret',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.feedbin.test/v2/entries.json' => Http::response([], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['feedbin', 'username', 'ops'] => 'account@example.test',
                    ['feedbin', 'password', 'ops'] => 'account-secret',
                    ['feedbin', 'url', 'ops'] => 'https://ops.feedbin.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'feedbin' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'feedbin' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(FeedbinEntriesList::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.feedbin.test/v2/entries.json'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('account@example.test:account-secret')));
    }
}
