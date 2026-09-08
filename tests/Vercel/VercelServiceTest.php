<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Vercel;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Vercel\Tools\VercelCreateDeployment;
use OpenCompany\Integrations\Vercel\Tools\VercelGetDeployment;
use OpenCompany\Integrations\Vercel\Tools\VercelGetProject;
use OpenCompany\Integrations\Vercel\Tools\VercelListDeployments;
use OpenCompany\Integrations\Vercel\Tools\VercelListProjects;
use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\Integrations\Vercel\VercelToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Vercel REST API endpoint mapping.
 */
final class VercelServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(VercelService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(VercelService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_connection_contract(): void
    {
        $provider = new VercelToolProvider;

        self::assertSame('vercel', $provider->appName());
        self::assertSame('Vercel', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://vercel.com/docs/api', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://vercel.com/docs/rest-api', $provider->integrationMeta()['source_url']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(8, $provider->tools());
        self::assertArrayHasKey('vercel_create_deployment', $provider->tools());
        self::assertArrayHasKey('vercel_list_projects', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());

        Http::fake([
            'https://api.vercel.test/v2/user' => Http::response([
                'user' => ['username' => 'agent'],
            ], 200),
        ]);

        $result = $provider->testConnection([
            'token' => 'vercel-token',
            'url' => 'https://api.vercel.test',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected as agent', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.vercel.test/v2/user'
            && $request->hasHeader('Authorization', 'Bearer vercel-token'));
    }

    public function test_service_maps_versioned_vercel_endpoints_and_auth_headers(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new VercelService('vercel-token', 'https://api.vercel.test');

        self::assertTrue($service->isConfigured());
        $service->listProjects(['limit' => 10, 'teamId' => 'team_123']);
        $service->getProject('prj_123', ['teamId' => 'team_123']);
        $service->listDeployments(['projectId' => 'prj_123', 'state' => 'READY', 'limit' => 5]);
        $service->getDeployment('dpl_123', ['teamId' => 'team_123']);
        $service->createDeployment(['name' => 'agent-app'], ['teamId' => 'team_123']);
        $service->listDomains(['limit' => 20, 'teamId' => 'team_123']);
        $service->listTeams(['limit' => 20]);
        $service->getCurrentUser();

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.vercel.test/v10/projects?')
                && ($query['limit'] ?? null) === '10'
                && ($query['teamId'] ?? null) === 'team_123'
                && $request->hasHeader('Authorization', 'Bearer vercel-token')
                && $request->hasHeader('Accept', 'application/json');
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.vercel.test/v9/projects/prj_123?')
                && ($query['teamId'] ?? null) === 'team_123';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.vercel.test/v6/deployments?')
                && ($query['projectId'] ?? null) === 'prj_123'
                && ($query['state'] ?? null) === 'READY'
                && ($query['limit'] ?? null) === '5';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.vercel.test/v13/deployments/dpl_123?')
                && ($query['teamId'] ?? null) === 'team_123';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'POST'
                && str_starts_with($request->url(), 'https://api.vercel.test/v13/deployments?')
                && ($query['teamId'] ?? null) === 'team_123'
                && $request['name'] === 'agent-app';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.vercel.test/v5/domains?')
                && ($query['limit'] ?? null) === '20'
                && ($query['teamId'] ?? null) === 'team_123';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.vercel.test/v2/teams?')
                && ($query['limit'] ?? null) === '20';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.vercel.test/v2/user');
    }

    public function test_tools_shape_parameters_and_report_unconfigured_state(): void
    {
        Http::fake([
            'https://api.vercel.test/v10/projects*' => Http::response([['id' => 'prj_123']], 200),
            'https://api.vercel.test/v9/projects/prj_123*' => Http::response(['id' => 'prj_123'], 200),
            'https://api.vercel.test/v6/deployments*' => Http::response(['deployments' => [['uid' => 'dpl_123']]], 200),
            'https://api.vercel.test/v13/deployments/dpl_123*' => Http::response(['uid' => 'dpl_123'], 200),
            'https://api.vercel.test/v13/deployments*' => Http::response(['id' => 'dpl_new'], 200),
        ]);

        $service = new VercelService('vercel-token', 'https://api.vercel.test');

        $projects = (new VercelListProjects($service))->execute(['limit' => 10, 'team_id' => 'team_123']);
        self::assertTrue($projects->succeeded());
        self::assertSame('prj_123', $projects->data[0]['id']);

        $project = (new VercelGetProject($service))->execute(['id' => 'prj_123', 'team_id' => 'team_123']);
        self::assertTrue($project->succeeded());
        self::assertSame('prj_123', $project->data['id']);

        $deployments = (new VercelListDeployments($service))->execute(['project_id' => 'prj_123', 'state' => 'READY']);
        self::assertTrue($deployments->succeeded());
        self::assertSame('dpl_123', $deployments->data['deployments'][0]['uid']);

        $deployment = (new VercelGetDeployment($service))->execute(['id' => 'dpl_123', 'team_id' => 'team_123']);
        self::assertTrue($deployment->succeeded());
        self::assertSame('dpl_123', $deployment->data['uid']);

        $created = (new VercelCreateDeployment($service))->execute([
            'name' => 'agent-app',
            'git_source' => ['type' => 'github', 'ref' => 'main', 'repoId' => 12345],
            'team_id' => 'team_123',
        ]);
        self::assertTrue($created->succeeded());
        self::assertSame('dpl_new', $created->data['id']);

        $missing = (new VercelGetProject($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('Missing required parameter: id', $missing->error);

        $unconfigured = (new VercelListProjects(new VercelService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('Vercel is not configured. Please set your API token.', $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://api.vercel.test/v13/deployments?')
            && $request['name'] === 'agent-app'
            && $request['gitSource'] === ['type' => 'github', 'ref' => 'main', 'repoId' => 12345]);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-vercel.example.test/v10/projects*' => Http::response([['id' => 'tenant-project']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['vercel', 'token', 'workspace'] => 'tenant-vercel-token',
                    ['vercel', 'url', 'workspace'] => 'https://tenant-vercel.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'vercel' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'vercel' ? ['workspace'] : [];
            }
        });

        $tool = (new VercelToolProvider)->createTool(VercelListProjects::class, ['account' => 'workspace']);
        $result = $tool->execute(['limit' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-project', $result->data[0]['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://tenant-vercel.example.test/v10/projects?')
                && ($query['limit'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer tenant-vercel-token');
        });
    }
}
