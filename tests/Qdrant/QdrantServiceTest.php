<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Qdrant;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\Integrations\Qdrant\QdrantToolProvider;
use OpenCompany\Integrations\Qdrant\Tools\QdrantQueryPoints;
use OpenCompany\Integrations\Qdrant\Tools\QdrantSetPayload;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Qdrant REST endpoint mappings.
 */
final class QdrantServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_collection_and_point_endpoints_map_to_documented_paths(): void
    {
        Http::fake([
            'https://qdrant.test/collections' => Http::response(['result' => ['collections' => []]], 200),
            'https://qdrant.test/collections/docs' => Http::sequence()
                ->push(['result' => ['status' => 'green']], 200)
                ->push(['result' => true], 200)
                ->push(['result' => true], 200),
            'https://qdrant.test/collections/docs/points/search' => Http::response(['result' => []], 200),
            'https://qdrant.test/collections/docs/points/query' => Http::response(['result' => []], 200),
            'https://qdrant.test/collections/docs/points' => Http::sequence()
                ->push(['result' => []], 200)
                ->push(['result' => ['operation_id' => 1]], 200),
            'https://qdrant.test/collections/docs/points?*' => Http::response(['result' => ['operation_id' => 1]], 200),
            'https://qdrant.test/collections/docs/points/scroll' => Http::response(['result' => ['points' => []]], 200),
            'https://qdrant.test/collections/docs/points/count' => Http::response(['result' => ['count' => 0]], 200),
        ]);

        $service = new QdrantService('key-test', 'https://qdrant.test');
        $service->listCollections();
        $service->getCollection('docs');
        $service->createCollection('docs', ['vectors' => ['size' => 3, 'distance' => 'Cosine']]);
        $service->deleteCollection('docs');
        $service->search('docs', ['vector' => [0.1, 0.2], 'limit' => 2]);
        $service->queryPoints('docs', ['query' => [0.1, 0.2], 'limit' => 2]);
        $service->retrievePoints('docs', ['ids' => [1]]);
        $service->upsertPoints('docs', ['points' => [['id' => 1, 'vector' => [0.1, 0.2]]]], ['wait' => true]);
        $service->scrollPoints('docs', ['limit' => 10]);
        $service->countPoints('docs', ['exact' => true]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://qdrant.test/collections' && $request->hasHeader('api-key', 'key-test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://qdrant.test/collections/docs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://qdrant.test/collections/docs');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/points/search');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/points/query');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://qdrant.test/collections/docs/points' && $request->data()['ids'] === [1]);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && str_starts_with($request->url(), 'https://qdrant.test/collections/docs/points?') && $request->data()['points'][0]['id'] === 1);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/points/scroll');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/points/count');
    }

    public function test_payload_alias_snapshot_and_cluster_endpoints_map_correctly(): void
    {
        Http::fake([
            'https://qdrant.test/collections/docs/points/delete*' => Http::response(['result' => true], 200),
            'https://qdrant.test/collections/docs/points/payload*' => Http::response(['result' => true], 200),
            'https://qdrant.test/collections/docs/points/payload/delete*' => Http::response(['result' => true], 200),
            'https://qdrant.test/collections/docs/points/payload/clear*' => Http::response(['result' => true], 200),
            'https://qdrant.test/collections/docs/index' => Http::response(['result' => true], 200),
            'https://qdrant.test/collections/docs/index/category' => Http::response(['result' => true], 200),
            'https://qdrant.test/cluster' => Http::response(['result' => ['status' => 'enabled']], 200),
            'https://qdrant.test/aliases' => Http::response(['result' => ['aliases' => []]], 200),
            'https://qdrant.test/collections/docs/aliases' => Http::response(['result' => ['aliases' => []]], 200),
            'https://qdrant.test/collections/aliases' => Http::response(['result' => true], 200),
            'https://qdrant.test/collections/docs/snapshots' => Http::sequence()
                ->push(['result' => []], 200)
                ->push(['result' => ['name' => 'snapshot']], 200),
        ]);

        $service = new QdrantService('key-test', 'https://qdrant.test');
        $service->deletePoints('docs', ['points' => [1]], ['wait' => true]);
        $service->setPayload('docs', ['points' => [1], 'payload' => ['reviewed' => true]]);
        $service->deletePayload('docs', ['points' => [1], 'keys' => ['reviewed']]);
        $service->clearPayload('docs', ['points' => [1]]);
        $service->createPayloadIndex('docs', ['field_name' => 'category', 'field_schema' => 'keyword']);
        $service->deletePayloadIndex('docs', 'category');
        $service->getClusterInfo();
        $service->listAliases();
        $service->listCollectionAliases('docs');
        $service->updateAliases(['actions' => []]);
        $service->listSnapshots('docs');
        $service->createSnapshot('docs');

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://qdrant.test/collections/docs/points/delete?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/points/payload' && $request->data()['payload']['reviewed'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/points/payload/delete');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/points/payload/clear');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://qdrant.test/collections/docs/index');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://qdrant.test/collections/docs/index/category');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/cluster');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/aliases');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/docs/aliases');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://qdrant.test/collections/aliases');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://qdrant.test/collections/docs/snapshots');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://qdrant.test/collections/docs/snapshots');
    }

    public function test_tools_and_provider_expose_current_qdrant_surface(): void
    {
        Http::fake([
            'https://qdrant.test/collections/docs/points/query' => Http::response(['result' => []], 200),
            'https://qdrant.test/collections/docs/points/payload' => Http::response(['result' => true], 200),
        ]);

        $service = new QdrantService('key-test', 'https://qdrant.test');
        $query = (new QdrantQueryPoints($service))->execute([
            'collection' => 'docs',
            'query' => [0.1, 0.2],
            'limit' => 3,
        ]);
        $payload = (new QdrantSetPayload($service))->execute([
            'collection' => 'docs',
            'points' => [1],
            'payload' => ['reviewed' => true],
        ]);

        self::assertNull($query->error);
        self::assertNull($payload->error);

        $provider = new QdrantToolProvider();
        $tools = $provider->tools();
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayNotHasKey('qdrant_get_current_user', $tools);
        self::assertArrayHasKey('qdrant_get_cluster_info', $tools);
        self::assertArrayHasKey('qdrant_query_points', $tools);
        self::assertSame(22, count($tools));
    }
}
