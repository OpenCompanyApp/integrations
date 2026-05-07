<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\DataCite;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\DataCite\DataCiteService;
use OpenCompany\Integrations\DataCite\DataCiteToolProvider;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetClient;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetDoi;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetEvent;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGetProvider;
use OpenCompany\Integrations\DataCite\Tools\DataCiteGraphqlQuery;
use OpenCompany\Integrations\DataCite\Tools\DataCiteListDois;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public DataCite REST and GraphQL APIs.
 */
final class DataCiteServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(DataCiteService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(DataCiteService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_api_surface_and_docs(): void
    {
        $provider = new DataCiteToolProvider;

        self::assertSame('datacite', $provider->appName());
        self::assertSame('DataCite', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());

        self::assertSame([
            'datacite_list_activities',
            'datacite_get_activity',
            'datacite_list_client_prefixes',
            'datacite_list_clients',
            'datacite_client_stats',
            'datacite_get_client',
            'datacite_list_dois',
            'datacite_get_doi',
            'datacite_get_doi_activities',
            'datacite_list_events',
            'datacite_get_event',
            'datacite_heartbeat',
            'datacite_list_prefixes',
            'datacite_prefix_stats',
            'datacite_get_prefix',
            'datacite_list_provider_prefixes',
            'datacite_list_providers',
            'datacite_provider_stats',
            'datacite_get_provider',
            'datacite_list_reports',
            'datacite_get_report',
            'datacite_graphql_query',
        ], array_keys($provider->tools()));
    }

    public function test_service_maps_rest_endpoints_query_arrays_and_graphql(): void
    {
        Http::fake(['*' => Http::response(['data' => [], 'meta' => ['total' => 0]], 200)]);

        $service = new DataCiteService('https://example.test', 'https://example.test/graphql');
        $service->get('activities');
        $service->get('activities/activity-1');
        $service->get('client-prefixes');
        $service->get('clients');
        $service->get('clients/stats');
        $service->get('clients/datacite.datacite');
        $service->get('dois', ['query' => 'climate', 'resource-type-id' => ['Dataset', 'Software'], 'page[size]' => 10, 'detail' => true]);
        $service->get('dois/'.rawurlencode('10.5438/0012'));
        $service->get('dois/'.rawurlencode('10.5438/0012').'/activities');
        $service->get('events', ['doi' => '10.5438/0012', 'relation-type-id' => 'references']);
        $service->get('events/event-1');
        $service->get('heartbeat');
        $service->get('prefixes');
        $service->get('prefixes/stats');
        $service->get('prefixes/10.5438');
        $service->get('provider-prefixes');
        $service->get('providers');
        $service->get('providers/stats');
        $service->get('providers/datacite');
        $service->get('reports');
        $service->get('reports/report-1');
        $service->graphql('query { publications { totalCount } }', ['first' => 1]);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/activities');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/activities/activity-1');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/client-prefixes');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/clients');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/clients/stats');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/clients/datacite.datacite');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/dois?')
            && str_contains($request->url(), 'query=climate')
            && str_contains($request->url(), 'resource-type-id=Dataset%2CSoftware')
            && str_contains($request->url(), 'page%5Bsize%5D=10')
            && str_contains($request->url(), 'detail=true'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/dois/10.5438%2F0012');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/dois/10.5438%2F0012/activities');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/events?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/events/event-1');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/heartbeat');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/prefixes');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/prefixes/stats');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/prefixes/10.5438');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/provider-prefixes');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/providers');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/providers/stats');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/providers/datacite');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/reports');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/reports/report-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/graphql'
            && $request['query'] === 'query { publications { totalCount } }'
            && $request['variables'] === ['first' => 1]);
    }

    public function test_tools_validate_arguments_merge_extra_and_convert_errors(): void
    {
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        $service = new DataCiteService('https://example.test', 'https://example.test/graphql');

        $list = (new DataCiteListDois($service))->execute([
            'query' => 'climate',
            'extra' => ['page[size]' => 5, 'sort' => '-created'],
            'page[size]' => 2,
        ]);
        self::assertTrue($list->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'query=climate')
            && str_contains($request->url(), 'page%5Bsize%5D=2')
            && str_contains($request->url(), 'sort=-created'));

        self::assertTrue((new DataCiteGetDoi($service))->execute(['id' => '10.5438/0012'])->succeeded());
        self::assertTrue((new DataCiteGetClient($service))->execute(['id' => 'datacite.datacite'])->succeeded());
        self::assertTrue((new DataCiteGetProvider($service))->execute(['id' => 'datacite'])->succeeded());
        self::assertTrue((new DataCiteGetEvent($service))->execute(['id' => 'event-1'])->succeeded());
        self::assertTrue((new DataCiteGraphqlQuery($service))->execute(['query' => 'query { publications { totalCount } }'])->succeeded());

        $missing = (new DataCiteGetDoi($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('id is required', (string) $missing->error);

        $missingGraphql = (new DataCiteGraphqlQuery($service))->execute([]);
        self::assertFalse($missingGraphql->succeeded());
        self::assertStringContainsString('query is required', (string) $missingGraphql->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['errors' => [['title' => 'Not found']]], 404)]);
        $bad = (new DataCiteGetDoi($service))->execute(['id' => '10.0000/missing']);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('Not found', (string) $bad->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['data' => []], 200)]);

        $service = new DataCiteService('https://example.test', 'https://example.test/graphql');
        app()->instance(DataCiteService::class, $service);

        $tool = (new DataCiteToolProvider)->createTool(DataCiteListDois::class);
        $result = $tool->execute(['page[size]' => 1]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/dois?'));
    }
}
