<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Orcid;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Orcid\OrcidService;
use OpenCompany\Integrations\Orcid\OrcidToolProvider;
use OpenCompany\Integrations\Orcid\Tools\OrcidCsvSearch;
use OpenCompany\Integrations\Orcid\Tools\OrcidRecord;
use OpenCompany\Integrations\Orcid\Tools\OrcidSearch;
use OpenCompany\Integrations\Orcid\Tools\OrcidWork;
use OpenCompany\Integrations\Orcid\Tools\OrcidWorks;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the ORCID Public API v3.0 integration.
 */
final class OrcidServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OrcidService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OrcidService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_tools_and_docs(): void
    {
        $provider = new OrcidToolProvider;

        self::assertSame('orcid', $provider->appName());
        self::assertSame('ORCID', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(32, $provider->tools());
        self::assertArrayHasKey('orcid_search', $provider->tools());
        self::assertArrayHasKey('orcid_record', $provider->tools());
        self::assertArrayHasKey('orcid_peer_review', $provider->tools());
    }

    public function test_search_maps_solr_query_and_optional_bearer_token(): void
    {
        Http::fake(['*' => Http::response([
            'result' => [['orcid-identifier' => ['path' => '0000-0002-1825-0097']]],
            'num-found' => 1,
        ], 200, ['Content-Type' => 'application/vnd.orcid+json'])]);

        $service = new OrcidService('https://example.test/v3.0');
        $result = (new OrcidSearch($service))->execute([
            'q' => 'family-name:Carberry',
            'rows' => 1,
            'start' => 0,
            'access_token' => 'token-test',
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame(1, $result->data['num-found']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/v3.0/search?')
            && str_contains($request->url(), 'q=family-name%3ACarberry')
            && str_contains($request->url(), 'rows=1')
            && str_contains($request->url(), 'start=0')
            && $request->hasHeader('Authorization', 'Bearer token-test')
            && $request->hasHeader('Accept', 'application/vnd.orcid+json, application/json'));
    }

    public function test_record_summary_and_detail_paths_are_mapped(): void
    {
        Http::fake(['*' => Http::response([
            'orcid-identifier' => ['path' => '0000-0002-1825-0097'],
            'person' => ['name' => ['credit-name' => ['value' => 'Josiah Carberry']]],
        ], 200)]);

        $service = new OrcidService('https://example.test/v3.0');
        $record = (new OrcidRecord($service))->execute(['orcid' => '0000-0002-1825-0097']);

        self::assertTrue($record->succeeded());
        self::assertSame('0000-0002-1825-0097', $record->data['orcid-identifier']['path']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/v3.0/0000-0002-1825-0097/record');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['group' => [['work-summary' => [['put-code' => 9543020]]]]], 200)]);
        $works = (new OrcidWorks($service))->execute(['orcid' => '0000-0002-1825-0097']);
        self::assertTrue($works->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/v3.0/0000-0002-1825-0097/works');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['title' => ['title' => ['value' => 'Example Work']]], 200)]);
        $work = (new OrcidWork($service))->execute([
            'orcid' => '0000-0002-1825-0097',
            'put_code' => 9543020,
        ]);
        self::assertTrue($work->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/v3.0/0000-0002-1825-0097/work/9543020');
    }

    public function test_csv_search_returns_body_and_field_parameters(): void
    {
        Http::fake(['*' => Http::response("orcid,given-name\n0000-0002-1825-0097,Josiah\n", 200, ['Content-Type' => 'text/csv'])]);

        $service = new OrcidService('https://example.test/v3.0');
        $csv = (new OrcidCsvSearch($service))->execute([
            'q' => 'family-name:Carberry',
            'fields' => ['orcid', 'given-name'],
        ]);

        self::assertTrue($csv->succeeded());
        self::assertStringContainsString('orcid,given-name', $csv->data['body']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/v3.0/csv-search?')
            && str_contains($request->url(), 'fields=orcid%2Cgiven-name')
            && $request->hasHeader('Accept', 'text/csv'));
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new OrcidService('https://example.test/v3.0');

        $missing = (new OrcidRecord($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('orcid is required', (string) $missing->error);

        Http::fake(['*' => Http::response([
            'user-message' => 'The ORCID iD is invalid.',
        ], 400)]);
        $bad = (new OrcidRecord($service))->execute(['orcid' => 'bad-id']);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('The ORCID iD is invalid', (string) $bad->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['result' => []], 200)]);

        $service = new OrcidService('https://example.test/v3.0');
        app()->instance(OrcidService::class, $service);
        $tool = (new OrcidToolProvider)->createTool(OrcidSearch::class);
        $result = $tool->execute(['q' => 'orcid']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/v3.0/search?'));
    }
}
