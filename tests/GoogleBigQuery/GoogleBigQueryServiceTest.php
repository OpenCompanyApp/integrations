<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleBigQuery;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleBigQuery\GoogleBigQueryService;
use OpenCompany\Integrations\GoogleBigQuery\GoogleBigQueryToolProvider;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryDatasetsList;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryJobsQuery;
use OpenCompany\Integrations\GoogleBigQuery\Tools\GoogleBigQueryTablesGetIamPolicy;
use PHPUnit\Framework\TestCase;

final class GoogleBigQueryServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleBigQueryToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-bigquery/google-bigquery-discovery-manifest.json'), true);

        self::assertSame(47, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google BigQuery', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-bigquery/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_bigquery_jobs_query', $manifestTools);
        self::assertContains('google_bigquery_tabledata_insert_all', $manifestTools);
        self::assertContains('google_bigquery_routines_get_iam_policy', $manifestTools);
    }

    public function test_service_maps_auth_path_query_body_and_reserved_resource_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleBigQueryService('token-test', 'https://example.test/bigquery/v2');
        $service->request('GET', '/projects/{+projectId}/datasets', ['projectId' => 'project-1'], ['projectId'], ['maxResults' => 5]);
        $service->request('POST', '/projects/{+projectId}/queries', ['projectId' => 'project-1'], ['projectId'], [], ['query' => 'select 1', 'useLegacySql' => false]);
        $service->request('POST', '/{+resource}:getIamPolicy', ['resource' => 'projects/project-1/datasets/ds/tables/t1'], ['resource'], [], ['options' => []]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/bigquery/v2/projects/project-1/datasets?maxResults=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/bigquery/v2/projects/project-1/queries'
            && $request['query'] === 'select 1'
            && $request['useLegacySql'] === false);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/bigquery/v2/projects/project-1/datasets/ds/tables/t1:getIamPolicy');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleBigQueryService('token-test');

        $list = new GoogleBigQueryDatasetsList($service);
        $result = $list->execute([
            'projectId' => 'project-1',
            'maxResults' => 10,
            'unknown' => 'ignored',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://bigquery.googleapis.com/bigquery/v2/projects/project-1/datasets?maxResults=10');

        $missingPath = (new GoogleBigQueryTablesGetIamPolicy($service))->execute(['body' => ['options' => []]]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('resource must be', (string) $missingPath->error);

        $missingBody = (new GoogleBigQueryJobsQuery($service))->execute(['projectId' => 'project-1']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}