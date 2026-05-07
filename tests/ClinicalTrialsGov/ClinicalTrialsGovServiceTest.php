<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ClinicalTrialsGov;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ClinicalTrialsGov\ClinicalTrialsGovService;
use OpenCompany\Integrations\ClinicalTrialsGov\ClinicalTrialsGovToolProvider;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovFetchStudy;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovFieldSizesStats;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovFieldValuesStats;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovListStudies;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovMetadata;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovSearchAreas;
use OpenCompany\Integrations\ClinicalTrialsGov\Tools\ClinicalTrialsGovVersion;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public ClinicalTrials.gov API v2 integration.
 */
final class ClinicalTrialsGovServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ClinicalTrialsGovService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ClinicalTrialsGovService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_all_public_v2_tools_and_docs(): void
    {
        $provider = new ClinicalTrialsGovToolProvider;

        self::assertSame('clinicaltrials-gov', $provider->appName());
        self::assertSame('ClinicalTrials.gov', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame([
            'clinicaltrials_gov_list_studies',
            'clinicaltrials_gov_fetch_study',
            'clinicaltrials_gov_metadata',
            'clinicaltrials_gov_search_areas',
            'clinicaltrials_gov_enums',
            'clinicaltrials_gov_size_stats',
            'clinicaltrials_gov_field_values_stats',
            'clinicaltrials_gov_field_sizes_stats',
            'clinicaltrials_gov_version',
        ], array_keys($provider->tools()));
    }

    public function test_list_studies_maps_search_filters_fields_sort_and_paging(): void
    {
        Http::fake(['*' => Http::response([
            'totalCount' => 1,
            'studies' => [[
                'protocolSection' => [
                    'identificationModule' => ['nctId' => 'NCT00841061'],
                    'statusModule' => ['overallStatus' => 'RECRUITING'],
                ],
                'hasResults' => false,
            ]],
            'nextPageToken' => 'next-token',
        ], 200, ['Content-Type' => 'application/json'])]);

        $service = new ClinicalTrialsGovService('https://example.test/api/v2');
        $result = (new ClinicalTrialsGovListStudies($service))->execute([
            'query.cond' => 'lung cancer',
            'filter.overallStatus' => ['RECRUITING', 'NOT_YET_RECRUITING'],
            'fields' => ['NCTId', 'BriefTitle', 'OverallStatus'],
            'sort' => ['@relevance', 'EnrollmentCount:desc'],
            'countTotal' => true,
            'pageSize' => 25,
            'extra' => ['pageSize' => 99, 'query.term' => 'AREA[LastUpdatePostDate]RANGE[2025-01-01,MAX]'],
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame('next-token', $result->data['nextPageToken']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/api/v2/studies?')
            && str_contains($request->url(), 'format=json')
            && str_contains($request->url(), 'markupFormat=markdown')
            && str_contains($request->url(), 'query.cond=lung%20cancer')
            && str_contains($request->url(), 'query.term=AREA%5BLastUpdatePostDate%5DRANGE%5B2025-01-01%2CMAX%5D')
            && str_contains($request->url(), 'filter.overallStatus=RECRUITING%7CNOT_YET_RECRUITING')
            && str_contains($request->url(), 'fields=NCTId%7CBriefTitle%7COverallStatus')
            && str_contains($request->url(), 'sort=%40relevance%7CEnrollmentCount%3Adesc')
            && str_contains($request->url(), 'countTotal=true')
            && str_contains($request->url(), 'pageSize=25'));
    }

    public function test_fetch_study_supports_json_and_non_json_responses(): void
    {
        Http::fake(['*' => Http::response([
            'protocolSection' => [
                'identificationModule' => ['nctId' => 'NCT00841061'],
            ],
            'hasResults' => true,
        ], 200, ['Content-Type' => 'application/json'])]);

        $service = new ClinicalTrialsGovService('https://example.test/api/v2');
        $study = (new ClinicalTrialsGovFetchStudy($service))->execute([
            'nctId' => 'NCT00841061',
            'fields' => ['ProtocolSection', 'ResultsSection'],
        ]);

        self::assertTrue($study->succeeded());
        self::assertSame('NCT00841061', $study->data['protocolSection']['identificationModule']['nctId']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/api/v2/studies/NCT00841061?')
            && str_contains($request->url(), 'format=json')
            && str_contains($request->url(), 'fields=ProtocolSection%7CResultsSection'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response("NCTId,BriefTitle\nNCT00841061,Example\n", 200, [
            'Content-Type' => 'text/csv',
            'x-total-count' => '1',
            'x-next-page-token' => 'csv-next',
        ])]);

        $csv = (new ClinicalTrialsGovFetchStudy($service))->execute([
            'nctId' => 'NCT00841061',
            'format' => 'csv',
            'fields' => ['NCTId', 'BriefTitle'],
        ]);

        self::assertTrue($csv->succeeded());
        self::assertStringContainsString('NCTId,BriefTitle', $csv->data['body']);
        self::assertSame('csv-next', $csv->data['headers']['x-next-page-token']);
    }

    public function test_metadata_stats_and_version_endpoints_are_mapped(): void
    {
        Http::fake([
            'https://example.test/api/v2/studies/metadata*' => Http::response([['name' => 'NCTId']], 200),
            'https://example.test/api/v2/studies/search-areas*' => Http::response([['name' => 'BasicSearch']], 200),
            'https://example.test/api/v2/stats/field/values*' => Http::response([['field' => 'Phase']], 200),
            'https://example.test/api/v2/stats/field/sizes*' => Http::response([['field' => 'Condition']], 200),
            'https://example.test/api/v2/version*' => Http::response(['apiVersion' => '2.0.5', 'dataTimestamp' => '2026-05-06T14:00:00'], 200),
        ]);

        $service = new ClinicalTrialsGovService('https://example.test/api/v2');

        self::assertTrue((new ClinicalTrialsGovMetadata($service))->execute(['includeIndexedOnly' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'studies/metadata?includeIndexedOnly=true'));

        self::assertTrue((new ClinicalTrialsGovSearchAreas($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/api/v2/studies/search-areas');

        self::assertTrue((new ClinicalTrialsGovFieldValuesStats($service))->execute([
            'types' => ['ENUM', 'BOOLEAN'],
            'fields' => ['Phase', 'OverallStatus'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/api/v2/stats/field/values?')
            && str_contains($request->url(), 'types=ENUM%7CBOOLEAN')
            && str_contains($request->url(), 'fields=Phase%7COverallStatus'));

        self::assertTrue((new ClinicalTrialsGovFieldSizesStats($service))->execute(['fields' => ['Phase']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'stats/field/sizes?fields=Phase'));

        $version = (new ClinicalTrialsGovVersion($service))->execute([]);
        self::assertTrue($version->succeeded());
        self::assertSame('2026-05-06T14:00:00', $version->data['dataTimestamp']);
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new ClinicalTrialsGovService('https://example.test/api/v2');

        $missing = (new ClinicalTrialsGovFetchStudy($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('nctId is required', (string) $missing->error);

        Http::fake(['*' => Http::response('bad query', 400, ['Content-Type' => 'text/plain'])]);
        $bad = (new ClinicalTrialsGovListStudies($service))->execute(['query.term' => 'bad']);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('bad query', (string) $bad->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['studies' => []], 200)]);

        $service = new ClinicalTrialsGovService('https://example.test/api/v2');
        app()->instance(ClinicalTrialsGovService::class, $service);
        $tool = (new ClinicalTrialsGovToolProvider)->createTool(ClinicalTrialsGovListStudies::class);
        $result = $tool->execute(['query.term' => 'asthma']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/api/v2/studies?'));
    }
}
