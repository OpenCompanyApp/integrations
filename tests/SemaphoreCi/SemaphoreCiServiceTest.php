<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SemaphoreCi;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\SemaphoreCi\SemaphoreCiService;
use OpenCompany\Integrations\SemaphoreCi\SemaphoreCiToolProvider;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiApiGet;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiGetJobLogs;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiListPipelines;
use OpenCompany\Integrations\SemaphoreCi\Tools\SemaphoreCiRunWorkflow;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Semaphore API v1alpha integration.
 */
final class SemaphoreCiServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(SemaphoreCiService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(SemaphoreCiService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new SemaphoreCiToolProvider();

        self::assertSame('semaphore-ci', $provider->appName());
        self::assertSame('Semaphore CI', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(40, $provider->tools());
        self::assertArrayHasKey('semaphore_ci_run_workflow', $provider->tools());
        self::assertArrayHasKey('semaphore_ci_partial_rebuild_pipeline', $provider->tools());
        self::assertArrayHasKey('semaphore_ci_get_artifact_signed_url', $provider->tools());
        self::assertArrayHasKey('semaphore_ci_api_get', $provider->tools());
    }

    public function test_service_maps_documented_semaphore_api_endpoints(): void
    {
        Http::fake([
            'https://acme.semaphoreci.com/api/v1alpha/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new SemaphoreCiService('sem-token', 'https://acme.semaphoreci.com');
        $service->runWorkflow(['project_id' => 'project-1', 'reference' => 'refs/heads/main']);
        $service->getWorkflow('workflow-1');
        $service->listWorkflows(['project_id' => 'project-1', 'branch_name' => 'main']);
        $service->rerunWorkflow('workflow-1', 'token-1');
        $service->stopWorkflow('workflow-1');
        $service->getPipeline('pipeline-1', ['detailed' => true]);
        $service->listPipelines(['project_id' => 'project-1', 'branch_name' => 'main']);
        $service->stopPipeline('pipeline-1');
        $service->partialRebuildPipeline('pipeline-1', ['request_token' => 'token-2']);
        $service->validateYaml(['yaml_definition' => 'version: v1.0']);
        $service->listPromotions(['pipeline_id' => 'pipeline-1']);
        $service->triggerPromotion(['pipeline_id' => 'pipeline-1', 'name' => 'production']);
        $service->triggerTask('task-1', ['reference' => 'main']);
        $service->getJob('job-1');
        $service->stopJob('job-1');
        $service->getJobLogs('job-1', ['artifact_job_logs' => true]);
        $service->listAgentTypes();
        $service->createAgentType(['metadata' => ['name' => 's1-small']]);
        $service->updateAgentType('s1-small', ['metadata' => ['name' => 's1-small']]);
        $service->getAgentType('s1-small');
        $service->deleteAgentType('s1-small');
        $service->disableAgentTypeAgents('s1-small', ['only_idle' => false]);
        $service->listAgents(['agent_type' => 's1-small', 'page_size' => 10]);
        $service->getAgent('agent-1');
        $service->listDeploymentTargets(['project_id' => 'project-1']);
        $service->getDeploymentTarget('target-1');
        $service->createDeploymentTarget(['project_id' => 'project-1'], ['name' => 'staging', 'unique_token' => 'token-3']);
        $service->updateDeploymentTarget('target-1', ['description' => 'Updated']);
        $service->deleteDeploymentTarget('target-1', ['unique_token' => 'token-4']);
        $service->deactivateDeploymentTarget('target-1');
        $service->activateDeploymentTarget('target-1');
        $service->getDeploymentHistory('target-1', ['cursor_type' => 'FIRST']);
        $service->listArtifacts(['scope' => 'jobs', 'scope_id' => 'job-1', 'path' => 'agent']);
        $service->getArtifactSignedUrl(['scope' => 'jobs', 'scope_id' => 'job-1', 'path' => 'agent/job_logs.txt.gz', 'method' => 'GET']);
        $service->configureArtifactRetentionPolicy(['project_id' => 'project-1', 'job_level_retention_policies' => [['selector' => '/logs/**/*.txt', 'age' => '3 months']]]);
        $service->getArtifactRetentionPolicy('project-1');
        $service->apiGet('/pipelines', ['project_id' => 'project-1']);
        $service->apiPost('/tasks/task-1/run_now', ['reference' => 'main']);
        $service->apiPatch('/pipelines/pipeline-1', ['terminate_request' => true]);
        $service->apiDelete('/deployment_targets/target-1', ['unique_token' => 'token-5']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Token sem-token'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('User-Agent', 'SemaphoreCI v2.0 Client'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/plumber-workflows' && $request->data()['reference'] === 'refs/heads/main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/plumber-workflows/workflow-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/plumber-workflows?project_id=project-1&branch_name=main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/plumber-workflows/workflow-1/reschedule?request_token=token-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/plumber-workflows/workflow-1/terminate');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/pipelines/pipeline-1?detailed=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/pipelines/pipeline-1' && $request->data()['terminate_request'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/pipelines/pipeline-1/partial_rebuild' && $request->data()['request_token'] === 'token-2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/promotions' && $request->data()['name'] === 'production');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/tasks/task-1/run_now' && $request->data()['reference'] === 'main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/logs/job-1?artifact_job_logs=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/self_hosted_agent_types/s1-small/disable_all' && $request->data()['only_idle'] === false);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/deployment_targets?project_id=project-1' && $request->data()['name'] === 'staging');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/deployment_targets/target-1?unique_token=token-4');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acme.semaphoreci.com/api/v1alpha/artifacts/signed_url?scope=jobs&scope_id=job-1&path=agent%2Fjob_logs.txt.gz&method=GET');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://acme.semaphoreci.com/api/v1alpha/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new SemaphoreCiService('sem-token', 'https://acme.semaphoreci.com/api/v1alpha');

        self::assertTrue((new SemaphoreCiRunWorkflow($service))->execute([
            'payload' => ['project_id' => 'project-1', 'reference' => 'refs/heads/main'],
        ])->succeeded());
        self::assertTrue((new SemaphoreCiListPipelines($service))->execute([
            'project_id' => 'project-1',
            'branch_name' => 'main',
        ])->succeeded());
        self::assertTrue((new SemaphoreCiGetJobLogs($service))->execute([
            'job_id' => 'job-1',
            'artifact_job_logs' => true,
        ])->succeeded());

        $badRaw = (new SemaphoreCiApiGet($service))->execute(['path' => 'https://evil.example.test/pipelines']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new SemaphoreCiApiGet(new SemaphoreCiService('', 'https://acme.semaphoreci.com')))->execute(['path' => '/pipelines']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new SemaphoreCiToolProvider();

        self::assertSame(['success' => false, 'error' => 'Semaphore CI API URL and token are required.'], $provider->testConnection([]));

        Http::fake(['https://acme.semaphoreci.com/api/v1alpha/plumber-workflows?project_id=connection-test' => Http::response([], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Semaphore CI API.'], $provider->testConnection([
            'url' => 'https://acme.semaphoreci.com',
            'api_token' => 'sem-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.semaphoreci.com/api/v1alpha/pipelines?project_id=project-ops' => Http::response(['id' => 'ok'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['semaphore-ci', 'api_token', 'ops'] => 'account-token',
                    ['semaphore-ci', 'url', 'ops'] => 'https://ops.semaphoreci.com',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'semaphore-ci' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'semaphore-ci' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(SemaphoreCiApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/pipelines', 'query' => ['project_id' => 'project-ops']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.semaphoreci.com/api/v1alpha/pipelines?project_id=project-ops'
            && $request->hasHeader('Authorization', 'Token account-token'));
    }
}
