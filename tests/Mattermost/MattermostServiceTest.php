<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Mattermost;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\Integrations\Mattermost\MattermostToolProvider;
use OpenCompany\Integrations\Mattermost\Tools\MattermostApiGet;
use OpenCompany\Integrations\Mattermost\Tools\MattermostCreateChannel;
use OpenCompany\Integrations\Mattermost\Tools\MattermostPatchPost;
use OpenCompany\Integrations\Mattermost\Tools\MattermostSearchUsers;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Mattermost endpoint mapping and provider metadata.
 */
final class MattermostServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(MattermostService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(MattermostService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_supports_raw_methods_and_token_auth(): void
    {
        Http::fake(['*' => Http::response([], 200)]);

        $service = new MattermostService('mm-token', 'https://mattermost.example.test');
        $service->apiGet('/users', ['page' => 1]);
        $service->apiPost('/posts', ['channel_id' => 'channel-123', 'message' => 'Hello']);
        $service->apiPut('/posts/post-123/patch', ['message' => 'Updated']);
        $service->apiPatch('/api/v4/users/user-123/roles', ['roles' => 'system_user']);
        $service->apiDelete('/posts/post-123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer mm-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://mattermost.example.test/api/v4/users?page=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://mattermost.example.test/api/v4/posts'
            && $request['message'] === 'Hello');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://mattermost.example.test/api/v4/posts/post-123/patch'
            && $request['message'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://mattermost.example.test/api/v4/users/user-123/roles');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://mattermost.example.test/api/v4/posts/post-123');
    }

    public function test_endpoint_tools_map_paths_query_and_bodies(): void
    {
        $service = new MattermostService('mm-token', 'https://mattermost.example.test');

        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new MattermostApiGet($service))->execute([
            'path' => '/users',
            'query' => ['page' => 1],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mattermost.example.test/api/v4/users?page=1');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new MattermostSearchUsers($service))->execute([
            'term' => 'alex',
            'team_id' => 'team-123',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mattermost.example.test/api/v4/users/search'
            && $request['term'] === 'alex'
            && $request['team_id'] === 'team-123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new MattermostCreateChannel($service))->execute([
            'team_id' => 'team-123',
            'name' => 'release-updates',
            'display_name' => 'Release Updates',
            'type' => 'O',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mattermost.example.test/api/v4/channels'
            && $request['team_id'] === 'team-123'
            && $request['display_name'] === 'Release Updates');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new MattermostPatchPost($service))->execute([
            'post_id' => 'post-123',
            'message' => 'Updated message',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mattermost.example.test/api/v4/posts/post-123/patch'
            && $request['message'] === 'Updated message');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new MattermostToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.mattermost.com/api-documentation/', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(40, count($tools));
        self::assertArrayHasKey('mattermost_api_get', $tools);
        self::assertArrayHasKey('mattermost_search_users', $tools);
        self::assertArrayHasKey('mattermost_create_channel', $tools);
        self::assertArrayHasKey('mattermost_create_reaction', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new MattermostService('mm-token'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No access token provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['username' => 'alex'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Mattermost as @alex at https://mattermost.example.com.'], $provider->testConnection([
            'access_token' => 'mm-token',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mattermost.example.com/api/v4/users/me');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['mattermost', 'access_token', 'ops'] => 'account-token',
                    ['mattermost', 'url', 'ops'] => 'https://mattermost.internal.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'mattermost' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'mattermost' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(MattermostApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/users/me'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mattermost.internal.example.test/api/v4/users/me'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
