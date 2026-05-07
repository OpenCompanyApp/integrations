<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MongoDB;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MongoDB\MongoDBService;
use OpenCompany\Integrations\MongoDB\MongoDBToolProvider;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBDeleteMany;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBFind;
use OpenCompany\Integrations\MongoDB\Tools\MongoDBUpdateMany;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for the MongoDB Atlas Data API action mapping.
 */
final class MongoDBServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(MongoDBService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(MongoDBService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_data_api_actions_only(): void
    {
        $provider = new MongoDBToolProvider;

        self::assertSame('mongodb', $provider->appName());
        self::assertSame('MongoDB Atlas', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://www.mongodb.com/docs/api/doc/atlas-data-api-v1/', $provider->integrationMeta()['source_url']);
        self::assertCount(9, $provider->tools());
        self::assertArrayHasKey('mongodb_update_many', $provider->tools());
        self::assertArrayHasKey('mongodb_delete_many', $provider->tools());
        self::assertArrayNotHasKey('mongodb_list_collections', $provider->tools());
        self::assertArrayNotHasKey('mongodb_get_current_user', $provider->tools());
    }

    public function test_service_uses_official_action_paths_headers_and_data_source(): void
    {
        $service = new MongoDBService(
            apiKey: 'token-123',
            clusterUrl: 'https://data.example.test/app/data-abc/endpoint/data/v1',
            dataSource: 'example-source',
        );

        Http::fake(['*' => Http::response(['documents' => []], 200)]);
        self::assertTrue((new MongoDBFind($service))->execute([
            'database' => 'app',
            'collection' => 'customers',
            'filter' => ['status' => 'active'],
            'limit' => 10,
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://data.example.test/app/data-abc/endpoint/data/v1/action/find'
            && $request->hasHeader('apiKey', 'token-123')
            && $request->hasHeader('Content-Type', 'application/ejson')
            && $request['dataSource'] === 'example-source'
            && $request['database'] === 'app'
            && $request['collection'] === 'customers'
            && $request['filter'] === ['status' => 'active']
            && $request['limit'] === 10);
    }

    public function test_multi_document_actions_and_connection_check(): void
    {
        $service = new MongoDBService('token-123', 'https://data.example.test/endpoint/data/v1');

        Http::fake(['*' => Http::response(['matchedCount' => 2, 'modifiedCount' => 2], 200)]);
        self::assertTrue((new MongoDBUpdateMany($service))->execute([
            'database' => 'app',
            'collection' => 'customers',
            'filter' => ['status' => 'trial'],
            'update' => ['$set' => ['status' => 'active']],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/endpoint/data/v1/action/updateMany'
            && $request['dataSource'] === 'mongodb-atlas');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['deletedCount' => 3], 200)]);
        self::assertTrue((new MongoDBDeleteMany($service))->execute([
            'database' => 'app',
            'collection' => 'sessions',
            'filter' => ['expired' => true],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/endpoint/data/v1/action/deleteMany');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['documents' => []], 200)]);
        self::assertSame(
            ['success' => true, 'message' => 'Connected to MongoDB Atlas Data API at https://data.example.test/endpoint/data/v1.'],
            (new MongoDBToolProvider)->testConnection([
                'api_key' => 'token-123',
                'cluster_url' => 'https://data.example.test/endpoint/data/v1',
                'data_source' => 'example-source',
            ]),
        );
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/endpoint/data/v1/action/find'
            && $request['dataSource'] === 'example-source');
    }

    public function test_multi_account_resolution_uses_account_data_source(): void
    {
        Http::fake(['*' => Http::response(['documents' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['mongodb', 'api_key', 'workspace'] => 'account-token',
                    ['mongodb', 'cluster_url', 'workspace'] => 'https://account.example.test/endpoint/data/v1',
                    ['mongodb', 'data_source', 'workspace'] => 'account-source',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'mongodb' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'mongodb' ? ['workspace'] : [];
            }
        });

        $tool = (new MongoDBToolProvider)->createTool(MongoDBFind::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([
            'database' => 'app',
            'collection' => 'customers',
            'filter' => [],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account.example.test/endpoint/data/v1/action/find'
            && $request->hasHeader('apiKey', 'account-token')
            && $request['dataSource'] === 'account-source');
    }
}
