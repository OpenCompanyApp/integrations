<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\TravisCi;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiApiGet;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiGetJobLog;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiListRepositoryBuilds;
use OpenCompany\Integrations\TravisCi\Tools\TravisCiRestartBuild;
use OpenCompany\Integrations\TravisCi\TravisCiService;
use OpenCompany\Integrations\TravisCi\TravisCiToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Travis CI API V3 integration.
 */
final class TravisCiServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(TravisCiService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(TravisCiService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new TravisCiToolProvider();

        self::assertSame('travis-ci', $provider->appName());
        self::assertSame('Travis CI', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(29, $provider->tools());
        self::assertArrayHasKey('travis_ci_list_repository_builds', $provider->tools());
        self::assertArrayHasKey('travis_ci_restart_job', $provider->tools());
        self::assertArrayHasKey('travis_ci_get_job_log', $provider->tools());
        self::assertArrayHasKey('travis_ci_api_get', $provider->tools());
    }

    public function test_service_maps_core_travis_api_v3_endpoints(): void
    {
        Http::fake([
            'https://travis.example.test/*' => Http::response(['id' => 'ok', '@type' => 'response'], 200),
        ]);

        $service = new TravisCiService('travis-token', 'https://travis.example.test');
        $service->getCurrentUser();
        $service->listRepositories(['limit' => 5]);
        $service->listOwnerRepositories('github', 'acme', ['active' => true]);
        $service->getRepository('acme/web', ['include' => 'repository.current_build']);
        $service->activateRepository('123');
        $service->deactivateRepository('github/acme/web');
        $service->listBuilds(['limit' => 10]);
        $service->listRepositoryBuilds('acme/web', ['state' => 'failed']);
        $service->getBuild(86601346);
        $service->cancelBuild(86601346);
        $service->restartBuild(86601346);
        $service->listJobs(['state' => 'failed']);
        $service->listBuildJobs(86601346);
        $service->getJob(86601347);
        $service->cancelJob(86601347);
        $service->restartJob(86601347);
        $service->debugJob(86601347);
        $service->getJobLog(86601347, true);
        $service->listRequests('acme/web');
        $service->createRequest('acme/web', ['request' => ['branch' => 'main']]);
        $service->listSettings('123');
        $service->updateSetting('123', 'auto_cancel_pushes', ['setting.value' => true]);
        $service->listEnvVars('123');
        $service->createEnvVar('123', ['env_var.name' => 'DEPLOY_ENV', 'env_var.value' => 'staging']);
        $service->deleteEnvVar('123', 'env-1');
        $service->apiGet('/repo/123/builds', ['limit' => 1]);
        $service->apiPost('/build/86601346/restart');
        $service->apiPatch('/repo/123/setting/auto_cancel_pushes', ['setting.value' => false]);
        $service->apiDelete('/repo/123/env_var/env-2');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'token travis-token'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Travis-API-Version', '3'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://travis.example.test/user');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://travis.example.test/repos?limit=5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://travis.example.test/owner/github/acme/repos?active=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://travis.example.test/repo/github/acme/web?include=repository.current_build');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://travis.example.test/repo/123/activate');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://travis.example.test/repo/github/acme/web/deactivate');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://travis.example.test/repo/github/acme/web/builds?state=failed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://travis.example.test/build/86601346/restart');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://travis.example.test/job/86601347/debug');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://travis.example.test/job/86601347/log.txt' && $request->hasHeader('Accept', 'text/plain'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://travis.example.test/repo/github/acme/web/requests' && $request->data()['request']['branch'] === 'main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://travis.example.test/repo/123/setting/auto_cancel_pushes' && $request->data()['setting.value'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://travis.example.test/repo/123/env_var/env-1');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://travis.example.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new TravisCiService('travis-token', 'https://travis.example.test');

        self::assertTrue((new TravisCiListRepositoryBuilds($service))->execute([
            'repository' => 'acme/web',
            'query' => ['limit' => 5],
        ])->succeeded());
        self::assertTrue((new TravisCiRestartBuild($service))->execute(['build_id' => 86601346])->succeeded());
        self::assertTrue((new TravisCiGetJobLog($service))->execute([
            'job_id' => 86601347,
            'plain_text' => true,
        ])->succeeded());

        $badRaw = (new TravisCiApiGet($service))->execute(['path' => 'https://evil.example.test/user']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new TravisCiApiGet(new TravisCiService('', 'https://travis.example.test')))->execute(['path' => '/user']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new TravisCiToolProvider();

        self::assertSame(['success' => false, 'error' => 'Travis CI API token is required.'], $provider->testConnection([]));

        Http::fake(['https://api.travis-ci.com/user' => Http::response(['login' => 'ada'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Travis CI as ada.'], $provider->testConnection([
            'api_token' => 'travis-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://travis.internal.test/user' => Http::response(['login' => 'ops'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['travis-ci', 'api_token', 'ops'] => 'account-token',
                    ['travis-ci', 'url', 'ops'] => 'https://travis.internal.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'travis-ci' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'travis-ci' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(TravisCiApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/user'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://travis.internal.test/user'
            && $request->hasHeader('Authorization', 'token account-token'));
    }
}
