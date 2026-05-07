<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GitGuardian;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GitGuardian\GitGuardianService;
use OpenCompany\Integrations\GitGuardian\GitGuardianToolProvider;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianContentScan;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateCustomTag;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimUserCreate;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated GitGuardian OpenAPI integration.
 */
final class GitGuardianServiceTest extends TestCase
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
        $provider = new GitGuardianToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/gitguardian/gitguardian-openapi-manifest.json'), true);

        self::assertSame(167, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('GitGuardian', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('gitguardian_content_scan', array_keys($provider->tools()));
        self::assertContains('gitguardian_list_incidents', array_keys($provider->tools()));
        self::assertContains('gitguardian_scim_user_create', array_keys($provider->tools()));
    }

    public function test_service_injects_token_auth_and_maps_path_query_arrays_json_and_scim(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GitGuardianService('key', 'https://gitguardian.example.test');
        $service->request('GET', '/v1/incidents/secrets', [], ['status' => ['TRIGGERED', 'ASSIGNED'], 'per_page' => 2]);
        $service->request('GET', '/v1/incidents/secrets/{incident_id}', ['incident_id' => 'incident 1']);
        $service->request('POST', '/v1/scan', [], [], [], ['document' => 'dummy']);
        $service->request('POST', '/v1/scim/v2/Users', [], [], [], ['userName' => 'agent@example.test'], 'application/scim+json');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitguardian.example.test/v1/incidents/secrets?status=TRIGGERED&status=ASSIGNED&per_page=2'
            && $request->hasHeader('Authorization', 'Token key'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitguardian.example.test/v1/incidents/secrets/incident%201');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://gitguardian.example.test/v1/scan'
            && $request['document'] === 'dummy');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://gitguardian.example.test/v1/scim/v2/Users'
            && $request->hasHeader('Content-Type', 'application/scim+json'));
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GitGuardianService('key', 'https://gitguardian.example.test');

        self::assertTrue((new GitGuardianListIncidents($service))->execute(['status' => ['TRIGGERED']])->succeeded());
        self::assertTrue((new GitGuardianRetrieveIncidents($service))->execute(['incident_id' => 123])->succeeded());
        self::assertTrue((new GitGuardianContentScan($service))->execute(['body' => ['document' => 'dummy']])->succeeded());
        self::assertTrue((new GitGuardianScimUserCreate($service))->execute(['body' => ['userName' => 'agent@example.test']])->succeeded());

        $missingPath = (new GitGuardianRetrieveIncidents($service))->execute([]);
        $missingBody = (new GitGuardianCreateCustomTag($service))->execute([]);
        $unconfigured = (new GitGuardianListIncidents(new GitGuardianService('', 'https://gitguardian.example.test')))->execute([]);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('incident_id must be', (string) $missingPath->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_current_token_endpoint(): void
    {
        Http::fake(['gitguardian.example.test/v1/api_tokens/self' => Http::response(['name' => 'agent token'], 200)]);

        $result = (new GitGuardianToolProvider)->testConnection(['api_key' => 'key', 'url' => 'https://gitguardian.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitguardian.example.test/v1/api_tokens/self'
            && $request->hasHeader('Authorization', 'Token key'));
    }
}
