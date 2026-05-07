<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Postman;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Postman\PostmanService;
use OpenCompany\Integrations\Postman\PostmanToolProvider;
use OpenCompany\Integrations\Postman\Tools\PostmanApiGet;
use OpenCompany\Integrations\Postman\Tools\PostmanCollectionsGet;
use OpenCompany\Integrations\Postman\Tools\PostmanWorkspacesList;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Postman API integration.
 */
final class PostmanServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PostmanService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PostmanService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new PostmanToolProvider();

        self::assertSame('postman', $provider->appName());
        self::assertSame('Postman', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key_header', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(63, $provider->tools());
        self::assertCount(58, PostmanService::operations());
        self::assertArrayHasKey('postman_collections_get', $provider->tools());
        self::assertArrayHasKey('postman_api_schemas_update', $provider->tools());
        self::assertArrayHasKey('postman_monitors_run', $provider->tools());
        self::assertArrayHasKey('postman_api_delete', $provider->tools());

        foreach ($provider->tools() as $tool) {
            self::assertTrue(class_exists((string) $tool['class']), (string) $tool['class']);
        }
    }

    public function test_service_maps_postman_endpoints(): void
    {
        Http::fake(['https://postman.test/*' => Http::response(['ok' => true], 200)]);

        $service = new PostmanService('pm-key', 'https://postman.test');
        $service->call('me_get');
        $service->call('workspaces_list', ['type' => 'team']);
        $service->call('workspaces_create', ['workspace' => ['name' => 'Scratch']]);
        $service->call('workspaces_get', ['workspace_id' => 'ws_123']);
        $service->call('workspaces_update', ['workspace_id' => 'ws_123', 'workspace' => ['name' => 'Updated']]);
        $service->call('workspaces_delete', ['workspace_id' => 'ws_123']);
        $service->call('collections_list', ['workspace' => 'ws_123']);
        $service->call('collections_create', ['collection' => ['info' => ['name' => 'API']]]);
        $service->call('collections_get', ['collection_uid' => 'col_123']);
        $service->call('collections_update', ['collection_uid' => 'col_123', 'collection' => ['info' => ['name' => 'Updated']]]);
        $service->call('collections_delete', ['collection_uid' => 'col_123']);
        $service->call('collection_forks_list', ['collection_uid' => 'col_123']);
        $service->call('collection_fork_create', ['collection_uid' => 'col_123', 'label' => 'Agent fork']);
        $service->call('collection_pull_requests_list', ['collection_uid' => 'col_123']);
        $service->call('environments_list', ['workspace' => 'ws_123']);
        $service->call('environments_create', ['environment' => ['name' => 'Local']]);
        $service->call('environments_get', ['environment_uid' => 'env_123']);
        $service->call('environments_update', ['environment_uid' => 'env_123', 'environment' => ['name' => 'Dev']]);
        $service->call('environments_delete', ['environment_uid' => 'env_123']);
        $service->call('globals_get');
        $service->call('globals_update', ['globals' => ['values' => []]]);
        $service->call('apis_list', ['workspace' => 'ws_123']);
        $service->call('apis_create', ['api' => ['name' => 'Orders']]);
        $service->call('apis_get', ['api_id' => 'api_123']);
        $service->call('apis_update', ['api_id' => 'api_123', 'api' => ['name' => 'Updated']]);
        $service->call('apis_delete', ['api_id' => 'api_123']);
        $service->call('api_versions_list', ['api_id' => 'api_123']);
        $service->call('api_versions_create', ['api_id' => 'api_123', 'version' => ['name' => 'v1']]);
        $service->call('api_versions_get', ['api_id' => 'api_123', 'version_id' => 'ver_123']);
        $service->call('api_versions_update', ['api_id' => 'api_123', 'version_id' => 'ver_123', 'version' => ['name' => 'v2']]);
        $service->call('api_versions_delete', ['api_id' => 'api_123', 'version_id' => 'ver_123']);
        $service->call('api_schemas_list', ['api_id' => 'api_123', 'version_id' => 'ver_123']);
        $service->call('api_schemas_create', ['api_id' => 'api_123', 'version_id' => 'ver_123', 'schema' => ['type' => 'openapi']]);
        $service->call('api_schemas_get', ['api_id' => 'api_123', 'version_id' => 'ver_123', 'schema_id' => 'sch_123']);
        $service->call('api_schemas_update', ['api_id' => 'api_123', 'version_id' => 'ver_123', 'schema_id' => 'sch_123', 'schema' => ['type' => 'openapi']]);
        $service->call('api_schemas_delete', ['api_id' => 'api_123', 'version_id' => 'ver_123', 'schema_id' => 'sch_123']);
        $service->call('mocks_list', ['workspace' => 'ws_123']);
        $service->call('mocks_create', ['mock' => ['name' => 'Mock']]);
        $service->call('mocks_get', ['mock_id' => 'mock_123']);
        $service->call('mocks_update', ['mock_id' => 'mock_123', 'mock' => ['name' => 'Updated']]);
        $service->call('mocks_delete', ['mock_id' => 'mock_123']);
        $service->call('mocks_call_logs_list', ['mock_id' => 'mock_123']);
        $service->call('monitors_list');
        $service->call('monitors_create', ['monitor' => ['name' => 'Smoke']]);
        $service->call('monitors_get', ['monitor_id' => 'mon_123']);
        $service->call('monitors_update', ['monitor_id' => 'mon_123', 'monitor' => ['name' => 'Updated']]);
        $service->call('monitors_delete', ['monitor_id' => 'mon_123']);
        $service->call('monitors_run', ['monitor_id' => 'mon_123']);
        $service->call('webhooks_create', ['webhook' => ['name' => 'Hook']]);
        $service->call('webhooks_get', ['webhook_id' => 'hook_123']);
        $service->call('webhooks_delete', ['webhook_id' => 'hook_123']);
        $service->call('users_list');
        $service->call('users_get', ['user_id' => 'user_123']);
        $service->call('groups_list');
        $service->call('groups_get', ['group_id' => 'grp_123']);
        $service->call('workspace_roles_list', ['workspace_id' => 'ws_123']);
        $service->call('workspace_roles_update', ['workspace_id' => 'ws_123', 'roles' => []]);
        $service->call('billing_get');
        $raw = $service->apiGet('/collections', ['workspace' => 'ws_123']);

        self::assertSame(200, $raw['status']);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Api-Key', 'pm-key'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://postman.test/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://postman.test/workspaces?type=team'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://postman.test/workspaces' && $request->data()['workspace']['name'] === 'Scratch');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://postman.test/collections/col_123' && $request->data()['collection']['info']['name'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://postman.test/collections/fork/col_123' && $request->data()['label'] === 'Agent fork');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://postman.test/apis/api_123/versions/ver_123/schemas/sch_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://postman.test/mocks/mock_123/call-logs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://postman.test/monitors/mon_123/run');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://postman.test/workspaces/ws_123/roles' && $request->data()['roles'] === []);
    }

    public function test_tools_validate_paths_and_configuration(): void
    {
        Http::fake(['https://postman.test/*' => Http::response(['ok' => true], 200)]);

        $service = new PostmanService('pm-key', 'https://postman.test');

        self::assertTrue((new PostmanWorkspacesList($service))->execute([])->succeeded());
        self::assertTrue((new PostmanCollectionsGet($service))->execute(['collection_uid' => 'col_123'])->succeeded());

        $missing = (new PostmanCollectionsGet($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('collection_uid is required', (string) $missing->error);

        $badRaw = (new PostmanApiGet($service))->execute(['path' => 'https://evil.example.test/collections']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new PostmanApiGet(new PostmanService('', 'https://postman.test')))->execute(['path' => '/collections']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new PostmanToolProvider();

        self::assertSame(['success' => false, 'error' => 'Postman API key is required.'], $provider->testConnection([]));

        Http::fake(['https://api.getpostman.com/me' => Http::response(['user' => ['id' => 'user_123']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Postman API.'], $provider->testConnection([
            'api_key' => 'pm-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.postman.test/workspaces' => Http::response(['workspaces' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['postman', 'api_key', 'ops'] => 'account-key',
                    ['postman', 'url', 'ops'] => 'https://ops.postman.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'postman' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'postman' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(PostmanWorkspacesList::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.postman.test/workspaces'
            && $request->hasHeader('X-Api-Key', 'account-key'));
    }
}
