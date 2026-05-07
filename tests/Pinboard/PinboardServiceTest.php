<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Pinboard;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Pinboard\PinboardService;
use OpenCompany\Integrations\Pinboard\PinboardToolProvider;
use OpenCompany\Integrations\Pinboard\Tools\PinboardApiGet;
use OpenCompany\Integrations\Pinboard\Tools\PinboardNotesList;
use OpenCompany\Integrations\Pinboard\Tools\PinboardPostsAdd;
use OpenCompany\Integrations\Pinboard\Tools\PinboardPostsRecent;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Pinboard v1 API.
 */
final class PinboardServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PinboardService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PinboardService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new PinboardToolProvider();

        self::assertSame('pinboard', $provider->appName());
        self::assertSame('Pinboard', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(16, $provider->tools());
        self::assertCount(15, PinboardService::operations());
        self::assertArrayHasKey('pinboard_posts_add', $provider->tools());
        self::assertArrayHasKey('pinboard_posts_suggest', $provider->tools());
        self::assertArrayHasKey('pinboard_notes_get', $provider->tools());
        self::assertArrayHasKey('pinboard_api_get', $provider->tools());
    }

    public function test_service_maps_documented_pinboard_endpoints(): void
    {
        Http::fake(['https://api.pinboard.test/v1/*' => Http::response(['result_code' => 'done'], 200)]);

        $service = new PinboardService('user:token', 'https://api.pinboard.test/v1');
        $service->call('posts_update');
        $service->call('posts_add', ['url' => 'https://example.test/article', 'description' => 'Example', 'tags' => 'research']);
        $service->call('posts_delete', ['url' => 'https://example.test/article']);
        $service->call('posts_get', ['dt' => '2026-05-07']);
        $service->call('posts_recent', ['tag' => 'research', 'count' => 10]);
        $service->call('posts_all', ['start' => 0, 'results' => 100, 'meta' => 'yes']);
        $service->call('posts_dates');
        $service->call('posts_suggest', ['url' => 'https://example.test/article']);
        $service->call('tags_get');
        $service->call('tags_delete', ['tag' => 'old']);
        $service->call('tags_rename', ['old' => 'old', 'new' => 'new']);
        $service->call('user_secret');
        $service->call('user_api_token');
        $service->call('notes_list');
        $service->call('notes_get', ['note_id' => 'note:abc123']);
        $service->apiGet('/posts/recent', ['count' => 5]);

        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'auth_token=user%3Atoken')
            && str_contains($request->url(), 'format=json'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pinboard.test/v1/posts/update?format=json&auth_token=user%3Atoken');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.pinboard.test/v1/posts/add?')
            && str_contains($request->url(), 'url=https%3A%2F%2Fexample.test%2Farticle')
            && str_contains($request->url(), 'description=Example'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.pinboard.test/v1/posts/recent?')
            && str_contains($request->url(), 'tag=research')
            && str_contains($request->url(), 'count=10'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.pinboard.test/v1/posts/all?')
            && str_contains($request->url(), 'results=100')
            && str_contains($request->url(), 'meta=yes'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.pinboard.test/v1/posts/suggest?')
            && str_contains($request->url(), 'url=https%3A%2F%2Fexample.test%2Farticle'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.pinboard.test/v1/tags/rename?')
            && str_contains($request->url(), 'old=old')
            && str_contains($request->url(), 'new=new'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pinboard.test/v1/notes/note%3Aabc123?format=json&auth_token=user%3Atoken');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.pinboard.test/v1/posts/recent?')
            && str_contains($request->url(), 'count=5'));
    }

    public function test_tools_validate_required_values_paths_and_configuration(): void
    {
        Http::fake(['https://api.pinboard.test/v1/*' => Http::response(['result_code' => 'done'], 200)]);

        $service = new PinboardService('user:token', 'https://api.pinboard.test/v1');

        self::assertTrue((new PinboardPostsAdd($service))->execute([
            'url' => 'https://example.test/article',
            'description' => 'Example',
            'payload' => ['tags' => 'research'],
        ])->succeeded());
        self::assertTrue((new PinboardPostsRecent($service))->execute(['payload' => ['count' => 5]])->succeeded());
        self::assertTrue((new PinboardNotesList($service))->execute([])->succeeded());

        $missing = (new PinboardPostsAdd($service))->execute(['url' => 'https://example.test/article']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('description is required', (string) $missing->error);

        $badRaw = (new PinboardApiGet($service))->execute(['path' => 'https://evil.example.test/posts/recent']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new PinboardApiGet(new PinboardService('', 'https://api.pinboard.test/v1')))->execute(['path' => '/posts/recent']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new PinboardToolProvider();

        self::assertSame(['success' => false, 'error' => 'Pinboard auth token is required.'], $provider->testConnection([]));

        Http::fake(['https://api.pinboard.in/v1/posts/update*' => Http::response(['update_time' => '2026-05-07T00:00:00Z'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Pinboard API.'], $provider->testConnection([
            'auth_token' => 'user:token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.pinboard.test/v1/notes/list*' => Http::response(['notes' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['pinboard', 'auth_token', 'ops'] => 'account:token',
                    ['pinboard', 'url', 'ops'] => 'https://ops.pinboard.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'pinboard' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'pinboard' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(PinboardNotesList::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://ops.pinboard.test/v1/notes/list?')
            && str_contains($request->url(), 'auth_token=account%3Atoken'));
    }
}
