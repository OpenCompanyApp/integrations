<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Urlscan;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanGetResult;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanSearchDatasource;
use OpenCompany\Integrations\Urlscan\Tools\UrlscanSubmitScan;
use OpenCompany\Integrations\Urlscan\UrlscanService;
use OpenCompany\Integrations\Urlscan\UrlscanToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated urlscan.io OpenAPI integration.
 */
final class UrlscanServiceTest extends TestCase
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

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new UrlscanToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/urlscan/urlscan-openapi-manifest.json'), true);

        self::assertSame(50, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('urlscan.io', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('urlscan_submit_scan', array_keys($provider->tools()));
        self::assertContains('urlscan_search_datasource', array_keys($provider->tools()));
        self::assertContains('urlscan_lookup_malicious_observable', array_keys($provider->tools()));
    }

    public function test_service_injects_api_key_and_maps_path_query_json_and_text_responses(): void
    {
        Http::fake([
            'urlscan.example.test/api/v1/search*' => Http::response(['results' => []], 200),
            'urlscan.example.test/api/v1/result/*' => Http::response(['task' => ['uuid' => 'scan-1']], 200),
            'urlscan.example.test/dom/*' => Http::response('<html></html>', 200, ['Content-Type' => 'text/html']),
            '*' => Http::response(['ok' => true], 200),
        ]);

        $service = new UrlscanService('key', 'https://urlscan.example.test');
        $service->request('GET', '/api/v1/search', [], ['q' => 'page.domain:example.test', 'size' => 5]);
        $service->request('GET', '/api/v1/result/{scanId}/', ['scanId' => 'scan 1']);
        $dom = $service->request('GET', '/dom/{scanId}/', ['scanId' => 'scan 1']);
        $service->request('POST', '/api/v1/scan', [], [], [], ['url' => 'https://example.test']);

        self::assertSame('<html></html>', $dom['body']);
        self::assertSame('text/html', $dom['content_type']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://urlscan.example.test/api/v1/search?q=page.domain%3Aexample.test&size=5'
            && $request->hasHeader('api-key', 'key'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://urlscan.example.test/api/v1/result/scan%201/');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://urlscan.example.test/api/v1/scan'
            && $request['url'] === 'https://example.test');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new UrlscanService('key', 'https://urlscan.example.test');

        self::assertTrue((new UrlscanSubmitScan($service))->execute(['body' => ['url' => 'https://example.test']])->succeeded());
        self::assertTrue((new UrlscanSearchDatasource($service))->execute(['q' => 'page.domain:example.test'])->succeeded());
        self::assertTrue((new UrlscanGetResult($service))->execute(['scan_id' => 'scan-1'])->succeeded());

        $missingPath = (new UrlscanGetResult($service))->execute([]);
        $missingBody = (new UrlscanSubmitScan($service))->execute([]);
        $unconfigured = (new UrlscanSearchDatasource(new UrlscanService('', 'https://urlscan.example.test')))->execute([]);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('scan_id must be', (string) $missingPath->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_quotas_endpoint(): void
    {
        Http::fake(['urlscan.example.test/api/v1/quotas' => Http::response(['limits' => []], 200)]);

        $result = (new UrlscanToolProvider)->testConnection(['api_key' => 'key', 'url' => 'https://urlscan.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://urlscan.example.test/api/v1/quotas'
            && $request->hasHeader('api-key', 'key'));
    }
}
