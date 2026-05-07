<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Appetize;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Appetize\AppetizeService;
use OpenCompany\Integrations\Appetize\AppetizeToolProvider;
use OpenCompany\Integrations\Appetize\Tools\AppetizeApiGet;
use OpenCompany\Integrations\Appetize\Tools\AppetizeCreateApp;
use OpenCompany\Integrations\Appetize\Tools\AppetizeGetApp;
use OpenCompany\Integrations\Appetize\Tools\AppetizeListApps;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Appetize REST API integration.
 */
final class AppetizeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AppetizeService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AppetizeService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new AppetizeToolProvider();

        self::assertSame('appetize', $provider->appName());
        self::assertSame('Appetize', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(11, $provider->tools());
        self::assertArrayHasKey('appetize_create_app', $provider->tools());
        self::assertArrayHasKey('appetize_get_usage_summary', $provider->tools());
        self::assertArrayHasKey('appetize_list_devices', $provider->tools());
        self::assertArrayHasKey('appetize_api_get', $provider->tools());
    }

    public function test_service_maps_documented_appetize_api_endpoints(): void
    {
        Http::fake([
            'https://api.appetize.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new AppetizeService('app-token', 'https://api.appetize.test');
        $service->listApps(['nextKey' => 'cursor-1']);
        $service->listAllApps();
        $service->getApp('public-key');
        $service->createApp(['url' => 'https://example.test/app.apk', 'platform' => 'android']);
        $service->updateApp('public-key', ['note' => 'updated']);
        $service->deleteApp('public-key');
        $service->getUsageSummary(['startMonth' => '2026-05']);
        $service->listDevices(['platform' => 'ios']);
        $service->apiGet('/v1/apps', ['nextKey' => 'cursor-2']);
        $service->apiPost('/v1/apps/public-key', ['note' => 'raw']);
        $service->apiDelete('/v1/apps/public-key');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-API-KEY', 'app-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.appetize.test/v1/apps?nextKey=cursor-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.appetize.test/v1/apps/all');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.appetize.test/v1/apps/public-key');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.appetize.test/v1/apps' && $request->data()['url'] === 'https://example.test/app.apk');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.appetize.test/v1/apps/public-key' && $request->data()['note'] === 'updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.appetize.test/v1/apps/public-key');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.appetize.test/v1/usageSummary?startMonth=2026-05');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.appetize.test/v2/service/devices?platform=ios');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.appetize.test/v1/apps?nextKey=cursor-2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.appetize.test/v1/apps/public-key' && $request->data()['note'] === 'raw');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://api.appetize.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new AppetizeService('app-token', 'https://api.appetize.test');

        self::assertTrue((new AppetizeListApps($service))->execute(['nextKey' => 'cursor'])->succeeded());
        self::assertTrue((new AppetizeGetApp($service))->execute(['public_key' => 'public-key'])->succeeded());
        self::assertTrue((new AppetizeCreateApp($service))->execute([
            'payload' => ['url' => 'https://example.test/app.apk', 'platform' => 'android'],
        ])->succeeded());

        $badRaw = (new AppetizeApiGet($service))->execute(['path' => 'https://evil.example.test/v1/apps']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new AppetizeApiGet(new AppetizeService('', 'https://api.appetize.test')))->execute(['path' => '/v1/apps']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new AppetizeToolProvider();

        self::assertSame(['success' => false, 'error' => 'Appetize API key is required.'], $provider->testConnection([]));

        Http::fake(['https://api.appetize.io/v1/apps' => Http::response(['data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Appetize API.'], $provider->testConnection([
            'api_key' => 'app-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.appetize.test/v1/apps?nextKey=ops' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['appetize', 'api_key', 'ops'] => 'account-token',
                    ['appetize', 'url', 'ops'] => 'https://ops.appetize.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'appetize' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'appetize' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(AppetizeApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/v1/apps', 'nextKey' => 'ops'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.appetize.test/v1/apps?nextKey=ops'
            && $request->hasHeader('X-API-KEY', 'account-token'));
    }
}
