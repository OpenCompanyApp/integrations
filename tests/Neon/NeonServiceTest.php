<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Neon;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Neon\NeonOperations;
use OpenCompany\Integrations\Neon\NeonService;
use OpenCompany\Integrations\Neon\NeonToolProvider;
use OpenCompany\Integrations\Neon\Tools\NeonCreateProject;
use OpenCompany\Integrations\Neon\Tools\NeonGetCurrentUser;
use OpenCompany\Integrations\Neon\Tools\NeonGetProject;
use OpenCompany\Integrations\Neon\Tools\NeonListBranches;
use PHPUnit\Framework\TestCase;

final class NeonServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new NeonToolProvider;

        self::assertSame('neon', $provider->appName());
        self::assertSame('Neon', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://neon.com/docs/reference/api-reference', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://neon.com/api_spec/release/v2.json', $provider->integrationMeta()['source_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(145, NeonOperations::all());
        self::assertCount(145, $provider->tools());
        self::assertArrayHasKey('neon_list_projects', $provider->tools());
        self::assertArrayHasKey('neon_get_project', $provider->tools());
        self::assertArrayHasKey('neon_create_project', $provider->tools());
        self::assertArrayHasKey('neon_list_branches', $provider->tools());
        self::assertArrayHasKey('neon_get_branch', $provider->tools());
        self::assertArrayHasKey('neon_list_databases', $provider->tools());
        self::assertArrayHasKey('neon_get_current_user', $provider->tools());
        self::assertArrayHasKey('neon_create_api_key', $provider->tools());
        self::assertArrayHasKey('neon_create_project_endpoint', $provider->tools());
    }

    public function test_provider_connection_uses_neon_current_user_endpoint(): void
    {
        Http::fake([
            'https://console.example.test/api/v2/users/me' => Http::response(['user' => ['email' => 'agent@example.test']], 200),
        ]);

        $result = (new NeonToolProvider)->testConnection([
            'access_token' => 'neon-token',
            'url' => 'https://console.example.test/api/v2',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Neon as agent@example.test.', $result['message']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://console.example.test/api/v2/users/me'
            && $request->hasHeader('Authorization', 'Bearer neon-token')
            && $request->hasHeader('Accept', 'application/json'));
    }

    public function test_service_maps_common_neon_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://console.example.test/api/v2/projects/example-project' => Http::response(['project' => ['id' => 'example-project']], 200),
            'https://console.example.test/api/v2/projects/example-project/branches/main' => Http::response(['branch' => ['id' => 'main']], 200),
            'https://console.example.test/api/v2/projects/example-project/branches/main/databases' => Http::response(['databases' => [['name' => 'neondb']]], 200),
            'https://console.example.test/api/v2/projects/example-project/branches' => Http::response(['branches' => [['id' => 'main']]], 200),
            'https://console.example.test/api/v2/projects' => Http::response(['projects' => [['id' => 'example-project']]], 200),
            'https://console.example.test/api/v2/users/me' => Http::response(['user' => ['email' => 'agent@example.test']], 200),
        ]);

        $service = new NeonService(accessToken: 'neon-token', baseUrl: 'https://console.example.test/api/v2');

        self::assertSame(['projects' => [['id' => 'example-project']]], $service->listProjects());
        self::assertSame(['project' => ['id' => 'example-project']], $service->getProject('example-project'));
        self::assertSame(['projects' => [['id' => 'example-project']]], $service->createProject(['project' => ['name' => 'Example']]));
        self::assertSame(['branches' => [['id' => 'main']]], $service->listBranches('example-project'));
        self::assertSame(['branch' => ['id' => 'main']], $service->getBranch('example-project', 'main'));
        self::assertSame(['databases' => [['name' => 'neondb']]], $service->listDatabases('example-project', 'main'));
        self::assertSame(['user' => ['email' => 'agent@example.test']], $service->getCurrentUser());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://console.example.test/api/v2/projects'
            && $request['project']['name'] === 'Example'
            && $request->hasHeader('Authorization', 'Bearer neon-token'));
    }

    public function test_generated_tools_map_path_query_and_loose_body_arguments(): void
    {
        Http::fake([
            'https://console.example.test/api/v2/projects/example-project' => Http::response(['project' => ['id' => 'example-project']], 200),
            'https://console.example.test/api/v2/projects/example-project/branches*' => Http::response(['branches' => [['id' => 'main']]], 200),
            'https://console.example.test/api/v2/projects' => Http::response(['project' => ['id' => 'created']], 200),
        ]);

        $service = new NeonService(accessToken: 'neon-token', baseUrl: 'https://console.example.test/api/v2');

        $get = new NeonGetProject($service);
        $success = $get->execute(['project_id' => 'example-project']);
        self::assertTrue($success->succeeded());
        self::assertSame('example-project', $success->data['project']['id']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The project_id parameter is required.', $missing->error);

        $branches = new NeonListBranches($service);
        $listed = $branches->execute(['project_id' => 'example-project', 'limit' => 10]);
        self::assertTrue($listed->succeeded());
        self::assertSame('main', $listed->data['branches'][0]['id']);

        $create = new NeonCreateProject($service);
        $created = $create->execute([
            'project' => ['name' => 'Loose Body'],
        ]);
        self::assertTrue($created->succeeded());
        self::assertSame('created', $created->data['project']['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://console.example.test/api/v2/projects/example-project/branches?')
                && ($query['limit'] ?? null) === '10';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://console.example.test/api/v2/projects'
            && $request['project']['name'] === 'Loose Body');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-console.example.test/api/v2/users/me' => Http::response(['user' => ['email' => 'tenant@example.test']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'neon' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-neon-token',
                    'url' => 'https://tenant-console.example.test/api/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'neon' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'neon' ? ['work'] : [];
            }
        });

        $tool = (new NeonToolProvider)->createTool(NeonGetCurrentUser::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant@example.test', $result->data['user']['email']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-console.example.test/api/v2/users/me'
            && $request->hasHeader('Authorization', 'Bearer tenant-neon-token'));
    }
}
