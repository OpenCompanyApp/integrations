<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Browserbase;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Browserbase\BrowserbaseService;
use OpenCompany\Integrations\Browserbase\BrowserbaseToolProvider;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseProjectsList;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSearchWeb;
use OpenCompany\Integrations\Browserbase\Tools\BrowserbaseSessionsGet;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Browserbase OpenAPI integration.
 */
final class BrowserbaseServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new BrowserbaseToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/browserbase/browserbase-openapi-manifest.json'), true);
        self::assertSame(34, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Browserbase', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('browserbase_sessions_create', array_keys($provider->tools()));
        self::assertContains('browserbase_search_web', array_keys($provider->tools()));
        self::assertContains('browserbase_extensions_upload', array_keys($provider->tools()));
    }

    public function test_service_maps_api_key_path_query_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new BrowserbaseService('key', 'https://browserbase.example.test');
        $service->request('GET', '/v1/downloads', [], ['sessionId' => 'sess 1']);
        $service->request('POST', '/v1/search', [], [], [], ['query' => 'agents']);
        $service->request('GET', '/v1/sessions/{id}', ['id' => 'sess 1']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://browserbase.example.test/v1/downloads?sessionId=sess+1' && $request->hasHeader('X-BB-API-Key', 'key'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://browserbase.example.test/v1/search' && $request['query'] === 'agents');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://browserbase.example.test/v1/sessions/sess%201');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new BrowserbaseService('key', 'https://browserbase.example.test');
        self::assertTrue((new BrowserbaseProjectsList($service))->execute([])->succeeded());
        $missing = (new BrowserbaseSessionsGet($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('id must be', (string) $missing->error);
        self::assertTrue((new BrowserbaseSearchWeb($service))->execute(['body' => ['query' => 'agents']])->succeeded());
    }
}
