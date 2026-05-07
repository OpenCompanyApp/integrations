<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SecEdgar;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\SecEdgar\SecEdgarService;
use OpenCompany\Integrations\SecEdgar\SecEdgarToolProvider;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarCompanyConcept;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarCompanyTickers;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarFrames;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarSubmissionFile;
use OpenCompany\Integrations\SecEdgar\Tools\SecEdgarSubmissions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for SEC EDGAR public submissions and XBRL data APIs.
 */
final class SecEdgarServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(SecEdgarService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(SecEdgarService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_sec_edgar_tools_and_docs(): void
    {
        $provider = new SecEdgarToolProvider;

        self::assertSame('sec-edgar', $provider->appName());
        self::assertSame('SEC EDGAR', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(8, $provider->tools());
        self::assertArrayHasKey('sec_edgar_submissions', $provider->tools());
        self::assertArrayHasKey('sec_edgar_company_concept', $provider->tools());
        self::assertArrayHasKey('sec_edgar_bulk_archives', $provider->tools());
    }

    public function test_submissions_normalizes_cik_and_sends_identifiable_user_agent(): void
    {
        Http::fake(['*' => Http::response([
            'cik' => '0000320193',
            'entityType' => 'operating',
            'filings' => ['recent' => ['accessionNumber' => ['0000320193-24-000123']]],
        ], 200)]);

        $service = new SecEdgarService(
            userAgent: 'ExampleApp/1.0 ops@example.test',
            dataBaseUrl: 'https://data.example.test',
            wwwBaseUrl: 'https://www.example.test',
        );
        $result = (new SecEdgarSubmissions($service))->execute(['cik' => '320193']);

        self::assertTrue($result->succeeded());
        self::assertSame('0000320193', $result->data['cik']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://data.example.test/submissions/CIK0000320193.json'
            && $request->hasHeader('User-Agent', 'ExampleApp/1.0 ops@example.test')
            && $request->hasHeader('Accept', 'application/json'));
    }

    public function test_submission_file_company_concept_and_frames_paths_are_mapped(): void
    {
        $service = new SecEdgarService(
            userAgent: 'ExampleApp/1.0 ops@example.test',
            dataBaseUrl: 'https://data.example.test',
            wwwBaseUrl: 'https://www.example.test',
        );

        Http::fake(['*' => Http::response(['items' => [['accessionNumber' => '0000320193-24-000001']]], 200)]);
        $file = (new SecEdgarSubmissionFile($service))->execute(['file' => 'CIK0000320193-submissions-001.json']);
        self::assertTrue($file->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/submissions/CIK0000320193-submissions-001.json');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['taxonomy' => 'us-gaap', 'tag' => 'Assets'], 200)]);
        $concept = (new SecEdgarCompanyConcept($service))->execute([
            'cik' => 320193,
            'taxonomy' => 'us-gaap',
            'tag' => 'Assets',
        ]);
        self::assertTrue($concept->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/api/xbrl/companyconcept/CIK0000320193/us-gaap/Assets.json');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['cik' => 320193, 'val' => 1000]]], 200)]);
        $frame = (new SecEdgarFrames($service))->execute([
            'taxonomy' => 'us-gaap',
            'tag' => 'Assets',
            'unit' => 'USD',
            'period' => 'CY2024Q1I',
        ]);
        self::assertTrue($frame->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/api/xbrl/frames/us-gaap/Assets/USD/CY2024Q1I.json');
    }

    public function test_ticker_mappings_use_www_sec_host(): void
    {
        Http::fake(['*' => Http::response([
            '0' => ['cik_str' => 320193, 'ticker' => 'AAPL', 'title' => 'Apple Inc.'],
        ], 200)]);

        $service = new SecEdgarService(
            userAgent: 'ExampleApp/1.0 ops@example.test',
            dataBaseUrl: 'https://data.example.test',
            wwwBaseUrl: 'https://www.example.test',
        );
        $result = (new SecEdgarCompanyTickers($service))->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('AAPL', $result->data[0]['ticker']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://www.example.test/files/company_tickers.json');
    }

    public function test_bulk_archive_urls_are_returned_without_http_requests(): void
    {
        Http::fake(['*' => Http::response([], 500)]);

        $service = new SecEdgarService(
            userAgent: 'ExampleApp/1.0 ops@example.test',
            dataBaseUrl: 'https://data.example.test',
            wwwBaseUrl: 'https://www.example.test',
        );
        $archives = $service->bulkArchives();

        self::assertSame('https://www.example.test/Archives/edgar/daily-index/bulkdata/submissions.zip', $archives['submissions_zip']);
        self::assertSame('https://www.example.test/Archives/edgar/daily-index/xbrl/companyfacts.zip', $archives['companyfacts_zip']);
        Http::assertNothingSent();
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new SecEdgarService(
            userAgent: 'ExampleApp/1.0 ops@example.test',
            dataBaseUrl: 'https://data.example.test',
            wwwBaseUrl: 'https://www.example.test',
        );

        $missing = (new SecEdgarSubmissions($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('cik is required', (string) $missing->error);

        $badFile = (new SecEdgarSubmissionFile($service))->execute(['file' => '../bad.json']);
        self::assertFalse($badFile->succeeded());
        self::assertStringContainsString('file must look like', (string) $badFile->error);

        $badCik = (new SecEdgarSubmissions($service))->execute(['cik' => '12345678901']);
        self::assertFalse($badCik->succeeded());
        self::assertStringContainsString('cik must contain 1 to 10 digits', (string) $badCik->error);

        Http::fake(['*' => Http::response(['message' => 'Not found'], 404)]);
        $notFound = (new SecEdgarSubmissions($service))->execute(['cik' => '1']);
        self::assertFalse($notFound->succeeded());
        self::assertStringContainsString('SEC EDGAR API error (404): Not found', (string) $notFound->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['cik' => '0000320193'], 200)]);

        $service = new SecEdgarService(
            userAgent: 'ExampleApp/1.0 ops@example.test',
            dataBaseUrl: 'https://data.example.test',
            wwwBaseUrl: 'https://www.example.test',
        );
        app()->instance(SecEdgarService::class, $service);
        $tool = (new SecEdgarToolProvider)->createTool(SecEdgarSubmissions::class);
        $result = $tool->execute(['cik' => 320193]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/submissions/CIK0000320193.json');
    }
}
