<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Chroma;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Chroma\ChromaService;
use OpenCompany\Integrations\Chroma\ChromaToolProvider;
use OpenCompany\Integrations\Chroma\Tools\ChromaAddDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaCountCollections;
use OpenCompany\Integrations\Chroma\Tools\ChromaDeleteDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaListCollections;
use OpenCompany\Integrations\Chroma\Tools\ChromaQueryDocuments;
use OpenCompany\Integrations\Chroma\Tools\ChromaUpdateCollection;
use OpenCompany\Integrations\Chroma\Tools\ChromaUpsertDocuments;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Chroma REST API v2 mapping.
 */
final class ChromaServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChromaService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChromaService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_docs_match_v2_api(): void
    {
        $provider = new ChromaToolProvider;

        self::assertSame('chroma', $provider->appName());
        self::assertSame('Chroma', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.trychroma.com/reference/chroma-api', $provider->integrationMeta()['source_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(14, $provider->tools());
        self::assertArrayHasKey('chroma_count_collections', $provider->tools());
        self::assertArrayHasKey('chroma_update_collection', $provider->tools());
        self::assertArrayHasKey('chroma_upsert_documents', $provider->tools());
        self::assertArrayHasKey('chroma_delete_documents', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/chroma/src/Tools/' . $shortName . '.php');
        }
    }

    public function test_v2_collection_endpoints_use_tenant_database_and_token_header(): void
    {
        Http::fake(['*' => Http::response([['id' => 'col_1', 'name' => 'docs']], 200)]);

        $service = new ChromaService('chroma-token', 'https://chroma.example.test/api/v1', 'tenant_1', 'db_1');
        $result = (new ChromaListCollections($service))->execute(['limit' => 25, 'offset' => 50]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://chroma.example.test/api/v2/tenants/tenant_1/databases/db_1/collections?limit=25&offset=50'
            && $request->hasHeader('x-chroma-token', 'chroma-token')
            && !$request->hasHeader('Authorization'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(3, 200)]);

        $count = (new ChromaCountCollections($service))->execute([]);

        self::assertTrue($count->succeeded());
        self::assertSame(['count' => 3], $count->data);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://chroma.example.test/api/v2/tenants/tenant_1/databases/db_1/collections_count');
    }

    public function test_collection_update_and_record_operations_use_official_paths_and_payloads(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ChromaService('chroma-token', 'https://chroma.example.test', 'tenant_1', 'db_1');

        self::assertTrue((new ChromaUpdateCollection($service))->execute([
            'collection_id' => 'col_1',
            'new_name' => 'docs_v2',
            'metadata' => ['owner' => 'docs'],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://chroma.example.test/api/v2/tenants/tenant_1/databases/db_1/collections/col_1'
            && $request['new_name'] === 'docs_v2'
            && $request['new_metadata'] === ['owner' => 'docs']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['added' => true], 200)]);

        self::assertTrue((new ChromaAddDocuments($service))->execute([
            'collection_id' => 'col_1',
            'ids' => ['doc1'],
            'documents' => ['hello'],
            'uris' => ['https://example.test/doc1'],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://chroma.example.test/api/v2/tenants/tenant_1/databases/db_1/collections/col_1/add'
            && $request['ids'] === ['doc1']
            && $request['uris'] === ['https://example.test/doc1']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['ids' => [['doc1']]], 200)]);

        self::assertTrue((new ChromaQueryDocuments($service))->execute([
            'collection_id' => 'col_1',
            'query_embeddings' => [[0.1, 0.2]],
            'ids' => ['doc1'],
            'n_results' => 3,
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://chroma.example.test/api/v2/tenants/tenant_1/databases/db_1/collections/col_1/query'
            && $request['query_embeddings'] === [[0.1, 0.2]]
            && $request['ids'] === ['doc1']);
    }

    public function test_upsert_and_delete_tools_validate_and_map_record_payloads(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ChromaService('chroma-token', 'https://chroma.example.test', 'tenant_1', 'db_1');

        $missingEmbeddings = (new ChromaUpsertDocuments($service))->execute([
            'collection_id' => 'col_1',
            'ids' => ['doc1'],
        ]);
        self::assertFalse($missingEmbeddings->succeeded());
        self::assertSame('embeddings is required.', $missingEmbeddings->error);

        self::assertTrue((new ChromaUpsertDocuments($service))->execute([
            'collection_id' => 'col_1',
            'ids' => ['doc1'],
            'embeddings' => [[0.1, 0.2]],
            'documents' => ['hello'],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://chroma.example.test/api/v2/tenants/tenant_1/databases/db_1/collections/col_1/upsert'
            && $request['embeddings'] === [[0.1, 0.2]]);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['deleted' => 1], 200)]);

        self::assertTrue((new ChromaDeleteDocuments($service))->execute([
            'collection_id' => 'col_1',
            'ids' => ['doc1'],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://chroma.example.test/api/v2/tenants/tenant_1/databases/db_1/collections/col_1/delete'
            && $request['ids'] === ['doc1']);
    }

    public function test_multi_account_resolution_uses_account_tenant_database_and_token(): void
    {
        Http::fake(['*' => Http::response([['name' => 'docs']], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['chroma', 'api_key', 'workspace'] => 'account-token',
                    ['chroma', 'url', 'workspace'] => 'https://account.example.test',
                    ['chroma', 'tenant', 'workspace'] => 'tenant_account',
                    ['chroma', 'database', 'workspace'] => 'db_account',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'chroma' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'chroma' ? ['workspace'] : [];
            }
        });

        $tool = (new ChromaToolProvider)->createTool(ChromaListCollections::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute(['limit' => 10])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account.example.test/api/v2/tenants/tenant_account/databases/db_account/collections?limit=10'
            && $request->hasHeader('x-chroma-token', 'account-token'));
    }
}
