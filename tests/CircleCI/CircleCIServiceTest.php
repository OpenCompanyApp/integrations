<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CircleCI;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\Integrations\CircleCI\CircleCIToolProvider;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIListContextEnvVars;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIListPipelines;
use OpenCompany\Integrations\CircleCI\Tools\CircleCITriggerPipeline;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for CircleCI endpoint mapping and metadata.
 */
final class CircleCIServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CircleCIService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CircleCIService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_circle_token_and_preserves_project_slug_paths(): void
    {
        Http::fake(['*' => Http::response(['items' => []], 200)]);

        $service = new CircleCIService(accessToken: 'token-test');
        $service->apiGet('/v2/pipeline', ['org-slug' => 'gh/example-org']);
        $service->triggerPipeline('gh/example-org/example-repo', ['branch' => 'main']);
        $service->apiPost('/v2/workflow/workflow-123/cancel');
        $service->apiDelete('/v2/context/context-123/environment-variable/SECRET');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Circle-Token', 'token-test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://circleci.com/api/v2/pipeline?org-slug=gh%2Fexample-org');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://circleci.com/api/v2/project/gh/example-org/example-repo/pipeline'
            && $request['branch'] === 'main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://circleci.com/api/v2/workflow/workflow-123/cancel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://circleci.com/api/v2/context/context-123/environment-variable/SECRET');
    }

    public function test_endpoint_tools_map_query_body_and_slugs(): void
    {
        $service = new CircleCIService(accessToken: 'token-test');

        Http::fake(['*' => Http::response(['items' => []], 200)]);
        self::assertTrue((new CircleCIListPipelines($service))->execute([
            'org_slug' => 'gh/example-org',
            'page_token' => 'next-page',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://circleci.com/api/v2/pipeline?org-slug=gh%2Fexample-org&page-token=next-page');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'pipeline-123'], 200)]);
        self::assertTrue((new CircleCITriggerPipeline($service))->execute([
            'project_slug' => 'gh/example-org/example-repo',
            'branch' => 'main',
            'parameters' => ['deploy' => false],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://circleci.com/api/v2/project/gh/example-org/example-repo/pipeline'
            && $request['parameters']['deploy'] === false);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        self::assertTrue((new CircleCIListContextEnvVars($service))->execute([
            'context_id' => 'context-123',
            'page_token' => 'page-2',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://circleci.com/api/v2/context/context-123/environment-variable?page-token=page-2');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new CircleCIToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://circleci.com/docs/api/v2/', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(65, count($tools));
        self::assertArrayHasKey('circleci_trigger_pipeline', $tools);
        self::assertArrayHasKey('circleci_list_contexts', $tools);
        self::assertArrayHasKey('circleci_list_workflow_jobs', $tools);
        self::assertArrayHasKey('circleci_api_get', $tools);

        self::assertSame(['success' => false, 'error' => 'Access token is required.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['login' => 'octocat'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to CircleCI as octocat.'], $provider->testConnection([
            'access_token' => 'token-test',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://circleci.com/api/v2/user');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['circleci', 'access_token', 'ci'] => 'account-token',
                    ['circleci', 'url', 'ci'] => 'https://circle.example.test/api',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'circleci' && $account === 'ci';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'circleci' ? ['ci'] : [];
            }
        });

        $tool = $provider->createTool(CircleCIListPipelines::class, ['account' => 'ci']);
        self::assertTrue($tool->execute(['org_slug' => 'gh/example-org'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://circle.example.test/api/v2/pipeline?org-slug=gh%2Fexample-org'
            && $request->hasHeader('Circle-Token', 'account-token'));
    }
}
