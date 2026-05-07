<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Aircall;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\Integrations\Aircall\AircallToolProvider;
use OpenCompany\Integrations\Aircall\Tools\AircallApiGet;
use OpenCompany\Integrations\Aircall\Tools\AircallPing;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for Aircall authentication and endpoint normalization.
 */
final class AircallServiceTest extends TestCase
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

    public function test_provider_metadata_supports_basic_auth_and_oauth_tokens(): void
    {
        $provider = new AircallToolProvider;

        self::assertSame('Aircall', $provider->integrationMeta()['name']);
        self::assertSame('basic_auth_or_bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['api_id', 'api_token', 'access_token'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame(['api_id', 'api_token', 'access_token', 'url'], array_column($provider->credentialFields(), 'key'));
        self::assertGreaterThan(70, count($provider->tools()));
        self::assertArrayHasKey('aircall_ping', $provider->tools());
        self::assertArrayHasKey('aircall_api_get', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_uses_basic_auth_and_normalizes_paths(): void
    {
        Http::fake(['*' => Http::response(['ping' => 'pong'], 200)]);

        $service = new AircallService(baseUrl: 'https://api.aircall.test/v1', apiId: 'id_test', apiToken: 'token_test');

        $service->apiGet('/ping');
        $service->apiGet('/v2/users', ['per_page' => 10]);
        $service->apiPost('/calls/123/comments', ['content' => 'Followed up']);

        Http::assertSentCount(3);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('id_test:token_test')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.aircall.test/v1/ping');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.aircall.test/v2/users?per_page=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.aircall.test/v1/calls/123/comments'
            && $request['content'] === 'Followed up');
    }

    public function test_service_still_supports_oauth_bearer_tokens(): void
    {
        Http::fake(['*' => Http::response(['ping' => 'pong'], 200)]);

        $service = new AircallService(accessToken: 'access_test', baseUrl: 'https://api.aircall.test');
        $service->apiGet('/ping');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer access_test')
            && $request->url() === 'https://api.aircall.test/v1/ping');
    }

    public function test_tools_use_service_auth_and_reject_unsafe_paths(): void
    {
        Http::fake(['*' => Http::response(['ping' => 'pong'], 200)]);

        $service = new AircallService(baseUrl: 'https://api.aircall.test', apiId: 'id_test', apiToken: 'token_test');

        $ping = (new AircallPing($service))->execute([]);
        self::assertTrue($ping->succeeded());

        $raw = (new AircallApiGet($service))->execute([
            'path' => '/calls/search',
            'params' => ['phone_number' => '+15551234567'],
        ]);
        self::assertTrue($raw->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.aircall.test/v1/ping');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.aircall.test/v1/calls/search?')
            && str_contains($request->url(), 'phone_number=%2B15551234567'));

        $unsafe = (new AircallApiGet($service))->execute(['path' => 'https://example.test/calls']);

        self::assertFalse($unsafe->succeeded());
        self::assertStringContainsString('safe relative', (string) $unsafe->error);
    }

    public function test_connection_supports_basic_and_bearer_without_user_lookup(): void
    {
        Http::fake(['*' => Http::response(['ping' => 'pong'], 200)]);

        $provider = new AircallToolProvider;

        $basic = $provider->testConnection([
            'api_id' => 'id_test',
            'api_token' => 'token_test',
            'url' => 'https://api.aircall.test',
        ]);
        $bearer = $provider->testConnection([
            'access_token' => 'access_test',
            'url' => 'https://api.aircall.test',
        ]);
        $missing = $provider->testConnection([]);

        self::assertTrue($basic['success']);
        self::assertTrue($bearer['success']);
        self::assertFalse($missing['success']);
        self::assertStringContainsString('API ID', (string) $missing['error']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.aircall.test/v1/ping'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('id_test:token_test')));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.aircall.test/v1/ping'
            && $request->hasHeader('Authorization', 'Bearer access_test'));
    }
}
