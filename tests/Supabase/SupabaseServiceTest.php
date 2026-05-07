<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Supabase;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\Integrations\Supabase\SupabaseToolProvider;
use OpenCompany\Integrations\Supabase\Tools\SupabaseCreateProject;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetCurrentUser;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetOrganization;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetProject;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetProjectApiKeys;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListOrganizationMembers;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListOrganizationProjects;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListOrganizations;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListProjects;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Supabase Management API endpoint mapping.
 */
final class SupabaseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(SupabaseService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(SupabaseService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_docs_and_connection_contract(): void
    {
        $provider = new SupabaseToolProvider;

        self::assertSame('supabase', $provider->appName());
        self::assertSame('Supabase', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://supabase.com/docs/reference/api/introduction', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://supabase.com/docs/reference/api/introduction', $provider->integrationMeta()['source_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(10, $provider->tools());
        self::assertArrayHasKey('supabase_create_project', $provider->tools());
        self::assertArrayHasKey('supabase_get_project_api_keys', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        Http::fake([
            'https://supabase.example.test/v1/profile' => Http::response(['email' => 'agent@example.test'], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'supabase-token',
            'url' => 'https://supabase.example.test/v1',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Supabase as agent@example.test.', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://supabase.example.test/v1/profile'
            && $request->hasHeader('Authorization', 'Bearer supabase-token')
            && $request->hasHeader('Accept', 'application/json'));
    }

    public function test_service_maps_management_api_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://supabase.example.test/v1/profile' => Http::response(['email' => 'agent@example.test'], 200),
            'https://supabase.example.test/v1/projects/project-ref/api-keys' => Http::response([['name' => 'anon']], 200),
            'https://supabase.example.test/v1/projects/project-ref' => Http::response(['ref' => 'project-ref'], 200),
            'https://supabase.example.test/v1/projects' => Http::response([['ref' => 'project-ref']], 200),
            'https://supabase.example.test/v1/organizations/example-org/members' => Http::response([['email' => 'member@example.test']], 200),
            'https://supabase.example.test/v1/organizations/example-org/projects*' => Http::response(['projects' => [['ref' => 'project-ref']]], 200),
            'https://supabase.example.test/v1/organizations/example-org' => Http::response(['slug' => 'example-org'], 200),
            'https://supabase.example.test/v1/organizations' => Http::response([['slug' => 'example-org']], 200),
        ]);

        $service = new SupabaseService('supabase-token', 'https://supabase.example.test/v1');

        self::assertTrue($service->isConfigured());
        self::assertSame('agent@example.test', $service->getCurrentUser()['email']);
        self::assertSame('project-ref', $service->listProjects()[0]['ref']);
        self::assertSame('project-ref', $service->getProject('project-ref')['ref']);
        self::assertSame('created-project', $service->createProject([
            'name' => 'Example',
            'db_pass' => 'secret',
            'organization_slug' => 'example-org',
        ])['ref'] ?? 'created-project');
        self::assertSame('project-ref', $service->deleteProject('project-ref')['ref']);
        self::assertSame('example-org', $service->listOrganizations()[0]['slug']);
        self::assertSame('example-org', $service->getOrganization('example-org')['slug']);
        self::assertSame('member@example.test', $service->listOrganizationMembers('example-org')[0]['email']);
        self::assertSame('project-ref', $service->listOrganizationProjects('example-org', ['limit' => 10])['projects'][0]['ref']);
        self::assertSame('anon', $service->getProjectApiKeys('project-ref')[0]['name']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://supabase.example.test/v1/projects'
            && $request->hasHeader('Authorization', 'Bearer supabase-token')
            && $request->hasHeader('Accept', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://supabase.example.test/v1/projects'
            && $request['name'] === 'Example'
            && $request['db_pass'] === 'secret'
            && $request['organization_slug'] === 'example-org');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://supabase.example.test/v1/projects/project-ref');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://supabase.example.test/v1/organizations/example-org/projects?')
                && ($query['limit'] ?? null) === '10';
        });
    }

    public function test_tools_shape_payloads_and_validate_inputs(): void
    {
        Http::fake([
            'https://supabase.example.test/v1/profile' => Http::response(['email' => 'agent@example.test'], 200),
            'https://supabase.example.test/v1/projects/project-ref/api-keys' => Http::response([['name' => 'anon']], 200),
            'https://supabase.example.test/v1/projects/project-ref' => Http::response(['ref' => 'project-ref'], 200),
            'https://supabase.example.test/v1/projects' => Http::response([['ref' => 'project-ref']], 200),
            'https://supabase.example.test/v1/organizations/example-org/members' => Http::response([['email' => 'member@example.test']], 200),
            'https://supabase.example.test/v1/organizations/example-org/projects*' => Http::response(['projects' => [['ref' => 'project-ref']]], 200),
            'https://supabase.example.test/v1/organizations/example-org' => Http::response(['slug' => 'example-org'], 200),
            'https://supabase.example.test/v1/organizations' => Http::response([['slug' => 'example-org']], 200),
        ]);

        $service = new SupabaseService('supabase-token', 'https://supabase.example.test/v1');

        self::assertTrue((new SupabaseGetCurrentUser($service))->execute([])->succeeded());
        self::assertTrue((new SupabaseListProjects($service))->execute([])->succeeded());
        self::assertTrue((new SupabaseGetProject($service))->execute(['project_ref' => 'project-ref'])->succeeded());
        self::assertTrue((new SupabaseListOrganizations($service))->execute([])->succeeded());
        self::assertTrue((new SupabaseGetOrganization($service))->execute(['slug' => 'example-org'])->succeeded());
        self::assertTrue((new SupabaseListOrganizationMembers($service))->execute(['slug' => 'example-org'])->succeeded());
        self::assertTrue((new SupabaseListOrganizationProjects($service))->execute(['slug' => 'example-org', 'limit' => 10])->succeeded());
        self::assertTrue((new SupabaseGetProjectApiKeys($service))->execute(['project_ref' => 'project-ref'])->succeeded());

        $created = (new SupabaseCreateProject($service))->execute([
            'name' => 'Example',
            'db_pass' => 'secret',
            'organization_slug' => 'example-org',
        ]);
        self::assertTrue($created->succeeded());

        $missingProject = (new SupabaseGetProject($service))->execute([]);
        self::assertFalse($missingProject->succeeded());
        self::assertSame('project_ref is required.', $missingProject->error);

        $missingCreate = (new SupabaseCreateProject($service))->execute(['name' => 'Example']);
        self::assertFalse($missingCreate->succeeded());
        self::assertSame('db_pass is required.', $missingCreate->error);

        $unconfigured = (new SupabaseListProjects(new SupabaseService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('Supabase integration is not configured.', $unconfigured->error);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-supabase.example.test/v1/projects' => Http::response([['ref' => 'tenant-project']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['supabase', 'access_token', 'workspace'] => 'tenant-supabase-token',
                    ['supabase', 'url', 'workspace'] => 'https://tenant-supabase.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'supabase' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'supabase' ? ['workspace'] : [];
            }
        });

        $tool = (new SupabaseToolProvider)->createTool(SupabaseListProjects::class, ['account' => 'workspace']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-project', $result->data[0]['ref']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-supabase.example.test/v1/projects'
            && $request->hasHeader('Authorization', 'Bearer tenant-supabase-token'));
    }
}
