<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Greenhouse;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Greenhouse\GreenhouseService;
use OpenCompany\Integrations\Greenhouse\GreenhouseToolProvider;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostAuthToken;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Candidates;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Candidates;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Greenhouse Harvest v3 OpenAPI integration.
 */
final class GreenhouseServiceTest extends TestCase
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
        $provider = new GreenhouseToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/greenhouse/greenhouse-openapi-manifest.json'), true);

        self::assertSame(151, $manifest['method_count']);
        self::assertSame('3.1.0', $manifest['openapi']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Greenhouse', $provider->integrationMeta()['name']);
        self::assertSame('oauth_client_credentials', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('greenhouse_post_auth_token', array_keys($provider->tools()));
        self::assertContains('greenhouse_get_v3_candidates', array_keys($provider->tools()));
        self::assertContains('greenhouse_post_v3_candidates', array_keys($provider->tools()));
    }

    public function test_service_maps_token_bearer_query_and_body_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200, ['Link' => '<https://harvest.example.test/v3/candidates?cursor=next>; rel="next"'])]);

        $tokenService = new GreenhouseService('', 'client', 'secret', 'https://harvest.example.test');
        $tokenService->request('POST', '/auth/token', [], [], [], ['sub' => 123], 'client_credentials_request');

        $service = new GreenhouseService('access', '', '', 'https://harvest.example.test');
        $service->request('GET', '/v3/candidates', [], ['per_page' => 50, 'ids' => [1, 2], 'created_at' => ['gte' => '2024-01-01T00:00:00Z']], [], [], 'bearer', ['ids' => 'form', 'created_at' => 'pipeDelimited']);
        $service->request('POST', '/v3/candidates', [], [], [], ['first_name' => 'Ada'], 'bearer');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://harvest.example.test/auth/token'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('client:secret')));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://harvest.example.test/v3/candidates?per_page=50&ids=1%2C2&created_at=gte%7C2024-01-01T00%3A00%3A00Z'
            && $request->hasHeader('Authorization', 'Bearer access'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://harvest.example.test/v3/candidates'
            && $request->hasHeader('Authorization', 'Bearer access')
            && $request->data()['first_name'] === 'Ada');
    }

    public function test_service_can_fetch_runtime_token_from_client_credentials(): void
    {
        Http::fake([
            'harvest.example.test/auth/token' => Http::response(['access_token' => 'runtime-token', 'token_type' => 'Bearer', 'expires' => '2026-01-01T00:00:00Z'], 200),
            'harvest.example.test/v3/candidates?per_page=1' => Http::response([['id' => 123]], 200),
        ]);

        $service = new GreenhouseService('', 'client', 'secret', 'https://harvest.example.test');
        $result = $service->request('GET', '/v3/candidates', [], ['per_page' => 1]);

        self::assertSame([['id' => 123]], $result);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://harvest.example.test/auth/token'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('client:secret')));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://harvest.example.test/v3/candidates?per_page=1'
            && $request->hasHeader('Authorization', 'Bearer runtime-token'));
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true, 'access_token' => 'runtime-token'], 200)]);

        $service = new GreenhouseService('access', 'client', 'secret', 'https://harvest.example.test');

        self::assertTrue((new GreenhousePostAuthToken($service))->execute(['body' => ['sub' => 123]])->succeeded());
        self::assertTrue((new GreenhouseGetV3Candidates($service))->execute(['per_page' => 10, 'created_at' => ['gte' => '2024-01-01T00:00:00Z']])->succeeded());
        self::assertTrue((new GreenhousePostV3Candidates($service))->execute(['body' => ['first_name' => 'Ada', 'last_name' => 'Lovelace']])->succeeded());

        $badBody = (new GreenhousePostV3Candidates($service))->execute(['body' => 'not-object']);
        $missingBody = (new GreenhousePostV3Candidates($service))->execute([]);
        $unconfigured = (new GreenhouseGetV3Candidates(new GreenhouseService('', '', '', 'https://harvest.example.test')))->execute([]);

        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token or client credentials', (string) $unconfigured->error);
    }

    public function test_connection_uses_token_endpoint_with_client_credentials(): void
    {
        Http::fake(['harvest.example.test/auth/token' => Http::response(['access_token' => 'runtime-token'], 200)]);

        $result = (new GreenhouseToolProvider)->testConnection(['client_id' => 'client', 'client_secret' => 'secret', 'url' => 'https://harvest.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://harvest.example.test/auth/token'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('client:secret')));
    }
}
