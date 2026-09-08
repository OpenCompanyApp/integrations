<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\BrowserStack;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\BrowserStack\BrowserStackService;
use OpenCompany\Integrations\BrowserStack\BrowserStackToolProvider;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackApiGet;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackGetSessionLogs;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackListBuilds;
use OpenCompany\Integrations\BrowserStack\Tools\BrowserStackUploadApp;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for BrowserStack Automate and App Automate APIs.
 */
final class BrowserStackServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BrowserStackService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BrowserStackService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new BrowserStackToolProvider();

        self::assertSame('browserstack', $provider->appName());
        self::assertSame('BrowserStack', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('basic_auth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(23, $provider->tools());
        self::assertArrayHasKey('browserstack_get_plan', $provider->tools());
        self::assertArrayHasKey('browserstack_list_build_sessions', $provider->tools());
        self::assertArrayHasKey('browserstack_upload_app', $provider->tools());
        self::assertArrayHasKey('browserstack_api_get', $provider->tools());
    }

    public function test_service_maps_documented_browserstack_api_endpoints(): void
    {
        Http::fake([
            'https://api.browserstack.test/*' => Http::response(['id' => 'ok'], 200),
            'https://api-cloud.browserstack.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new BrowserStackService('bs-user', 'bs-key', 'https://api.browserstack.test', 'https://api-cloud.browserstack.test');
        $service->getPlan();
        $service->listBrowsers(['flat' => true]);
        $service->listProjects(['limit' => 5]);
        $service->getProject('project-1');
        $service->updateProject('project-1', ['name' => 'QA Project']);
        $service->deleteProject('project-1');
        $service->listBuilds(['limit' => 10, 'status' => 'running']);
        $service->updateBuild('build-1', ['build_tag' => 'regression']);
        $service->deleteBuild('build-1');
        $service->deleteBuilds(['buildId' => ['build-1', 'build-2']]);
        $service->listBuildSessions('build-1', ['limit' => 2]);
        $service->getSession('session-1');
        $service->updateSession('session-1', ['status' => 'passed', 'reason' => 'ok']);
        $service->deleteSession('session-1');
        $service->getSessionLogs('session-1');
        $service->getSessionNetworkLogs('session-1');
        $service->uploadApp(['url' => 'https://example.test/app.apk', 'custom_id' => 'SampleApp']);
        $service->listRecentApps();
        $service->listRecentApps('SampleApp');
        $service->deleteApp('app-1');
        $service->apiGet('/automate/plan.json');
        $service->apiPost('/automate/builds/build-1/terminallogs', ['file' => 'dummy']);
        $service->apiPut('/automate/builds/build-1.json', ['name' => 'Updated']);
        $service->apiDelete('/automate/builds', ['buildId' => ['build-3']]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('bs-user:bs-key')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.browserstack.test/automate/plan.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.browserstack.test/automate/browsers.json?flat=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.browserstack.test/automate/projects.json?limit=5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.browserstack.test/automate/projects/project-1.json' && $request->data()['name'] === 'QA Project');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.browserstack.test/automate/builds.json?limit=10&status=running');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.browserstack.test/automate/builds/build-1.json' && ($request->data()['build_tag'] ?? null) === 'regression');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && str_contains($request->url(), 'https://api.browserstack.test/automate/builds?') && str_contains($request->url(), 'buildId%5B0%5D=build-1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.browserstack.test/automate/builds/build-1/sessions.json?limit=2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.browserstack.test/automate/sessions/session-1/logs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.browserstack.test/automate/sessions/session-1/networklogs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api-cloud.browserstack.test/app-automate/upload' && $request->data()['url'] === 'https://example.test/app.apk');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api-cloud.browserstack.test/app-automate/recent_apps');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api-cloud.browserstack.test/app-automate/recent_apps/SampleApp');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api-cloud.browserstack.test/app-automate/app/delete/app-1');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://api.browserstack.test/*' => Http::response(['id' => 'ok'], 200),
            'https://api-cloud.browserstack.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new BrowserStackService('bs-user', 'bs-key', 'https://api.browserstack.test', 'https://api-cloud.browserstack.test');

        self::assertTrue((new BrowserStackListBuilds($service))->execute([
            'limit' => 5,
            'status' => 'running',
        ])->succeeded());
        self::assertTrue((new BrowserStackGetSessionLogs($service))->execute(['session_id' => 'session-1'])->succeeded());
        self::assertTrue((new BrowserStackUploadApp($service))->execute([
            'payload' => ['url' => 'https://example.test/app.apk'],
        ])->succeeded());

        $badRaw = (new BrowserStackApiGet($service))->execute(['path' => 'https://evil.example.test/automate/plan.json']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new BrowserStackApiGet(new BrowserStackService('', '', 'https://api.browserstack.test')))->execute(['path' => '/automate/plan.json']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new BrowserStackToolProvider();

        self::assertSame(['success' => false, 'error' => 'BrowserStack username and access key are required.'], $provider->testConnection([]));

        Http::fake(['https://api.browserstack.com/automate/plan.json' => Http::response(['automate_plan' => 'Automate Pro'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to BrowserStack Automate Pro.'], $provider->testConnection([
            'username' => 'bs-user',
            'access_key' => 'bs-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.browserstack.test/automate/plan.json' => Http::response(['automate_plan' => 'Ops'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['browserstack', 'username', 'ops'] => 'account-user',
                    ['browserstack', 'access_key', 'ops'] => 'account-key',
                    ['browserstack', 'url', 'ops'] => 'https://ops.browserstack.test',
                    ['browserstack', 'cloud_url', 'ops'] => 'https://ops-cloud.browserstack.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'browserstack' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'browserstack' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(BrowserStackApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/automate/plan.json'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.browserstack.test/automate/plan.json'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('account-user:account-key')));
    }
}
