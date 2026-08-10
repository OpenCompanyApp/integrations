<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Osv;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Osv\OsvService;
use OpenCompany\Integrations\Osv\OsvToolProvider;
use OpenCompany\Integrations\Osv\Tools\OsvDetermineVersion;
use OpenCompany\Integrations\Osv\Tools\OsvGetVulnerability;
use OpenCompany\Integrations\Osv\Tools\OsvImportFindings;
use OpenCompany\Integrations\Osv\Tools\OsvQuery;
use OpenCompany\Integrations\Osv\Tools\OsvQueryBatch;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the OSV.dev API integration.
 */
final class OsvServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OsvService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OsvService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_docs(): void
    {
        $provider = new OsvToolProvider;

        self::assertSame('osv', $provider->appName());
        self::assertSame('OSV', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'osv_query',
            'osv_query_batch',
            'osv_get_vulnerability',
            'osv_import_findings',
            'osv_determine_version',
        ], array_keys($provider->tools()));
    }

    public function test_query_maps_package_and_purl_payloads(): void
    {
        $service = new OsvService(baseUrl: 'https://osv.example.test');

        Http::fake(['*' => Http::response(['vulns' => [['id' => 'GHSA-test']]], 200)]);
        $result = (new OsvQuery($service))->execute([
            'package_name' => 'jinja2',
            'ecosystem' => 'PyPI',
            'version' => '3.1.4',
            'page_token' => 'token-1',
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame('GHSA-test', $result->data['vulns'][0]['id']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://osv.example.test/v1/query'
            && $request->data() === [
                'version' => '3.1.4',
                'page_token' => 'token-1',
                'package' => ['name' => 'jinja2', 'ecosystem' => 'PyPI'],
            ]);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['vulns' => []], 200)]);
        $purl = (new OsvQuery($service))->execute(['purl' => 'pkg:pypi/jinja2@3.1.4']);
        self::assertTrue($purl->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->data() === ['package' => ['purl' => 'pkg:pypi/jinja2@3.1.4']]);
    }

    public function test_query_batch_get_import_findings_and_determine_version_paths_are_mapped(): void
    {
        $service = new OsvService(baseUrl: 'https://osv.example.test');

        Http::fake(['*' => Http::response(['results' => [['vulns' => [['id' => 'GHSA-one']]], ['vulns' => []]]], 200)]);
        $batch = (new OsvQueryBatch($service))->execute([
            'queries' => [
                ['package_name' => 'mlflow', 'ecosystem' => 'PyPI', 'version' => '0.4.0'],
                ['commit' => '6879efc2c1596d11a6a6ad296f80063b558d5e0f'],
            ],
        ]);
        self::assertTrue($batch->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://osv.example.test/v1/querybatch'
            && $request->data() === ['queries' => [
                ['version' => '0.4.0', 'package' => ['name' => 'mlflow', 'ecosystem' => 'PyPI']],
                ['commit' => '6879efc2c1596d11a6a6ad296f80063b558d5e0f'],
            ]]);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'GHSA-vp9c-fpxx-744v'], 200)]);
        self::assertTrue((new OsvGetVulnerability($service))->execute(['id' => 'GHSA-vp9c-fpxx-744v'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://osv.example.test/v1/vulns/GHSA-vp9c-fpxx-744v');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['invalid_records' => [['bug_id' => 'EX-1234']]], 200)]);
        self::assertTrue((new OsvImportFindings($service))->execute(['source' => 'example'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://osv.example.test/v1experimental/importfindings/example');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['matches' => [['score' => 1, 'repo_info' => ['version' => '4.22.2']]]], 200)]);
        self::assertTrue((new OsvDetermineVersion($service))->execute([
            'name' => 'protobuf',
            'file_hashes' => [['file_path' => 'src/example.cc', 'hash' => 'YWJjZA==']],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://osv.example.test/v1experimental/determineversion'
            && $request->data() === ['name' => 'protobuf', 'file_hashes' => [['file_path' => 'src/example.cc', 'hash' => 'YWJjZA==']]]);
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new OsvService(baseUrl: 'https://osv.example.test');

        $missing = (new OsvQuery($service))->execute(['version' => '1.0.0']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('package is required', (string) $missing->error);

        $badCombo = (new OsvQuery($service))->execute(['commit' => 'abc', 'version' => '1.0.0']);
        self::assertFalse($badCombo->succeeded());
        self::assertStringContainsString('commit and version cannot', (string) $badCombo->error);

        $badPurl = (new OsvQuery($service))->execute(['purl' => 'pkg:pypi/jinja2@3.1.4', 'version' => '3.1.4']);
        self::assertFalse($badPurl->succeeded());
        self::assertStringContainsString('version cannot be used', (string) $badPurl->error);

        $missingHashes = (new OsvDetermineVersion($service))->execute([]);
        self::assertFalse($missingHashes->succeeded());
        self::assertStringContainsString('file_hashes is required', (string) $missingHashes->error);

        Http::fake(['*' => Http::response(['message' => 'bad request'], 400)]);
        $apiError = (new OsvGetVulnerability($service))->execute(['id' => 'bad']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('bad request', (string) $apiError->error);
    }

    public function test_provider_creates_tools_with_default_service(): void
    {
        Http::fake(['*' => Http::response(['id' => 'OSV-2020-111'], 200)]);

        app()->instance(OsvService::class, new OsvService(baseUrl: 'https://osv.example.test'));
        $tool = (new OsvToolProvider)->createTool(OsvGetVulnerability::class);
        $result = $tool->execute(['id' => 'OSV-2020-111']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://osv.example.test/v1/vulns/OSV-2020-111');
    }
}
