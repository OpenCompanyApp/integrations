<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CockroachDb;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\CockroachDb\CockroachDbOperations;
use OpenCompany\Integrations\CockroachDb\CockroachDbService;
use OpenCompany\Integrations\CockroachDb\CockroachDbToolProvider;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbCreateCluster;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbGetCluster;
use OpenCompany\Integrations\CockroachDb\Tools\CockroachDbListClusters;
use PHPUnit\Framework\TestCase;

final class CockroachDbServiceTest extends TestCase
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

    public function test_provider_exposes_generated_metadata_and_tools(): void
    {
        $provider = new CockroachDbToolProvider;

        self::assertSame('cockroachdb', $provider->appName());
        self::assertSame('CockroachDB', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://www.cockroachlabs.com/docs/api/cloud/v1.html', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://cockroachlabs.cloud/assets/docs/api/latest/openapi.json', $provider->integrationMeta()['source_url']);
        self::assertCount(144, CockroachDbOperations::all());
        self::assertCount(144, $provider->tools());
        self::assertArrayHasKey('cockroachdb_list_clusters', $provider->tools());
        self::assertArrayHasKey('cockroachdb_get_cluster', $provider->tools());
        self::assertArrayHasKey('cockroachdb_create_cluster', $provider->tools());
        self::assertArrayHasKey('cockroachdb_list_databases', $provider->tools());
        self::assertArrayHasKey('cockroachdb_list_users', $provider->tools());
        self::assertArrayHasKey('cockroachdb_list_api_keys', $provider->tools());
        self::assertArrayHasKey('cockroachdb_get_groups', $provider->tools());
        self::assertArrayNotHasKey('cockroachdb_get_current_user', $provider->tools());
        self::assertArrayNotHasKey('cockroachdb_get_database', $provider->tools());
    }

    public function test_service_maps_common_cloud_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://cockroach.example.test/api/v1/clusters/cluster-123' => Http::response(['id' => 'cluster-123'], 200),
            'https://cockroach.example.test/api/v1/clusters/cluster-123/databases*' => Http::response(['databases' => [['name' => 'defaultdb']]], 200),
            'https://cockroach.example.test/api/v1/clusters/cluster-123/sql-users*' => Http::response(['users' => [['name' => 'agent']]], 200),
            'https://cockroach.example.test/api/v1/clusters*' => Http::response(['clusters' => [['id' => 'cluster-123']]], 200),
        ]);

        $service = new CockroachDbService(accessToken: 'crdb-token', baseUrl: 'https://cockroach.example.test');

        self::assertSame(['clusters' => [['id' => 'cluster-123']]], $service->listClusters(10, 'next'));
        self::assertSame(['id' => 'cluster-123'], $service->getCluster('cluster-123'));
        self::assertSame(['clusters' => [['id' => 'cluster-123']]], $service->createCluster(['name' => 'agent-demo']));
        self::assertSame(['databases' => [['name' => 'defaultdb']]], $service->listDatabases('cluster-123', 20));
        self::assertSame(['users' => [['name' => 'agent']]], $service->listUsers('cluster-123'));

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://cockroach.example.test/api/v1/clusters?')
                && ($query['pagination_limit'] ?? null) === '10'
                && ($query['pagination_page'] ?? null) === 'next'
                && $request->hasHeader('Authorization', 'Bearer crdb-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://cockroach.example.test/api/v1/clusters'
            && $request['name'] === 'agent-demo');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://cockroach.example.test/api/v1/clusters/cluster-123/databases?')
                && ($query['pagination_limit'] ?? null) === '20';
        });
    }

    public function test_generated_tools_map_path_query_and_body_arguments(): void
    {
        Http::fake([
            'https://cockroach.example.test/api/v1/clusters/cluster-123' => Http::response(['id' => 'cluster-123'], 200),
            'https://cockroach.example.test/api/v1/clusters*' => Http::response(['clusters' => [['id' => 'cluster-123']]], 200),
        ]);

        $service = new CockroachDbService(accessToken: 'crdb-token', baseUrl: 'https://cockroach.example.test');
        $get = new CockroachDbGetCluster($service);

        $success = $get->execute(['cluster_id' => 'cluster-123']);
        self::assertTrue($success->succeeded());
        self::assertSame('cluster-123', $success->data['id']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The cluster_id parameter is required.', $missing->error);

        $list = new CockroachDbListClusters($service);
        $listed = $list->execute(['pagination_limit' => 5]);
        self::assertTrue($listed->succeeded());
        self::assertSame('cluster-123', $listed->data['clusters'][0]['id']);

        $create = new CockroachDbCreateCluster($service);
        $created = $create->execute(['name' => 'loose-body']);
        self::assertTrue($created->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cockroach.example.test/api/v1/clusters/cluster-123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cockroach.example.test/api/v1/clusters?pagination.limit=5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://cockroach.example.test/api/v1/clusters'
            && $request['name'] === 'loose-body');
    }

    public function test_legacy_api_v1_base_url_is_not_duplicated(): void
    {
        Http::fake([
            'https://cockroach.example.test/api/v1/clusters*' => Http::response(['clusters' => []], 200),
        ]);

        $service = new CockroachDbService(accessToken: 'crdb-token', baseUrl: 'https://cockroach.example.test/api/v1');
        $service->listClusters();

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cockroach.example.test/api/v1/clusters');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-cockroach.example.test/api/v1/clusters*' => Http::response(['clusters' => [['id' => 'tenant']]], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'cockroachdb' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-crdb-token',
                    'url' => 'https://tenant-cockroach.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'cockroachdb' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'cockroachdb' ? ['work'] : [];
            }
        });

        $tool = (new CockroachDbToolProvider)->createTool(CockroachDbListClusters::class, ['account' => 'work']);
        $result = $tool->execute(['pagination_limit' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant', $result->data['clusters'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-cockroach.example.test/api/v1/clusters?pagination.limit=5'
            && $request->hasHeader('Authorization', 'Bearer tenant-crdb-token'));
    }
}
