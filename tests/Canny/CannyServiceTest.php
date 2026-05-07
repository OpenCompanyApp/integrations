<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Canny;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Canny\CannyService;
use OpenCompany\Integrations\Canny\CannyToolProvider;
use OpenCompany\Integrations\Canny\Tools\CannyApiPost;
use OpenCompany\Integrations\Canny\Tools\CannyCreatePost;
use OpenCompany\Integrations\Canny\Tools\CannyListBoards;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Canny API integration.
 */
final class CannyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CannyService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CannyService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new CannyToolProvider();

        self::assertSame('canny', $provider->appName());
        self::assertSame('Canny', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(53, $provider->tools());
        self::assertCount(52, CannyService::operations());
        self::assertArrayHasKey('canny_create_post', $provider->tools());
        self::assertArrayHasKey('canny_list_votes', $provider->tools());
        self::assertArrayHasKey('canny_enqueue_feedback', $provider->tools());
        self::assertArrayHasKey('canny_api_post', $provider->tools());
    }

    public function test_service_maps_documented_canny_api_endpoints(): void
    {
        Http::fake([
            'https://canny.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new CannyService('canny-token', 'https://canny.test');
        $service->call('list_boards');
        $service->call('retrieve_board', ['id' => 'board-1']);
        $service->call('create_category', ['boardID' => 'board-1', 'name' => 'UX']);
        $service->call('list_comments', ['postID' => 'post-1', 'limit' => 10]);
        $service->call('list_companies', ['cursor' => 'cursor-1']);
        $service->call('update_company', ['id' => 'company-1', 'monthlySpend' => 1200]);
        $service->call('create_post', ['boardID' => 'board-1', 'authorID' => 'user-1', 'title' => 'Export data']);
        $service->call('change_post_status', ['postID' => 'post-1', 'status' => 'planned']);
        $service->call('list_status_changes', ['postID' => 'post-1']);
        $service->call('list_users', ['cursor' => 'cursor-2']);
        $service->call('create_vote', ['postID' => 'post-1', 'voterID' => 'user-1']);
        $service->call('enqueue_feedback', ['type' => 'conversation', 'payload' => ['id' => 'conv-1', 'authorID' => 'user-1', 'text' => 'Need exports']]);
        $service->apiPost('/api/v1/tags/list', ['limit' => 10]);

        Http::assertSent(static fn (Request $request): bool => $request->data()['apiKey'] === 'canny-token');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/boards/list');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/boards/retrieve' && $request->data()['id'] === 'board-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/categories/create' && $request->data()['boardID'] === 'board-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v2/comments/list' && $request->data()['postID'] === 'post-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v2/companies/list' && $request->data()['cursor'] === 'cursor-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/companies/update' && $request->data()['monthlySpend'] === 1200);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/posts/create' && $request->data()['title'] === 'Export data');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/posts/change_status' && $request->data()['status'] === 'planned');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v2/status_changes/list');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v2/users/list' && $request->data()['cursor'] === 'cursor-2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/votes/create' && $request->data()['voterID'] === 'user-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/ai/enqueue' && $request->data()['payload']['text'] === 'Need exports');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://canny.test/api/v1/tags/list' && $request->data()['limit'] === 10);
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://canny.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new CannyService('canny-token', 'https://canny.test');

        self::assertTrue((new CannyListBoards($service))->execute([])->succeeded());
        self::assertTrue((new CannyCreatePost($service))->execute([
            'boardID' => 'board-1',
            'authorID' => 'user-1',
            'title' => 'Export data',
            'payload' => ['details' => 'Need CSV exports'],
        ])->succeeded());

        $missing = (new CannyCreatePost($service))->execute(['boardID' => 'board-1']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('title is required', (string) $missing->error);

        $badRaw = (new CannyApiPost($service))->execute(['path' => 'https://evil.example.test/api/v1/boards/list']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new CannyApiPost(new CannyService('', 'https://canny.test')))->execute(['path' => '/api/v1/boards/list']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new CannyToolProvider();

        self::assertSame(['success' => false, 'error' => 'Canny API key is required.'], $provider->testConnection([]));

        Http::fake(['https://canny.io/api/v1/boards/list' => Http::response(['boards' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Canny API.'], $provider->testConnection([
            'api_key' => 'canny-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.canny.test/api/v1/boards/list' => Http::response(['boards' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['canny', 'api_key', 'ops'] => 'account-token',
                    ['canny', 'url', 'ops'] => 'https://ops.canny.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'canny' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'canny' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(CannyListBoards::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.canny.test/api/v1/boards/list'
            && $request->data()['apiKey'] === 'account-token');
    }
}
