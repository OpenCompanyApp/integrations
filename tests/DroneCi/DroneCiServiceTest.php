<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\DroneCi;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\DroneCi\DroneCiService;
use OpenCompany\Integrations\DroneCi\DroneCiToolProvider;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiApiGet;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiGetBuildLogs;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiListBuilds;
use OpenCompany\Integrations\DroneCi\Tools\DroneCiRestartBuild;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Drone remote API integration.
 */
final class DroneCiServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(DroneCiService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(DroneCiService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new DroneCiToolProvider();

        self::assertSame('drone-ci', $provider->appName());
        self::assertSame('Drone CI', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(36, $provider->tools());
        self::assertArrayHasKey('drone_ci_create_build', $provider->tools());
        self::assertArrayHasKey('drone_ci_trigger_cron', $provider->tools());
        self::assertArrayHasKey('drone_ci_create_secret', $provider->tools());
        self::assertArrayHasKey('drone_ci_api_get', $provider->tools());
    }

    public function test_service_maps_documented_drone_api_endpoints(): void
    {
        Http::fake([
            'https://drone.example.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new DroneCiService('drone-token', 'https://drone.example.test');
        $service->getCurrentUser();
        $service->getCurrentUserFeed(['page' => 1]);
        $service->listCurrentUserRepos(['latest' => true]);
        $service->syncCurrentUser();
        $service->getRepo('acme', 'web');
        $service->enableRepo('acme', 'web');
        $service->updateRepo('acme', 'web', ['trusted' => true]);
        $service->disableRepo('acme', 'web');
        $service->repairRepo('acme', 'web');
        $service->chownRepo('acme', 'web');
        $service->listBuilds('acme', 'web', ['branch' => 'main']);
        $service->createBuild('acme', 'web', ['branch' => 'main', 'commit' => 'abc123']);
        $service->getBuild('acme', 'web', 42);
        $service->restartBuild('acme', 'web', 42);
        $service->stopBuild('acme', 'web', 42);
        $service->approveBuild('acme', 'web', 42);
        $service->declineBuild('acme', 'web', 42);
        $service->promoteBuild('acme', 'web', 42, ['target' => 'production']);
        $service->getBuildLogs('acme', 'web', 42, 1, 2);
        $service->listCron('acme', 'web');
        $service->createCron('acme', 'web', ['name' => 'nightly', 'expr' => '@daily']);
        $service->getCron('acme', 'web', 'nightly');
        $service->updateCron('acme', 'web', 'nightly', ['disabled' => false]);
        $service->deleteCron('acme', 'web', 'nightly');
        $service->triggerCron('acme', 'web', 'nightly');
        $service->listSecrets('acme', 'web');
        $service->createSecret('acme', 'web', ['name' => 'DEPLOY_TOKEN', 'data' => 'dummy']);
        $service->getSecret('acme', 'web', 'DEPLOY_TOKEN');
        $service->updateSecret('acme', 'web', 'DEPLOY_TOKEN', ['data' => 'dummy-2']);
        $service->deleteSecret('acme', 'web', 'DEPLOY_TOKEN');
        $service->listUsers();
        $service->getUser('ada');
        $service->apiGet('/api/user', ['fresh' => true]);
        $service->apiPost('/api/user/repos');
        $service->apiPatch('/api/repos/acme/web', ['trusted' => false]);
        $service->apiDelete('/api/repos/acme/web');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer drone-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://drone.example.test/api/user');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://drone.example.test/api/user/feed?page=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://drone.example.test/api/user/repos?latest=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/user/repos');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://drone.example.test/api/repos/acme/web' && $request->data()['trusted'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/builds?branch=main&commit=abc123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/builds/42/restart');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://drone.example.test/api/repos/acme/web/builds/42');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/builds/42/approve');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/builds/42/decline');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/builds/42/promote?target=production');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://drone.example.test/api/repos/acme/web/builds/42/logs/1/2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/cron' && $request->data()['name'] === 'nightly');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/cron/nightly');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://drone.example.test/api/repos/acme/web/secrets' && $request->data()['name'] === 'DEPLOY_TOKEN');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://drone.example.test/api/repos/acme/web/secrets/DEPLOY_TOKEN' && $request->data()['data'] === 'dummy-2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://drone.example.test/api/users/ada');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://drone.example.test/api/user?fresh=1');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://drone.example.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new DroneCiService('drone-token', 'https://drone.example.test');

        self::assertTrue((new DroneCiListBuilds($service))->execute([
            'owner' => 'acme',
            'repo' => 'web',
            'query' => ['branch' => 'main'],
        ])->succeeded());
        self::assertTrue((new DroneCiRestartBuild($service))->execute([
            'owner' => 'acme',
            'repo' => 'web',
            'build' => 42,
        ])->succeeded());
        self::assertTrue((new DroneCiGetBuildLogs($service))->execute([
            'owner' => 'acme',
            'repo' => 'web',
            'build' => 42,
            'stage' => 1,
            'step' => 2,
        ])->succeeded());

        $badRaw = (new DroneCiApiGet($service))->execute(['path' => 'https://evil.example.test/api/user']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new DroneCiApiGet(new DroneCiService('', 'https://drone.example.test')))->execute(['path' => '/api/user']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new DroneCiToolProvider();

        self::assertSame(['success' => false, 'error' => 'Drone CI URL and access token are required.'], $provider->testConnection([]));

        Http::fake(['https://drone.example.test/api/user' => Http::response(['login' => 'ada'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Drone CI as ada.'], $provider->testConnection([
            'url' => 'https://drone.example.test',
            'access_token' => 'drone-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.drone.example.test/api/user?fresh=1' => Http::response(['login' => 'ops'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['drone-ci', 'access_token', 'ops'] => 'account-token',
                    ['drone-ci', 'url', 'ops'] => 'https://ops.drone.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'drone-ci' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'drone-ci' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(DroneCiApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/api/user', 'query' => ['fresh' => true]])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.drone.example.test/api/user?fresh=1'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
