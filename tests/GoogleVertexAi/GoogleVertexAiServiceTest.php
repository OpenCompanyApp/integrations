<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleVertexAi;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleVertexAi\GoogleVertexAiService;
use OpenCompany\Integrations\GoogleVertexAi\GoogleVertexAiToolProvider;
use OpenCompany\Integrations\GoogleVertexAi\Tools\GoogleVertexAiProjectsLocationsEndpointsPredict;
use OpenCompany\Integrations\GoogleVertexAi\Tools\GoogleVertexAiProjectsLocationsModelsList;
use OpenCompany\Integrations\GoogleVertexAi\Tools\GoogleVertexAiProjectsLocationsPublishersModelsGenerateContent;
use PHPUnit\Framework\TestCase;

final class GoogleVertexAiServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleVertexAiToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-vertex-ai/google-vertex-ai-discovery-manifest.json'), true);

        self::assertSame(1003, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Vertex AI', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-vertex-ai/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_vertex_ai_projects_locations_models_list', $manifestTools);
        self::assertContains('google_vertex_ai_projects_locations_endpoints_predict', $manifestTools);
        self::assertContains('google_vertex_ai_projects_locations_publishers_models_generate_content', $manifestTools);
        self::assertContains('google_vertex_ai_projects_locations_reasoning_engines_query', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleVertexAiService('token-test', 'https://example.test');
        $service->request('GET', '/v1/{+parent}/models', ['parent' => 'projects/project-1/locations/us-central1'], ['parent'], ['pageSize' => 5]);
        $service->request('POST', '/v1/{+endpoint}:predict', ['endpoint' => 'projects/project-1/locations/us-central1/endpoints/123'], ['endpoint'], [], ['instances' => [['text' => 'hello']]]);
        $service->request('POST', '/v1/{+model}:generateContent', ['model' => 'projects/project-1/locations/us-central1/publishers/google/models/gemini-1.5-pro'], ['model'], [], ['contents' => [['role' => 'user', 'parts' => [['text' => 'hello']]]]]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/projects/project-1/locations/us-central1/models?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/projects/project-1/locations/us-central1/endpoints/123:predict'
            && $request['instances'][0]['text'] === 'hello');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/projects/project-1/locations/us-central1/publishers/google/models/gemini-1.5-pro:generateContent'
            && $request['contents'][0]['parts'][0]['text'] === 'hello');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleVertexAiService('token-test');

        $list = new GoogleVertexAiProjectsLocationsModelsList($service);
        $result = $list->execute(['parent' => 'projects/project-1/locations/us-central1', 'pageSize' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://aiplatform.googleapis.com/v1/projects/project-1/locations/us-central1/models?pageSize=10');

        $missingPath = (new GoogleVertexAiProjectsLocationsEndpointsPredict($service))->execute(['body' => ['instances' => []]]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('endpoint must be', (string) $missingPath->error);

        $missingBody = (new GoogleVertexAiProjectsLocationsPublishersModelsGenerateContent($service))->execute(['model' => 'projects/project-1/locations/us-central1/publishers/google/models/gemini-1.5-pro']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}