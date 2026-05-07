<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Buildkite;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Buildkite\BuildkiteService;
use OpenCompany\Integrations\Buildkite\BuildkiteToolProvider;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteApiGet;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteCreateBuild;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteListBuilds;
use OpenCompany\Integrations\Buildkite\Tools\BuildkiteRetryFailedJobs;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Buildkite REST API integration.
 */
final class BuildkiteServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BuildkiteService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BuildkiteService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new BuildkiteToolProvider();

        self::assertSame('buildkite', $provider->appName());
        self::assertSame('Buildkite', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(22, $provider->tools());
        self::assertArrayHasKey('buildkite_list_pipelines', $provider->tools());
        self::assertArrayHasKey('buildkite_create_build', $provider->tools());
        self::assertArrayHasKey('buildkite_get_job_log', $provider->tools());
        self::assertArrayHasKey('buildkite_api_get', $provider->tools());
    }

    public function test_service_maps_organizations_pipelines_builds_jobs_and_raw_paths(): void
    {
        Http::fake([
            'https://buildkite.example.test/v2/*' => Http::response(['id' => 'ok', 'name' => 'Example'], 200),
        ]);

        $service = new BuildkiteService('bk-test', 'https://buildkite.example.test/v2');
        $service->getCurrentUser();
        $service->listOrganizations(['per_page' => 10]);
        $service->getOrganization('acme-inc');
        $service->listPipelines('acme-inc', ['page' => 2]);
        $service->getPipeline('acme-inc', 'deploy');
        $service->createPipeline('acme-inc', ['name' => 'Deploy', 'repository' => 'git@example.test:acme/deploy.git']);
        $service->updatePipeline('acme-inc', 'deploy', ['description' => 'Updated']);
        $service->archivePipeline('acme-inc', 'deploy');
        $service->unarchivePipeline('acme-inc', 'deploy');
        $service->listBuilds('acme-inc', 'deploy', ['branch' => 'main', 'state' => 'failed']);
        $service->getBuild('acme-inc', 'deploy', 42);
        $service->createBuild('acme-inc', 'deploy', ['commit' => 'HEAD', 'branch' => 'main', 'message' => 'Test']);
        $service->cancelBuild('acme-inc', 'deploy', 42);
        $service->rebuildBuild('acme-inc', 'deploy', 42);
        $service->retryFailedJobs('acme-inc', 'deploy', 42, ['states' => 'failed,soft_failed']);
        $service->getJobLog('acme-inc', 'deploy', 42, 'job-123');
        $service->getJobEnvironment('acme-inc', 'deploy', 42, 'job-123');
        $service->apiGet('/organizations/acme-inc/pipelines', ['per_page' => 5]);
        $service->apiPost('/organizations/acme-inc/pipelines/deploy/builds', ['commit' => 'HEAD']);
        $service->apiPut('/organizations/acme-inc/pipelines/deploy/builds/42/rebuild');
        $service->apiPatch('/organizations/acme-inc/pipelines/deploy', ['description' => 'Raw']);
        $service->apiDelete('/organizations/acme-inc/pipelines/deploy', ['hard' => 'false']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer bk-test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://buildkite.example.test/v2/user');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://buildkite.example.test/v2/organizations?per_page=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines?page=2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines' && $request->data()['name'] === 'Deploy');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy' && $request->data()['description'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/unarchive');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/builds?branch=main&state=failed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/builds' && $request->data()['commit'] === 'HEAD');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/builds/42/cancel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/builds/42/rebuild');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/builds/42/retry_failed_jobs' && $request->data()['states'] === 'failed,soft_failed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/builds/42/jobs/job-123/log');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy/builds/42/jobs/job-123/env');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://buildkite.example.test/v2/organizations/acme-inc/pipelines/deploy?hard=false');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://buildkite.example.test/v2/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new BuildkiteService('bk-test', 'https://buildkite.example.test/v2');

        self::assertTrue((new BuildkiteListBuilds($service))->execute([
            'organization' => 'acme-inc',
            'pipeline' => 'deploy',
            'branch' => 'main',
        ])->succeeded());
        self::assertTrue((new BuildkiteCreateBuild($service))->execute([
            'organization' => 'acme-inc',
            'pipeline' => 'deploy',
            'payload' => ['commit' => 'HEAD', 'branch' => 'main', 'message' => 'Agent build'],
        ])->succeeded());
        self::assertTrue((new BuildkiteRetryFailedJobs($service))->execute([
            'organization' => 'acme-inc',
            'pipeline' => 'deploy',
            'number' => 42,
            'payload' => ['states' => 'failed,soft_failed'],
        ])->succeeded());

        $badRaw = (new BuildkiteApiGet($service))->execute(['path' => 'https://evil.example.test/user']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new BuildkiteApiGet(new BuildkiteService('', 'https://buildkite.example.test/v2')))->execute(['path' => '/user']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new BuildkiteToolProvider();

        self::assertSame(['success' => false, 'error' => 'Buildkite access token is required.'], $provider->testConnection([]));

        Http::fake(['https://api.buildkite.com/v2/user' => Http::response(['name' => 'Ada'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Buildkite as Ada.'], $provider->testConnection([
            'access_token' => 'bk-test',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://buildkite.internal.test/v2/user' => Http::response(['id' => 'user-123'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['buildkite', 'access_token', 'ops'] => 'account-token',
                    ['buildkite', 'url', 'ops'] => 'https://buildkite.internal.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'buildkite' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'buildkite' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(BuildkiteApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/user'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://buildkite.internal.test/v2/user'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
