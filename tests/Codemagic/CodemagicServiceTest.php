<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Codemagic;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Codemagic\CodemagicService;
use OpenCompany\Integrations\Codemagic\CodemagicToolProvider;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicApiGet;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicCancelBuild;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicListApps;
use OpenCompany\Integrations\Codemagic\Tools\CodemagicStartBuild;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Codemagic REST API integration.
 */
final class CodemagicServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CodemagicService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CodemagicService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new CodemagicToolProvider();

        self::assertSame('codemagic', $provider->appName());
        self::assertSame('Codemagic', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(15, $provider->tools());
        self::assertArrayHasKey('codemagic_start_build', $provider->tools());
        self::assertArrayHasKey('codemagic_get_artifact', $provider->tools());
        self::assertArrayHasKey('codemagic_delete_cache', $provider->tools());
        self::assertArrayHasKey('codemagic_api_get', $provider->tools());
    }

    public function test_service_maps_documented_codemagic_api_endpoints(): void
    {
        Http::fake([
            'https://api.codemagic.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new CodemagicService('cm-token', 'https://api.codemagic.test');
        $service->listApps(['teamId' => 'team-1']);
        $service->getApp('app-1');
        $service->createApp(['repositoryUrl' => 'git@example.test:acme/web.git']);
        $service->createPrivateApp(['repositoryUrl' => 'git@example.test:acme/private.git', 'sshKey' => ['data' => 'base64', 'passphrase' => null]]);
        $service->startBuild(['appId' => 'app-1', 'workflowId' => 'release', 'branch' => 'main']);
        $service->cancelBuild('build-1');
        $service->getArtifact('secure/path/app.ipa');
        $service->createArtifactPublicUrl('secure/path/app.ipa', ['expiresAt' => 1767225600]);
        $service->listCaches('app-1');
        $service->deleteCaches('app-1');
        $service->deleteCache('app-1', 'cache-1');
        $service->apiGet('/apps', ['limit' => 1]);
        $service->apiPost('/builds', ['appId' => 'app-1']);
        $service->apiPatch('/apps/app-1', ['appName' => 'Mobile']);
        $service->apiDelete('/apps/app-1/caches/cache-1', ['hard' => true]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('x-auth-token', 'cm-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.codemagic.test/apps?teamId=team-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.codemagic.test/apps/app-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.codemagic.test/apps' && $request->data()['repositoryUrl'] === 'git@example.test:acme/web.git');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.codemagic.test/apps/new' && $request->data()['sshKey']['data'] === 'base64');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.codemagic.test/builds' && ($request->data()['workflowId'] ?? null) === 'release');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.codemagic.test/builds/build-1/cancel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.codemagic.test/artifacts/secure/path/app.ipa');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.codemagic.test/artifacts/secure/path/app.ipa/public-url' && $request->data()['expiresAt'] === 1767225600);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.codemagic.test/apps/app-1/caches');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.codemagic.test/apps/app-1/caches/cache-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.codemagic.test/apps/app-1/caches/cache-1?hard=1');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://api.codemagic.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new CodemagicService('cm-token', 'https://api.codemagic.test');

        self::assertTrue((new CodemagicListApps($service))->execute([
            'query' => ['teamId' => 'team-1'],
        ])->succeeded());
        self::assertTrue((new CodemagicStartBuild($service))->execute([
            'payload' => ['appId' => 'app-1', 'workflowId' => 'release', 'branch' => 'main'],
        ])->succeeded());
        self::assertTrue((new CodemagicCancelBuild($service))->execute(['build_id' => 'build-1'])->succeeded());

        $badRaw = (new CodemagicApiGet($service))->execute(['path' => 'https://evil.example.test/apps']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new CodemagicApiGet(new CodemagicService('', 'https://api.codemagic.test')))->execute(['path' => '/apps']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new CodemagicToolProvider();

        self::assertSame(['success' => false, 'error' => 'Codemagic API token is required.'], $provider->testConnection([]));

        Http::fake(['https://api.codemagic.io/apps' => Http::response(['applications' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Codemagic API.'], $provider->testConnection([
            'api_token' => 'cm-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.codemagic.test/apps?limit=1' => Http::response(['applications' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['codemagic', 'api_token', 'ops'] => 'account-token',
                    ['codemagic', 'url', 'ops'] => 'https://ops.codemagic.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'codemagic' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'codemagic' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(CodemagicApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/apps', 'query' => ['limit' => 1]])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.codemagic.test/apps?limit=1'
            && $request->hasHeader('x-auth-token', 'account-token'));
    }
}
