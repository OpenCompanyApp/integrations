<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\FirstEpss;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\FirstEpss\FirstEpssService;
use OpenCompany\Integrations\FirstEpss\FirstEpssToolProvider;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssBatch;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssCve;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssHistoricalCsvUrl;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssQuery;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssThreshold;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssTimeSeries;
use OpenCompany\Integrations\FirstEpss\Tools\FirstEpssTop;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the FIRST EPSS integration.
 */
final class FirstEpssServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(FirstEpssService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(FirstEpssService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new FirstEpssToolProvider;

        self::assertSame('first-epss', $provider->appName());
        self::assertSame('FIRST EPSS', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'first_epss_query',
            'first_epss_cve',
            'first_epss_batch',
            'first_epss_time_series',
            'first_epss_top',
            'first_epss_threshold',
            'first_epss_historical_csv_url',
        ], array_keys($provider->tools()));
    }

    public function test_query_cve_batch_and_time_series_map_official_parameters(): void
    {
        $service = new FirstEpssService(baseUrl: 'https://first.example.test/data/v1');

        Http::fake(['*' => Http::response($this->epssResponse([['cve' => 'CVE-2022-27225']]), 200)]);
        self::assertTrue((new FirstEpssQuery($service))->execute(['cves' => ['cve-2022-27225'], 'epss_gt' => 0.5, 'limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://first.example.test/data/v1/epss?')
            && str_contains($request->url(), 'cve=CVE-2022-27225')
            && str_contains($request->url(), 'epss-gt=0.5')
            && str_contains($request->url(), 'limit=1'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->epssResponse([['cve' => 'CVE-2022-27225']]), 200)]);
        self::assertTrue((new FirstEpssCve($service))->execute(['cve' => 'cve-2022-27225', 'date' => '2022-03-05'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'cve=CVE-2022-27225')
            && str_contains($request->url(), 'date=2022-03-05'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->epssResponse([['cve' => 'CVE-2022-27225'], ['cve' => 'CVE-2022-27223']]), 200)]);
        self::assertTrue((new FirstEpssBatch($service))->execute(['cves' => ['CVE-2022-27225', 'CVE-2022-27223']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'cve=CVE-2022-27225%2CCVE-2022-27223'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->epssResponse([['cve' => 'CVE-2022-25204']]), 200)]);
        self::assertTrue((new FirstEpssTimeSeries($service))->execute(['cve' => 'CVE-2022-25204'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'scope=time-series'));
    }

    public function test_top_threshold_and_historical_csv_url(): void
    {
        $service = new FirstEpssService(baseUrl: 'https://first.example.test/data/v1', csvBaseUrl: 'https://csv.example.test');

        Http::fake(['*' => Http::response($this->epssResponse([['cve' => 'CVE-2023-23752']]), 200)]);
        self::assertTrue((new FirstEpssTop($service))->execute(['limit' => 2, 'by' => 'percentile'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'order=%21percentile')
            && str_contains($request->url(), 'limit=2'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->epssResponse([['cve' => 'CVE-2023-23752']]), 200)]);
        self::assertTrue((new FirstEpssThreshold($service))->execute(['epss_gt' => 0.95, 'percentile_gt' => 0.99, 'limit' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'epss-gt=0.95')
            && str_contains($request->url(), 'percentile-gt=0.99')
            && str_contains($request->url(), 'order=%21epss'));

        $csv = (new FirstEpssHistoricalCsvUrl($service))->execute(['date' => '2022-03-05']);
        self::assertTrue($csv->succeeded());
        self::assertSame('https://csv.example.test/epss_scores-2022-03-05.csv.gz', $csv->data['url']);
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new FirstEpssService(baseUrl: 'https://first.example.test/data/v1');

        $missingBatch = (new FirstEpssBatch($service))->execute(['cves' => []]);
        self::assertFalse($missingBatch->succeeded());
        self::assertStringContainsString('cves is required', (string) $missingBatch->error);

        $missingThreshold = (new FirstEpssThreshold($service))->execute([]);
        self::assertFalse($missingThreshold->succeeded());
        self::assertStringContainsString('epss_gt or percentile_gt is required', (string) $missingThreshold->error);

        $badCsvDate = (new FirstEpssHistoricalCsvUrl($service))->execute(['date' => 'bad']);
        self::assertFalse($badCsvDate->succeeded());
        self::assertStringContainsString('YYYY-MM-DD', (string) $badCsvDate->error);

        Http::fake(['*' => Http::response(['message' => 'too many requests'], 429)]);
        $apiError = (new FirstEpssCve($service))->execute(['cve' => 'CVE-2022-27225']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('too many requests', (string) $apiError->error);
    }

    public function test_provider_creates_tools_with_default_service(): void
    {
        Http::fake(['*' => Http::response($this->epssResponse([['cve' => 'CVE-2022-27225']]), 200)]);

        app()->instance(FirstEpssService::class, new FirstEpssService(baseUrl: 'https://first.example.test/data/v1'));
        $tool = (new FirstEpssToolProvider)->createTool(FirstEpssCve::class);
        $result = $tool->execute(['cve' => 'CVE-2022-27225']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://first.example.test/data/v1/epss?'));
    }

    /**
     * Return a fake FIRST EPSS response.
     *
     * @param  list<array<string, string>>  $rows  Partial row overrides.
     * @return array<string, mixed>
     */
    private function epssResponse(array $rows): array
    {
        return [
            'status' => 'OK',
            'status-code' => 200,
            'version' => '1.0',
            'access' => 'public',
            'total' => count($rows),
            'offset' => 0,
            'limit' => 100,
            'data' => array_map(static fn (array $row): array => $row + [
                'epss' => '0.945200000',
                'percentile' => '1.000000000',
                'date' => '2026-05-06',
            ], $rows),
        ];
    }
}
