<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleSearchConsole;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleToolProvider;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GoogleSearchConsoleSitesGet;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GoogleSearchConsoleSitemapsList;
use OpenCompany\Integrations\GoogleSearchConsole\Tools\GoogleSearchConsoleSearchanalyticsQuery;
use PHPUnit\Framework\TestCase;

final class GoogleSearchConsoleServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new GoogleSearchConsoleToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-search-console/google-search-console-discovery-manifest.json'),true); self::assertSame(11,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Search Console',$provider->integrationMeta()['name']); self::assertSame('analytics',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('google_search_console_searchanalytics_query',array_keys($provider->tools())); self::assertContains('google_search_console_url_inspection_index_inspect',array_keys($provider->tools())); }
    public function test_service_maps_paths_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleSearchConsoleService('token-test','https://example.test'); $service->request('GET','/webmasters/v3/sites/{siteUrl}/sitemaps',['siteUrl'=>'https://example.com/'],[],['sitemapIndex'=>0]); $service->request('POST','/webmasters/v3/sites/{siteUrl}/searchAnalytics/query',['siteUrl'=>'https://example.com/'],[],[],['startDate'=>'2026-05-01']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/webmasters/v3/sites/https%3A%2F%2Fexample.com%2F/sitemaps?sitemapIndex=0' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/webmasters/v3/sites/https%3A%2F%2Fexample.com%2F/searchAnalytics/query' && $request['startDate']==='2026-05-01'); }
    public function test_tools_filter_query_require_path_params_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleSearchConsoleService('token-test'); $list=new GoogleSearchConsoleSitemapsList($service); $result=$list->execute(['siteUrl'=>'https://example.com/','sitemapIndex'=>2,'unknown'=>'ignored']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://searchconsole.googleapis.com/webmasters/v3/sites/https%3A%2F%2Fexample.com%2F/sitemaps?sitemapIndex=2'); $missingPath=(new GoogleSearchConsoleSitesGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('siteUrl must be',(string)$missingPath->error); $missingBody=(new GoogleSearchConsoleSearchanalyticsQuery($service))->execute(['siteUrl'=>'https://example.com/']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); }
}
