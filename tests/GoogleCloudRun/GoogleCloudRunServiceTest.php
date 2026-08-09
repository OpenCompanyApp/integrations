<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleCloudRun;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleCloudRun\GoogleCloudRunService;
use OpenCompany\Integrations\GoogleCloudRun\GoogleCloudRunToolProvider;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsJobsRun;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesCreate;
use OpenCompany\Integrations\GoogleCloudRun\Tools\GoogleCloudRunProjectsLocationsServicesList;
use PHPUnit\Framework\TestCase;

final class GoogleCloudRunServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleCloudRunToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-cloud-run/google-cloud-run-discovery-manifest.json'), true);

        self::assertSame(58, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Cloud Run', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-cloud-run/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_cloud_run_projects_locations_services_list', $manifestTools);
        self::assertContains('google_cloud_run_projects_locations_jobs_run', $manifestTools);
        self::assertContains('google_cloud_run_projects_locations_worker_pools_create', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleCloudRunService('token-test', 'https://example.test');
        $service->request('GET', '/v2/{+parent}/services', ['parent' => 'projects/project-1/locations/us-central1'], ['parent'], ['pageSize' => 5]);
        $service->request('POST', '/v2/{+parent}/services', ['parent' => 'projects/project-1/locations/us-central1'], ['parent'], ['serviceId' => 'api'], ['template' => ['containers' => [['image' => 'example/image']]]]);
        $service->request('POST', '/v2/{+name}:run', ['name' => 'projects/project-1/locations/us-central1/jobs/importer'], ['name'], [], []);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v2/projects/project-1/locations/us-central1/services?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v2/projects/project-1/locations/us-central1/services?serviceId=api'
            && $request['template']['containers'][0]['image'] === 'example/image');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v2/projects/project-1/locations/us-central1/jobs/importer:run');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleCloudRunService('token-test');

        $list = new GoogleCloudRunProjectsLocationsServicesList($service);
        $result = $list->execute(['parent' => 'projects/project-1/locations/us-central1', 'pageSize' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://run.googleapis.com/v2/projects/project-1/locations/us-central1/services?pageSize=10');

        $missingPath = (new GoogleCloudRunProjectsLocationsJobsRun($service))->execute(['body' => []]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('name must be', (string) $missingPath->error);

        $missingBody = (new GoogleCloudRunProjectsLocationsServicesCreate($service))->execute(['parent' => 'projects/project-1/locations/us-central1']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}