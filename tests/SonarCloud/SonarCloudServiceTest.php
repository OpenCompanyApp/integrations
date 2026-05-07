<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SonarCloud;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\SonarCloud\SonarCloudService;
use OpenCompany\Integrations\SonarCloud\SonarCloudToolProvider;
use OpenCompany\Integrations\SonarCloud\Tools\SonarCloudMeasuresComponent;
use OpenCompany\Integrations\SonarCloud\Tools\SonarCloudProjectsSearch;
use OpenCompany\Integrations\SonarCloud\Tools\SonarCloudFavoritesAdd;
use PHPUnit\Framework\TestCase;

final class SonarCloudServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_webservices_manifest_and_docs(): void { $provider = new SonarCloudToolProvider; $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/sonarcloud/sonarcloud-webservices-manifest.json'), true); self::assertSame(156, $manifest['method_count']); self::assertCount($manifest['method_count'], $provider->tools()); self::assertSame('SonarCloud', $provider->integrationMeta()['name']); self::assertSame('data', $provider->integrationMeta()['category']); self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string) $provider->luaDocsPath()); self::assertContains('sonarcloud_projects_search', array_keys($provider->tools())); self::assertContains('sonarcloud_measures_component', array_keys($provider->tools())); self::assertContains('sonarcloud_favorites_add', array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_get_query_and_post_form_params(): void { Http::fake(['*' => Http::response(['ok' => true], 200)]); $service = new SonarCloudService('tok', 'https://sonarcloud.example.test'); $service->request('GET', '/api/projects/search', ['organization' => 'acme', 'q' => 'demo']); $service->request('POST', '/api/favorites/add', ['component' => 'demo-key']); Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://sonarcloud.example.test/api/projects/search?') && $request->hasHeader('Authorization', 'Bearer tok') && $request->data()['organization'] === 'acme'); Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sonarcloud.example.test/api/favorites/add' && str_contains((string) $request->body(), 'component=demo-key')); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*' => Http::response(['ok' => true], 200)]); $service = new SonarCloudService('tok'); $search = (new SonarCloudProjectsSearch($service))->execute(['organization' => 'acme', 'q' => 'demo']); self::assertTrue($search->succeeded()); Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://sonarcloud.io/api/projects/search?') && $request->data()['organization'] === 'acme' && $request->data()['q'] === 'demo'); $measures = (new SonarCloudMeasuresComponent($service))->execute(['component' => 'demo-key', 'metric_keys' => 'bugs,coverage']); self::assertTrue($measures->succeeded()); Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://sonarcloud.io/api/measures/component?') && $request->data()['metricKeys'] === 'bugs,coverage'); $missing = (new SonarCloudFavoritesAdd($service))->execute([]); self::assertFalse($missing->succeeded()); self::assertStringContainsString('component must be', (string) $missing->error); $created = (new SonarCloudFavoritesAdd($service))->execute(['component' => 'demo-key']); self::assertTrue($created->succeeded()); }
}
