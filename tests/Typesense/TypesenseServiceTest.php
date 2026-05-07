<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Typesense;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Typesense\TypesenseOperations;
use OpenCompany\Integrations\Typesense\TypesenseService;
use OpenCompany\Integrations\Typesense\TypesenseToolProvider;
use OpenCompany\Integrations\Typesense\Tools\TypesenseGetDocument;
use OpenCompany\Integrations\Typesense\Tools\TypesenseGetHealth;
use OpenCompany\Integrations\Typesense\Tools\TypesenseSearchDocuments;
use PHPUnit\Framework\TestCase;

final class TypesenseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new TypesenseToolProvider;

        self::assertSame('typesense', $provider->appName());
        self::assertSame('Typesense', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://raw.githubusercontent.com/typesense/typesense-api-spec/master/openapi.yml', $provider->integrationMeta()['source_url']);
        self::assertCount(79, TypesenseOperations::all());
        self::assertCount(79, $provider->tools());
        self::assertArrayHasKey('typesense_list_collections', $provider->tools());
        self::assertArrayHasKey('typesense_get_collection', $provider->tools());
        self::assertArrayHasKey('typesense_create_collection', $provider->tools());
        self::assertArrayHasKey('typesense_search_documents', $provider->tools());
        self::assertArrayHasKey('typesense_index_document', $provider->tools());
        self::assertArrayHasKey('typesense_get_document', $provider->tools());
        self::assertArrayHasKey('typesense_get_health', $provider->tools());
        self::assertArrayHasKey('typesense_create_key', $provider->tools());
        self::assertArrayHasKey('typesense_upsert_alias', $provider->tools());
    }

    public function test_service_maps_common_endpoints_and_api_key_header(): void
    {
        Http::fake([
            'http://typesense.example.test/collections' => Http::response([['name' => 'companies']], 200),
            'http://typesense.example.test/collections/companies' => Http::response(['name' => 'companies'], 200),
            'http://typesense.example.test/collections/companies/documents/abc123' => Http::response(['id' => 'abc123'], 200),
            'http://typesense.example.test/collections/companies/documents/search*' => Http::response(['found' => 1], 200),
            'http://typesense.example.test/health' => Http::response(['ok' => true], 200),
        ]);

        $service = new TypesenseService(apiKey: 'typesense-key', baseUrl: 'http://typesense.example.test');

        self::assertSame([['name' => 'companies']], $service->listCollections());
        self::assertSame(['name' => 'companies'], $service->getCollection('companies'));
        self::assertSame(['id' => 'abc123'], $service->getDocument('companies', 'abc123'));
        self::assertSame(['found' => 1], $service->searchDocuments('companies', ['q' => 'acme', 'query_by' => 'name']));
        self::assertSame(['ok' => true], $service->getHealth());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'http://typesense.example.test/collections/companies/documents/search?')
                && ($query['q'] ?? null) === 'acme'
                && ($query['query_by'] ?? null) === 'name'
                && $request->hasHeader('X-TYPESENSE-API-KEY', 'typesense-key');
        });
    }

    public function test_generated_tools_map_path_query_and_body_arguments(): void
    {
        Http::fake([
            'http://typesense.example.test/collections/companies/documents/abc123' => Http::response(['id' => 'abc123'], 200),
            'http://typesense.example.test/collections/companies/documents/search*' => Http::response(['found' => 1], 200),
            'http://typesense.example.test/collections/companies/documents' => Http::response(['id' => 'created'], 201),
        ]);

        $service = new TypesenseService(apiKey: 'typesense-key', baseUrl: 'http://typesense.example.test');

        $get = new TypesenseGetDocument($service);
        $success = $get->execute(['collection_name' => 'companies', 'document_id' => 'abc123']);
        self::assertTrue($success->succeeded());
        self::assertSame('abc123', $success->data['id']);

        $missing = $get->execute(['collection_name' => 'companies']);
        self::assertFalse($missing->succeeded());
        self::assertSame('The document_id parameter is required.', $missing->error);

        $search = new TypesenseSearchDocuments($service);
        $listed = $search->execute(['collection_name' => 'companies', 'q' => 'acme', 'query_by' => 'name']);
        self::assertTrue($listed->succeeded());
        self::assertSame(1, $listed->data['found']);

        $created = $service->executeOperation(TypesenseOperations::all()['typesense_index_document'], ['collection_name' => 'companies', 'id' => 'created', 'name' => 'Acme']);
        self::assertSame('created', $created['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'http://typesense.example.test/collections/companies/documents'
            && $request['id'] === 'created'
            && $request['name'] === 'Acme');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'http://tenant-typesense.example.test/health' => Http::response(['ok' => true], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'typesense' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_key' => 'tenant-typesense-key',
                    'url' => 'http://tenant-typesense.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'typesense' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'typesense' ? ['work'] : [];
            }
        });

        $tool = (new TypesenseToolProvider)->createTool(TypesenseGetHealth::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertTrue($result->data['ok']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'http://tenant-typesense.example.test/health'
            && $request->hasHeader('X-TYPESENSE-API-KEY', 'tenant-typesense-key'));
    }
}
