<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleAppsScript;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleAppsScript\GoogleAppsScriptService;
use OpenCompany\Integrations\GoogleAppsScript\GoogleAppsScriptToolProvider;
use OpenCompany\Integrations\GoogleAppsScript\Tools\GoogleAppsScriptProjectsGet;
use OpenCompany\Integrations\GoogleAppsScript\Tools\GoogleAppsScriptProjectsGetContent;
use OpenCompany\Integrations\GoogleAppsScript\Tools\GoogleAppsScriptScriptsRun;
use PHPUnit\Framework\TestCase;

final class GoogleAppsScriptServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleAppsScriptToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-apps-script/google-apps-script-discovery-manifest.json'), true);

        self::assertSame(16, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Apps Script', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], chr(92)) + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-apps-script/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_apps_script_projects_update_content', $manifestTools);
        self::assertContains('google_apps_script_projects_deployments_create', $manifestTools);
        self::assertContains('google_apps_script_processes_list_script_processes', $manifestTools);
        self::assertContains('google_apps_script_scripts_run', $manifestTools);
    }

    public function test_service_maps_auth_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleAppsScriptService('token-test', 'https://example.test');
        $service->request('GET', '/v1/projects/{scriptId}/content', ['scriptId' => 'script-1']);
        $service->request('POST', '/v1/scripts/{scriptId}:run', ['scriptId' => 'script-1'], [], [], ['function' => 'main', 'parameters' => ['arg']]);
        $service->request('GET', '/v1/processes', [], [], ['userProcessFilter.scriptId' => 'script-1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/projects/script-1/content'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/scripts/script-1:run'
            && $request['function'] === 'main');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/processes?userProcessFilter.scriptId=script-1');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleAppsScriptService('token-test');

        $content = new GoogleAppsScriptProjectsGetContent($service);
        $result = $content->execute(['scriptId' => 'script-1', 'versionNumber' => 1, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://script.googleapis.com/v1/projects/script-1/content?versionNumber=1');

        $missingPath = (new GoogleAppsScriptProjectsGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('scriptId must be', (string) $missingPath->error);

        $missingBody = (new GoogleAppsScriptScriptsRun($service))->execute(['scriptId' => 'script-1']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}