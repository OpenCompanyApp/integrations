<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Google;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Google\GoogleAnalyticsToolProvider;
use OpenCompany\Integrations\Google\GoogleClient;
use OpenCompany\Integrations\Google\Services\GoogleAnalyticsService;
use OpenCompany\Integrations\Google\Tools\GoogleAnalyticsBatchRunPivotReports;
use OpenCompany\Integrations\Google\Tools\GoogleAnalyticsBatchRunReports;
use OpenCompany\Integrations\Google\Tools\GoogleAnalyticsCheckCompatibility;
use OpenCompany\Integrations\Google\Tools\GoogleAnalyticsPivotReport;
use OpenCompany\Integrations\Google\Tools\GoogleAnalyticsReport;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Google Analytics GA4 Data API endpoint mappings.
 */
final class GoogleAnalyticsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_admin_and_data_api_methods_to_documented_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = $this->service();
        $service->listAccountSummaries();
        $service->getMetadata('1234');
        $service->runReport('1234', ['metrics' => [['name' => 'sessions']]]);
        $service->runRealtimeReport('1234', ['metrics' => [['name' => 'activeUsers']]]);
        $service->checkCompatibility('1234', ['metrics' => [['name' => 'sessions']]]);
        $service->runPivotReport('1234', ['metrics' => [['name' => 'sessions']]]);
        $service->batchRunReports('1234', ['requests' => [['metrics' => [['name' => 'sessions']]]]]);
        $service->batchRunPivotReports('1234', ['requests' => [['metrics' => [['name' => 'sessions']]]]]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://admin.analytics.test/v1beta/accountSummaries?pageSize=200');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://data.analytics.test/v1beta/properties/1234/metadata');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://data.analytics.test/v1beta/properties/1234:runReport');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://data.analytics.test/v1beta/properties/1234:runRealtimeReport');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://data.analytics.test/v1beta/properties/1234:checkCompatibility');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://data.analytics.test/v1beta/properties/1234:runPivotReport');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://data.analytics.test/v1beta/properties/1234:batchRunReports');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://data.analytics.test/v1beta/properties/1234:batchRunPivotReports');
    }

    public function test_body_builders_map_filters_ordering_pivots_and_compatibility(): void
    {
        $service = $this->service();

        $report = $service->buildReportBody([
            'dimensions' => ['country'],
            'metrics' => ['sessions'],
            'filters' => [['dimension' => 'country', 'operator' => 'in_list', 'value' => ['US', 'BE']]],
            'metricFilters' => [['metric' => 'sessions', 'operator' => 'greater_than', 'value' => 10]],
            'orderBy' => 'sessions',
            'orderDirection' => 'desc',
        ]);

        self::assertSame('country', $report['dimensions'][0]['name']);
        self::assertSame('sessions', $report['metrics'][0]['name']);
        self::assertSame(['US', 'BE'], $report['dimensionFilter']['filter']['inListFilter']['values']);
        self::assertSame('GREATER_THAN', $report['metricFilter']['filter']['numericFilter']['operation']);
        self::assertSame('sessions', $report['orderBys'][0]['metric']['metricName']);

        $pivot = $service->buildPivotReportBody([
            'dimensions' => ['country', 'deviceCategory'],
            'metrics' => ['sessions'],
            'limit' => 25,
        ]);

        self::assertSame(['country', 'deviceCategory'], $pivot['pivots'][0]['fieldNames']);
        self::assertSame(25, $pivot['pivots'][0]['limit']);
        self::assertArrayNotHasKey('limit', $pivot);

        $compatibility = $service->buildCompatibilityBody([
            'dimensions' => ['country'],
            'metrics' => ['sessions'],
            'compatibilityFilter' => 'COMPATIBLE',
        ]);

        self::assertSame('COMPATIBLE', $compatibility['compatibilityFilter']);
    }

    public function test_tools_and_provider_expose_expanded_ga4_data_surface(): void
    {
        Http::fake([
            'https://data.analytics.test/v1beta/properties/1234:runReport' => Http::response([
                'dimensionHeaders' => [['name' => 'country']],
                'metricHeaders' => [['name' => 'sessions']],
                'rows' => [[
                    'dimensionValues' => [['value' => 'BE']],
                    'metricValues' => [['value' => '42']],
                ]],
                'totals' => [[
                    'metricValues' => [['value' => '42']],
                ]],
            ], 200),
            'https://data.analytics.test/v1beta/properties/1234:checkCompatibility' => Http::response(['dimensionCompatibilities' => []], 200),
            'https://data.analytics.test/v1beta/properties/1234:runPivotReport' => Http::response(['pivotHeaders' => []], 200),
            'https://data.analytics.test/v1beta/properties/1234:batchRunReports' => Http::response(['reports' => []], 200),
            'https://data.analytics.test/v1beta/properties/1234:batchRunPivotReports' => Http::response(['pivotReports' => []], 200),
        ]);

        $service = $this->service();
        self::assertNull((new GoogleAnalyticsReport($service))->execute([
            'property_id' => '1234',
            'metrics' => ['sessions'],
            'dimensions' => ['country'],
        ])->error);
        self::assertNull((new GoogleAnalyticsCheckCompatibility($service))->execute([
            'property_id' => '1234',
            'metrics' => ['sessions'],
            'dimensions' => ['country'],
        ])->error);
        self::assertNull((new GoogleAnalyticsPivotReport($service))->execute([
            'property_id' => '1234',
            'metrics' => ['sessions'],
            'dimensions' => ['country'],
        ])->error);
        self::assertNull((new GoogleAnalyticsBatchRunReports($service))->execute([
            'property_id' => '1234',
            'requests' => [['metrics' => [['name' => 'sessions']]]],
        ])->error);
        self::assertNull((new GoogleAnalyticsBatchRunPivotReports($service))->execute([
            'property_id' => '1234',
            'requests' => [['metrics' => [['name' => 'sessions']]]],
        ])->error);

        $provider = new GoogleAnalyticsToolProvider();
        $tools = $provider->tools();

        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('google_analytics_check_compatibility', $tools);
        self::assertArrayHasKey('google_analytics_pivot_report', $tools);
        self::assertArrayHasKey('google_analytics_batch_run_reports', $tools);
        self::assertArrayHasKey('google_analytics_batch_run_pivot_reports', $tools);
        self::assertSame(8, count($tools));
    }

    private function service(): GoogleAnalyticsService
    {
        return new GoogleAnalyticsService(
            new GoogleClient(accessToken: 'token-test', expiresAt: time() + 3600, integrationId: 'google_analytics'),
            'https://data.analytics.test/v1beta',
            'https://admin.analytics.test/v1beta',
        );
    }
}
