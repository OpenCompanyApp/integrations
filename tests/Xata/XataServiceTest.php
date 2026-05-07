<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Xata;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Xata\Tools\XataGetRecord;
use OpenCompany\Integrations\Xata\Tools\XataListDatabases;
use OpenCompany\Integrations\Xata\Tools\XataQueryTable;
use OpenCompany\Integrations\Xata\Tools\XataUpdateRecord;
use OpenCompany\Integrations\Xata\XataService;
use OpenCompany\Integrations\Xata\XataToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Xata API mapping.
 */
final class XataServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(XataService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(XataService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_docs_are_complete(): void
    {
        $provider = new XataToolProvider;

        self::assertSame('xata', $provider->appName());
        self::assertSame('Xata', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(15, $provider->tools());
        self::assertArrayHasKey('xata_query_table', $provider->tools());
        self::assertArrayHasKey('xata_transaction', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/xata/src/Tools/' . $shortName . '.php');
        }
    }

    public function test_management_and_data_plane_paths_are_mapped(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new XataService('xata-key', 'ws_default', 'https://db.example.test', 'https://api.example.test');

        self::assertTrue((new XataListDatabases($service))->execute(['workspace_id' => 'ws_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/workspaces/ws_123/dbs'
            && $request->hasHeader('Authorization', 'Bearer xata-key'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['records' => []], 200)]);
        self::assertTrue((new XataQueryTable($service))->execute([
            'database' => 'app',
            'branch' => 'main',
            'table' => 'contacts',
            'body' => ['page' => ['size' => 10]],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://db.example.test/db/app:main/tables/contacts/query'
            && $request['page'] === ['size' => 10]);
    }

    public function test_record_tools_shape_official_record_paths(): void
    {
        Http::fake(['*' => Http::response(['id' => 'rec_1'], 200)]);

        $service = new XataService('xata-key', apiEndpoint: 'https://db.example.test');

        self::assertTrue((new XataGetRecord($service))->execute([
            'database' => 'app',
            'branch' => 'main',
            'table' => 'contacts',
            'record_id' => 'rec_1',
            'columns' => ['name', 'email'],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://db.example.test/db/app:main/tables/contacts/data/rec_1?columns%5B0%5D=name&columns%5B1%5D=email');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'rec_1', 'name' => 'Ada'], 200)]);

        self::assertTrue((new XataUpdateRecord($service))->execute([
            'database' => 'app',
            'branch' => 'main',
            'table' => 'contacts',
            'record_id' => 'rec_1',
            'body' => ['name' => 'Ada'],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://db.example.test/db/app:main/tables/contacts/data/rec_1'
            && $request['name'] === 'Ada');
    }

    public function test_multi_account_resolution_uses_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['dbs' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['xata', 'api_key', 'workspace'] => 'account-key',
                    ['xata', 'workspace_id', 'workspace'] => 'ws_123',
                    ['xata', 'api_endpoint', 'workspace'] => 'https://account-db.example.test',
                    ['xata', 'url', 'workspace'] => 'https://account-api.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'xata' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'xata' ? ['workspace'] : [];
            }
        });

        $tool = (new XataToolProvider)->createTool(\OpenCompany\Integrations\Xata\Tools\XataListDatabases::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute(['workspace_id' => 'ws_123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-api.example.test/workspaces/ws_123/dbs'
            && $request->hasHeader('Authorization', 'Bearer account-key'));
    }
}
