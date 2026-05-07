<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleCloudSearch;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleCloudSearch\GoogleCloudSearchService;
use OpenCompany\Integrations\GoogleCloudSearch\GoogleCloudSearchToolProvider;
use OpenCompany\Integrations\GoogleCloudSearch\Tools\GoogleCloudSearchIndexingDatasourcesItemsGet;
use OpenCompany\Integrations\GoogleCloudSearch\Tools\GoogleCloudSearchQuerySearch;
use OpenCompany\Integrations\GoogleCloudSearch\Tools\GoogleCloudSearchQuerySourcesList;
use PHPUnit\Framework\TestCase;

final class GoogleCloudSearchServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleCloudSearchToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-cloud-search/google-cloud-search-discovery-manifest.json'), true);

        self::assertSame(49, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Cloud Search', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], chr(92)) + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-cloud-search/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_cloud_search_query_search', $manifestTools);
        self::assertContains('google_cloud_search_indexing_datasources_items_index', $manifestTools);
        self::assertContains('google_cloud_search_settings_searchapplications_create', $manifestTools);
        self::assertContains('google_cloud_search_stats_session_searchapplications_get', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleCloudSearchService('token-test', 'https://example.test');
        $service->request('GET', '/v1/indexing/{+name}', ['name' => 'datasources/source/items/item-1']);
        $service->request('POST', '/v1/query/search', [], [], [], ['query' => 'quarterly report']);
        $service->request('PATCH', '/v1/settings/{+name}', ['name' => 'searchapplications/app-1'], ['name'], ['updateMask' => 'displayName'], ['displayName' => 'Search App']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/indexing/datasources/source/items/item-1'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/query/search'
            && $request['query'] === 'quarterly report');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://example.test/v1/settings/searchapplications/app-1?updateMask=displayName'
            && $request['displayName'] === 'Search App');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleCloudSearchService('token-test');

        $sources = new GoogleCloudSearchQuerySourcesList($service);
        $result = $sources->execute(['pageToken' => 'token-1', 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cloudsearch.googleapis.com/v1/query/sources?pageToken=token-1');

        $missingPath = (new GoogleCloudSearchIndexingDatasourcesItemsGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('name must be', (string) $missingPath->error);

        $missingBody = (new GoogleCloudSearchQuerySearch($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}