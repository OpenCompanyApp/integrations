<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleCloudFunctions;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleCloudFunctions\GoogleCloudFunctionsService;
use OpenCompany\Integrations\GoogleCloudFunctions\GoogleCloudFunctionsToolProvider;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsCreate;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsGenerateUploadUrl;
use OpenCompany\Integrations\GoogleCloudFunctions\Tools\GoogleCloudFunctionsProjectsLocationsFunctionsList;
use PHPUnit\Framework\TestCase;

final class GoogleCloudFunctionsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleCloudFunctionsToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-cloud-functions/google-cloud-functions-discovery-manifest.json'), true);

        self::assertSame(21, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Cloud Functions', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-cloud-functions/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_cloud_functions_projects_locations_functions_generate_upload_url', $manifestTools);
        self::assertContains('google_cloud_functions_projects_locations_functions_commit_function_upgrade', $manifestTools);
        self::assertContains('google_cloud_functions_projects_locations_runtimes_list', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleCloudFunctionsService('token-test', 'https://example.test');
        $service->request('GET', '/v2/{+parent}/functions', ['parent' => 'projects/project-1/locations/us-central1'], ['parent'], ['pageSize' => 5]);
        $service->request('POST', '/v2/{+parent}/functions:generateUploadUrl', ['parent' => 'projects/project-1/locations/us-central1'], ['parent'], [], ['kmsKeyName' => 'projects/p/locations/l/keyRings/r/cryptoKeys/k']);
        $service->request('POST', '/v2/{+parent}/functions', ['parent' => 'projects/project-1/locations/us-central1'], ['parent'], ['functionId' => 'api'], ['buildConfig' => ['runtime' => 'php83']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v2/projects/project-1/locations/us-central1/functions?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v2/projects/project-1/locations/us-central1/functions:generateUploadUrl'
            && $request['kmsKeyName'] === 'projects/p/locations/l/keyRings/r/cryptoKeys/k');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v2/projects/project-1/locations/us-central1/functions?functionId=api'
            && $request['buildConfig']['runtime'] === 'php83');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleCloudFunctionsService('token-test');

        $list = new GoogleCloudFunctionsProjectsLocationsFunctionsList($service);
        $result = $list->execute(['parent' => 'projects/project-1/locations/us-central1', 'pageSize' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cloudfunctions.googleapis.com/v2/projects/project-1/locations/us-central1/functions?pageSize=10');

        $missingPath = (new GoogleCloudFunctionsProjectsLocationsFunctionsGenerateUploadUrl($service))->execute(['body' => []]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('parent must be', (string) $missingPath->error);

        $missingBody = (new GoogleCloudFunctionsProjectsLocationsFunctionsCreate($service))->execute(['parent' => 'projects/project-1/locations/us-central1']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}