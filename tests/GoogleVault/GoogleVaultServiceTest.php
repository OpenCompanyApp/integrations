<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleVault;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleVault\GoogleVaultService;
use OpenCompany\Integrations\GoogleVault\GoogleVaultToolProvider;
use OpenCompany\Integrations\GoogleVault\Tools\GoogleVaultMattersCreate;
use OpenCompany\Integrations\GoogleVault\Tools\GoogleVaultMattersGet;
use OpenCompany\Integrations\GoogleVault\Tools\GoogleVaultMattersList;
use PHPUnit\Framework\TestCase;

final class GoogleVaultServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleVaultToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-vault/google-vault-discovery-manifest.json'), true);

        self::assertSame(33, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Vault', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], chr(92)) + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-vault/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_vault_matters_create', $manifestTools);
        self::assertContains('google_vault_matters_holds_accounts_create', $manifestTools);
        self::assertContains('google_vault_matters_exports_create', $manifestTools);
        self::assertContains('google_vault_operations_cancel', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleVaultService('token-test', 'https://example.test');
        $service->request('GET', '/v1/matters', [], [], ['pageSize' => 5]);
        $service->request('POST', '/v1/matters/{matterId}/exports', ['matterId' => 'matter-1'], [], [], ['name' => 'Export']);
        $service->request('GET', '/v1/{+name}', ['name' => 'operations/operation-1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/matters?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/matters/matter-1/exports'
            && $request['name'] === 'Export');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/operations/operation-1');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleVaultService('token-test');

        $list = new GoogleVaultMattersList($service);
        $result = $list->execute(['pageSize' => 10, 'view' => 'BASIC', 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://vault.googleapis.com/v1/matters?pageSize=10&view=BASIC');

        $missingPath = (new GoogleVaultMattersGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('matterId must be', (string) $missingPath->error);

        $missingBody = (new GoogleVaultMattersCreate($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}