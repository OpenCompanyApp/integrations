<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SauceLabs;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\SauceLabs\SauceLabsService;
use OpenCompany\Integrations\SauceLabs\SauceLabsToolProvider;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsApiGet;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsGetJobAsset;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsListBuilds;
use OpenCompany\Integrations\SauceLabs\Tools\SauceLabsStopRdcJob;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for Sauce Labs REST APIs.
 */
final class SauceLabsServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(SauceLabsService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(SauceLabsService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new SauceLabsToolProvider();

        self::assertSame('sauce-labs', $provider->appName());
        self::assertSame('Sauce Labs', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('basic_auth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(26, $provider->tools());
        self::assertArrayHasKey('sauce_labs_list_jobs', $provider->tools());
        self::assertArrayHasKey('sauce_labs_list_builds', $provider->tools());
        self::assertArrayHasKey('sauce_labs_get_rdc_job_asset', $provider->tools());
        self::assertArrayHasKey('sauce_labs_api_get', $provider->tools());
    }

    public function test_service_maps_documented_sauce_labs_endpoints(): void
    {
        Http::fake([
            'https://api.sauce.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new SauceLabsService('sauce-user', 'sauce-key', 'https://api.sauce.test');
        $service->getStatus();
        $service->listPlatforms('all');
        $service->listJobs('', ['limit' => 5]);
        $service->getJob('sauce-user', 'job-1');
        $service->updateJob('sauce-user', 'job-1', ['passed' => true]);
        $service->stopJob('sauce-user', 'job-1');
        $service->deleteJob('sauce-user', 'job-1');
        $service->listJobAssets('sauce-user', 'job-1');
        $service->getJobAsset('sauce-user', 'job-1', 'selenium-server.log');
        $service->listBuilds('vdc', ['limit' => 10]);
        $service->getBuild('vdc', 'build-1');
        $service->getJobBuild('vdc', 'job-1');
        $service->listBuildJobs('vdc', 'build-1', ['failed' => true]);
        $service->listRdcJobs(['limit' => 10]);
        $service->getRdcJob('rdc-job-1');
        $service->getRdcJobAsset('rdc-job-1', 'deviceLogs');
        $service->stopRdcJob('rdc-job-1');
        $service->deleteRdcJob('rdc-job-1');
        $service->listPrivateDevices();
        $service->listTunnels('');
        $service->getTunnel('sauce-user', 'tunnel-1');
        $service->getTunnelJobsCount('sauce-user', 'tunnel-1');
        $service->stopTunnel('sauce-user', 'tunnel-1');
        $service->apiGet('/rest/v1/info/status');
        $service->apiPut('/rest/v1/sauce-user/jobs/job-1', ['passed' => false]);
        $service->apiDelete('/rest/v1/sauce-user/jobs/job-1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('sauce-user:sauce-key')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/rest/v1/info/status');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/rest/v1/info/platforms/all');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/jobs?limit=5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/jobs/job-1' && ($request->data()['passed'] ?? null) === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/jobs/job-1/stop');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/jobs/job-1/assets');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/jobs/job-1/assets/selenium-server.log');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/v2/builds/vdc/?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/v2/builds/vdc/build-1/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/v2/builds/vdc/jobs/job-1/build/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/v2/builds/vdc/build-1/jobs/?failed=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/v1/rdc/jobs?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/v1/rdc/jobs/rdc-job-1/deviceLogs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.sauce.test/v1/rdc/jobs/rdc-job-1/stop');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/v1/rdc/device-management/devices');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/tunnels');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/tunnels/tunnel-1/num_jobs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.sauce.test/rest/v1/sauce-user/tunnels/tunnel-1');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://api.sauce.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new SauceLabsService('sauce-user', 'sauce-key', 'https://api.sauce.test');

        self::assertTrue((new SauceLabsListBuilds($service))->execute([
            'build_source' => 'vdc',
            'query' => ['limit' => 5],
        ])->succeeded());
        self::assertTrue((new SauceLabsGetJobAsset($service))->execute([
            'username' => 'sauce-user',
            'job_id' => 'job-1',
            'file_name' => 'selenium-server.log',
        ])->succeeded());
        self::assertTrue((new SauceLabsStopRdcJob($service))->execute(['job_id' => 'rdc-job-1'])->succeeded());

        $badRaw = (new SauceLabsApiGet($service))->execute(['path' => 'https://evil.example.test/rest/v1/info/status']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new SauceLabsApiGet(new SauceLabsService('', '', 'https://api.sauce.test')))->execute(['path' => '/rest/v1/info/status']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new SauceLabsToolProvider();

        self::assertSame(['success' => false, 'error' => 'Sauce Labs username and access key are required.'], $provider->testConnection([]));

        Http::fake(['https://api.us-west-1.saucelabs.com/rest/v1/info/status' => Http::response(['status' => 'ok'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Sauce Labs API.'], $provider->testConnection([
            'username' => 'sauce-user',
            'access_key' => 'sauce-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.sauce.test/rest/v1/info/status' => Http::response(['status' => 'ok'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['sauce-labs', 'username', 'ops'] => 'account-user',
                    ['sauce-labs', 'access_key', 'ops'] => 'account-key',
                    ['sauce-labs', 'url', 'ops'] => 'https://ops.sauce.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'sauce-labs' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'sauce-labs' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(SauceLabsApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/rest/v1/info/status'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.sauce.test/rest/v1/info/status'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('account-user:account-key')));
    }
}
