<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SonarQube;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\SonarQube\SonarQubeService;
use OpenCompany\Integrations\SonarQube\SonarQubeToolProvider;
use OpenCompany\Integrations\SonarQube\Tools\SonarQubeMeasuresComponent;
use OpenCompany\Integrations\SonarQube\Tools\SonarQubeProjectsCreate;
use OpenCompany\Integrations\SonarQube\Tools\SonarQubeProjectsSearch;
use PHPUnit\Framework\TestCase;

final class SonarQubeServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }

    public function test_provider_matches_webservices_manifest_and_docs(): void
    {
        $provider = new SonarQubeToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/sonarqube/sonarqube-webservices-manifest.json'), true);
        self::assertSame(271, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('SonarQube', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('sonarqube_projects_search', array_keys($provider->tools()));
        self::assertContains('sonarqube_measures_component', array_keys($provider->tools()));
        self::assertContains('sonarqube_projects_create', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_auth_get_query_and_post_form_params(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new SonarQubeService('tok', 'https://sonarqube.example.test');
        $service->request('GET', '/api/projects/search', ['q' => 'demo', 'ps' => 50]);
        $service->request('POST', '/api/projects/create', ['name' => 'Demo', 'project' => 'demo-key']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sonarqube.example.test/api/projects/search?q=demo&ps=50'
            && $request->hasHeader('Authorization', 'Bearer tok'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://sonarqube.example.test/api/projects/create'
            && str_contains((string) $request->body(), 'name=Demo')
            && str_contains((string) $request->body(), 'project=demo-key'));
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new SonarQubeService('tok');

        $search = (new SonarQubeProjectsSearch($service))->execute(['q' => 'demo', 'ps' => 20]);
        self::assertTrue($search->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://next.sonarqube.com/sonarqube/api/projects/search?')
            && $request->data()['q'] === 'demo'
            && $request->data()['ps'] === 20);

        $measures = (new SonarQubeMeasuresComponent($service))->execute(['component' => 'demo-key', 'metric_keys' => 'bugs,coverage']);
        self::assertTrue($measures->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://next.sonarqube.com/sonarqube/api/measures/component?')
            && $request->data()['component'] === 'demo-key'
            && $request->data()['metricKeys'] === 'bugs,coverage');

        $missing = (new SonarQubeProjectsCreate($service))->execute(['name' => 'Demo']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('project must be', (string) $missing->error);

        $created = (new SonarQubeProjectsCreate($service))->execute(['name' => 'Demo', 'project' => 'demo-key']);
        self::assertTrue($created->succeeded());
    }
}
