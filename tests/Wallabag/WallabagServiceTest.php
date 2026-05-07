<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Wallabag;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Wallabag\Tools\WallabagApiGet;
use OpenCompany\Integrations\Wallabag\Tools\WallabagEntriesCreate;
use OpenCompany\Integrations\Wallabag\Tools\WallabagEntriesList;
use OpenCompany\Integrations\Wallabag\Tools\WallabagTokenPassword;
use OpenCompany\Integrations\Wallabag\WallabagService;
use OpenCompany\Integrations\Wallabag\WallabagToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the wallabag API.
 */
final class WallabagServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(WallabagService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(WallabagService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new WallabagToolProvider();

        self::assertSame('wallabag', $provider->appName());
        self::assertSame('wallabag', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_password', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(21, $provider->tools());
        self::assertCount(17, WallabagService::operations());
        self::assertArrayHasKey('wallabag_token_password', $provider->tools());
        self::assertArrayHasKey('wallabag_entries_export', $provider->tools());
        self::assertArrayHasKey('wallabag_annotations_create', $provider->tools());
        self::assertArrayHasKey('wallabag_api_get', $provider->tools());
    }

    public function test_service_maps_oauth_entries_tags_exports_and_annotations(): void
    {
        Http::fake([
            'https://wallabag.test/api/entries/123/export.txt' => Http::response('article text', 200),
            'https://wallabag.test/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new WallabagService('access-token', 'client-id', 'client-secret', 'reader@example.test', 'fake-password', 'refresh-token', 'https://wallabag.test');
        $token = $service->call('token_password');
        $refresh = $service->call('token_refresh');
        $service->call('entries_list', ['perPage' => 30]);
        $service->call('entries_create', ['url' => 'https://example.test/article', 'title' => 'Example']);
        $service->call('entries_exists', ['url' => 'https://example.test/article']);
        $service->call('entries_get', ['entry' => '123']);
        $service->call('entries_update', ['entry' => '123', 'is_archived' => 1]);
        $service->call('entries_delete', ['entry' => '123']);
        $service->call('entries_reload', ['entry' => '123']);
        $export = $service->call('entries_export', ['entry' => '123', 'format' => 'txt']);
        $service->call('tags_list');
        $service->call('entry_tags_add', ['entry' => '123', 'tags' => 'research,priority']);
        $service->call('entry_tag_delete', ['entry' => '123', 'tag' => 'priority']);
        $service->call('annotations_list', ['entry' => '123']);
        $service->call('annotations_create', ['entry' => '123', 'text' => 'Note', 'ranges' => [['start' => '/p[1]']]]);
        $service->call('annotations_update', ['annotation' => '456', 'text' => 'Updated']);
        $service->call('annotations_delete', ['annotation' => '456']);
        $service->apiGet('/api/entries.json', ['perPage' => 5]);

        self::assertTrue($token['ok']);
        self::assertTrue($refresh['ok']);
        self::assertSame('article text', $export['value']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://wallabag.test/oauth/v2/token'
            && $request->data()['grant_type'] === 'password'
            && $request->data()['client_id'] === 'client-id'
            && $request->data()['username'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://wallabag.test/oauth/v2/token'
            && $request->data()['grant_type'] === 'refresh_token'
            && $request->data()['refresh_token'] === 'refresh-token');
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer access-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://wallabag.test/api/entries.json?perPage=30');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://wallabag.test/api/entries.json' && $request->data()['url'] === 'https://example.test/article');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://wallabag.test/api/entries/exists.json?url='));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://wallabag.test/api/entries/123.json' && $request->data()['is_archived'] === 1);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://wallabag.test/api/entries/123.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://wallabag.test/api/entries/123/reload.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://wallabag.test/api/entries/123/export.txt');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://wallabag.test/api/entries/123/tags.json' && $request->data()['tags'] === 'research,priority');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://wallabag.test/api/entries/123/tags/priority.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://wallabag.test/api/annotations/123.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://wallabag.test/api/annotations/123.json' && $request->data()['text'] === 'Note');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://wallabag.test/api/annotations/456.json' && $request->data()['text'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://wallabag.test/api/annotations/456.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://wallabag.test/api/entries.json?perPage=5');
    }

    public function test_tools_validate_required_values_paths_and_configuration(): void
    {
        Http::fake(['https://wallabag.test/*' => Http::response(['ok' => true], 200)]);

        $service = new WallabagService('access-token', 'client-id', 'client-secret', 'reader@example.test', 'fake-password', 'refresh-token', 'https://wallabag.test');

        self::assertTrue((new WallabagTokenPassword($service))->execute([])->succeeded());
        self::assertTrue((new WallabagEntriesCreate($service))->execute([
            'url' => 'https://example.test/article',
            'payload' => ['tags' => 'research'],
        ])->succeeded());
        self::assertTrue((new WallabagEntriesList($service))->execute(['payload' => ['perPage' => 10]])->succeeded());

        $missing = (new WallabagEntriesCreate($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('url is required', (string) $missing->error);

        $badRaw = (new WallabagApiGet($service))->execute(['path' => 'https://evil.example.test/api/entries.json']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new WallabagApiGet(new WallabagService('', baseUrl: 'https://wallabag.test')))->execute(['path' => '/api/entries.json']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new WallabagToolProvider();

        self::assertSame(['success' => false, 'error' => 'wallabag access token is required.'], $provider->testConnection([]));

        Http::fake(['https://app.wallabag.it/api/entries.json*' => Http::response(['_embedded' => ['items' => []]], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to wallabag API.'], $provider->testConnection([
            'access_token' => 'access-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.wallabag.test/api/entries.json*' => Http::response(['_embedded' => ['items' => []]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['wallabag', 'access_token', 'ops'] => 'account-token',
                    ['wallabag', 'url', 'ops'] => 'https://ops.wallabag.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'wallabag' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'wallabag' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(WallabagEntriesList::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.wallabag.test/api/entries.json'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
