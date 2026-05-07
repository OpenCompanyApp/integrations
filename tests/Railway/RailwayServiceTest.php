<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Railway;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\Integrations\Railway\RailwayToolProvider;
use OpenCompany\Integrations\Railway\Tools\RailwayCreateProject;
use OpenCompany\Integrations\Railway\Tools\RailwayGetCurrentUser;
use OpenCompany\Integrations\Railway\Tools\RailwayGetProject;
use OpenCompany\Integrations\Railway\Tools\RailwayGetService;
use OpenCompany\Integrations\Railway\Tools\RailwayListDeployments;
use OpenCompany\Integrations\Railway\Tools\RailwayListProjects;
use OpenCompany\Integrations\Railway\Tools\RailwayListServices;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Railway public GraphQL API integration behavior.
 */
final class RailwayServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(RailwayService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(RailwayService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_docs_and_connection(): void
    {
        $provider = new RailwayToolProvider;

        self::assertSame('railway', $provider->appName());
        self::assertSame('Railway', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.railway.com/reference/public-api/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://docs.railway.com/reference/public-api/', $provider->integrationMeta()['source_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(7, $provider->tools());
        self::assertArrayHasKey('railway_create_project', $provider->tools());
        self::assertArrayHasKey('railway_get_current_user', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        Http::fake([
            'https://railway.example.test/graphql/v2' => Http::response([
                'data' => ['viewer' => ['id' => 'user_1', 'name' => 'Agent', 'email' => 'agent@example.test']],
            ], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'railway-token',
            'url' => 'https://railway.example.test/graphql/v2',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Railway as Agent.', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://railway.example.test/graphql/v2'
            && $request->hasHeader('Authorization', 'Bearer railway-token')
            && str_contains((string) $request['query'], 'viewer'));
    }

    public function test_service_maps_graphql_queries_mutations_variables_and_auth_headers(): void
    {
        Http::fake([
            'https://railway.example.test/graphql/v2' => static function (Request $request) {
                $query = (string) $request['query'];

                if (str_contains($query, 'mutation CreateProject')) {
                    return Http::response(['data' => ['projectCreate' => ['project' => ['id' => 'project_new', 'name' => 'New App']]]], 200);
                }

                if (str_contains($query, 'query GetProject')) {
                    return Http::response(['data' => ['project' => ['id' => 'project_1', 'name' => 'Agent Project']]], 200);
                }

                if (str_contains($query, 'query ListServices')) {
                    return Http::response(['data' => ['project' => ['services' => ['edges' => [['node' => ['id' => 'service_1', 'name' => 'Web']]]]]]], 200);
                }

                if (str_contains($query, 'query GetService')) {
                    return Http::response(['data' => ['service' => ['id' => 'service_1', 'name' => 'Web']]], 200);
                }

                if (str_contains($query, 'query ListDeployments')) {
                    return Http::response(['data' => ['deployments' => ['edges' => [['node' => ['id' => 'deploy_1', 'status' => 'SUCCESS']]]]]], 200);
                }

                if (str_contains($query, 'projects')) {
                    return Http::response(['data' => ['viewer' => ['projects' => ['edges' => [['node' => ['id' => 'project_1', 'name' => 'Agent Project']]]]]]], 200);
                }

                return Http::response(['data' => ['viewer' => ['id' => 'user_1', 'name' => 'Agent']]], 200);
            },
        ]);

        $service = new RailwayService('railway-token', 'https://railway.example.test/graphql/v2');

        self::assertTrue($service->isConfigured());
        self::assertSame('user_1', $service->getCurrentUser()['viewer']['id']);
        self::assertSame('project_1', $service->listProjects()['viewer']['projects']['edges'][0]['node']['id']);
        self::assertSame('project_1', $service->getProject('project_1')['project']['id']);
        self::assertSame('project_new', $service->createProject('New App', 'Demo')['projectCreate']['project']['id']);
        self::assertSame('service_1', $service->listServices('project_1')['project']['services']['edges'][0]['node']['id']);
        self::assertSame('service_1', $service->getService('service_1')['service']['id']);
        self::assertSame('deploy_1', $service->listDeployments('service_1', 'environment_1', 5)['deployments']['edges'][0]['node']['id']);

        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'viewer')
            && $request->hasHeader('Authorization', 'Bearer railway-token')
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query GetProject')
            && $request['variables']['projectId'] === 'project_1');
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation CreateProject')
            && $request['variables'] === ['name' => 'New App', 'description' => 'Demo']);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query ListServices')
            && $request['variables']['projectId'] === 'project_1');
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query GetService')
            && $request['variables']['serviceId'] === 'service_1');
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query ListDeployments')
            && $request['variables'] === ['serviceId' => 'service_1', 'limit' => 5, 'environmentId' => 'environment_1']);
    }

    public function test_graphql_errors_are_normalized(): void
    {
        Http::fake([
            'https://railway.example.test/graphql/v2' => Http::response([
                'errors' => [
                    ['message' => 'Not authorized'],
                    ['message' => 'Invalid project id'],
                ],
            ], 200),
        ]);

        $result = (new RailwayGetCurrentUser(new RailwayService('railway-token', 'https://railway.example.test/graphql/v2')))->execute([]);

        self::assertFalse($result->succeeded());
        self::assertSame('Railway GraphQL error: Not authorized; Invalid project id', $result->error);
    }

    public function test_tools_shape_payloads_and_validate_inputs(): void
    {
        Http::fake([
            'https://railway.example.test/graphql/v2' => static function (Request $request) {
                $query = (string) $request['query'];

                if (str_contains($query, 'mutation CreateProject')) {
                    return Http::response(['data' => ['projectCreate' => ['project' => ['id' => 'project_new', 'name' => 'New App', 'description' => 'Demo']]]], 200);
                }

                if (str_contains($query, 'query GetProject')) {
                    return Http::response(['data' => ['project' => [
                        'id' => 'project_1',
                        'name' => 'Agent Project',
                        'description' => 'Demo project',
                        'isPublic' => false,
                        'team' => ['name' => 'Example Team'],
                        'environments' => ['edges' => [['node' => ['id' => 'env_1', 'name' => 'production', 'isEphemeral' => false]]]],
                        'plugins' => ['edges' => [['node' => ['id' => 'plugin_1', 'name' => 'Postgres']]]],
                    ]]], 200);
                }

                if (str_contains($query, 'query ListServices')) {
                    return Http::response(['data' => ['project' => ['services' => ['edges' => [['node' => [
                        'id' => 'service_1',
                        'name' => 'Web',
                        'isForked' => false,
                        'repo' => ['name' => 'agent-app'],
                    ]]]]]]], 200);
                }

                if (str_contains($query, 'query GetService')) {
                    return Http::response(['data' => ['service' => [
                        'id' => 'service_1',
                        'name' => 'Web',
                        'isForked' => false,
                        'repo' => ['id' => 'repo_1', 'name' => 'agent-app', 'fullName' => 'example/agent-app', 'branch' => 'main'],
                    ]]], 200);
                }

                if (str_contains($query, 'query ListDeployments')) {
                    return Http::response(['data' => ['deployments' => ['edges' => [['node' => [
                        'id' => 'deploy_1',
                        'status' => 'SUCCESS',
                        'environment' => ['id' => 'env_1', 'name' => 'production'],
                        'service' => ['id' => 'service_1', 'name' => 'Web'],
                        'creator' => ['id' => 'user_1', 'name' => 'Agent', 'email' => 'agent@example.test'],
                    ]]]]]], 200);
                }

                if (str_contains($query, 'projects')) {
                    return Http::response(['data' => ['viewer' => ['projects' => ['edges' => [['node' => [
                        'id' => 'project_1',
                        'name' => 'Agent Project',
                        'team' => ['name' => 'Example Team'],
                    ]]]]]]], 200);
                }

                return Http::response(['data' => ['viewer' => ['id' => 'user_1', 'name' => 'Agent', 'email' => 'agent@example.test']]], 200);
            },
        ]);

        $service = new RailwayService('railway-token', 'https://railway.example.test/graphql/v2');

        $projects = (new RailwayListProjects($service))->execute([]);
        self::assertTrue($projects->succeeded());
        self::assertSame('project_1', $projects->data['projects'][0]['id']);

        $project = (new RailwayGetProject($service))->execute(['project_id' => 'project_1']);
        self::assertTrue($project->succeeded());
        self::assertSame('production', $project->data['environments'][0]['name']);

        $created = (new RailwayCreateProject($service))->execute(['name' => 'New App', 'description' => 'Demo']);
        self::assertTrue($created->succeeded());
        self::assertSame('project_new', $created->data['id']);

        $services = (new RailwayListServices($service))->execute(['project_id' => 'project_1']);
        self::assertTrue($services->succeeded());
        self::assertSame('service_1', $services->data['services'][0]['id']);

        $serviceResult = (new RailwayGetService($service))->execute(['service_id' => 'service_1']);
        self::assertTrue($serviceResult->succeeded());
        self::assertSame('example/agent-app', $serviceResult->data['repo']['full_name']);

        $deployments = (new RailwayListDeployments($service))->execute(['service_id' => 'service_1', 'environment_id' => 'env_1', 'limit' => 5]);
        self::assertTrue($deployments->succeeded());
        self::assertSame('deploy_1', $deployments->data['deployments'][0]['id']);

        $user = (new RailwayGetCurrentUser($service))->execute([]);
        self::assertTrue($user->succeeded());
        self::assertSame('Agent', $user->data['name']);

        $missingProject = (new RailwayGetProject($service))->execute([]);
        self::assertFalse($missingProject->succeeded());
        self::assertSame('The project_id parameter is required.', $missingProject->error);

        $missingName = (new RailwayCreateProject($service))->execute([]);
        self::assertFalse($missingName->succeeded());
        self::assertSame('The name parameter is required.', $missingName->error);

        $unconfigured = (new RailwayListProjects(new RailwayService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('Railway integration is not configured.', $unconfigured->error);
    }

    public function test_multi_account_resolution_uses_named_account_credentials_and_url(): void
    {
        Http::fake([
            'https://tenant-railway.example.test/graphql/v2' => Http::response([
                'data' => ['viewer' => ['projects' => ['edges' => [['node' => ['id' => 'tenant_project', 'name' => 'Tenant Project']]]]]],
            ], 200),
        ]);

        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['railway', 'access_token', 'workspace'] => 'tenant-railway-token',
                    ['railway', 'url', 'workspace'] => 'https://tenant-railway.example.test/graphql/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'railway' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'railway' ? ['workspace'] : [];
            }
        });

        $tool = (new RailwayToolProvider)->createTool(RailwayListProjects::class, ['account' => 'workspace']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant_project', $result->data['projects'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant-railway.example.test/graphql/v2'
            && $request->hasHeader('Authorization', 'Bearer tenant-railway-token')
            && str_contains((string) $request['query'], 'projects'));
    }
}
