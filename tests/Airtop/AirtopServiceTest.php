<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Airtop;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\Integrations\Airtop\AirtopToolProvider;
use OpenCompany\Integrations\Airtop\Tools\AirtopFilesPush;
use OpenCompany\Integrations\Airtop\Tools\AirtopSessionsCreate;
use OpenCompany\Integrations\Airtop\Tools\AirtopSessionsGetInfo;
use OpenCompany\Integrations\Airtop\Tools\AirtopSessionsList;
use OpenCompany\Integrations\Airtop\Tools\AirtopSessionsWindowsLoadUrl;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Airtop official OpenAPI operation coverage.
 */
final class AirtopServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AirtopService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AirtopService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_openapi_surface(): void
    {
        $provider = new AirtopToolProvider;
        $tools = $provider->tools();

        self::assertSame('airtop', $provider->appName());
        self::assertSame('Airtop', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.airtop.ai/openapi.json', $provider->integrationMeta()['source_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('api_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(39, $tools);
        self::assertArrayHasKey('airtop_sessions_create', $tools);
        self::assertArrayHasKey('airtop_sessions_windows_load_url', $tools);
        self::assertArrayHasKey('airtop_files_push', $tools);
        self::assertArrayHasKey('airtop_requests_status_get_request_status', $tools);
        self::assertArrayNotHasKey('airtop_get_current_user', $tools);
    }

    public function test_service_maps_path_query_body_and_auth(): void
    {
        $service = new AirtopService('key-123', 'https://api.example.test/api');

        Http::fake(['*' => Http::response(['id' => 'sess_123'], 201)]);
        self::assertTrue((new AirtopSessionsCreate($service))->execute([
            'body' => ['configuration' => ['timeoutMinutes' => 10]],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/sessions'
            && $request->hasHeader('Authorization', 'Bearer key-123')
            && $request['configuration']['timeoutMinutes'] === 10);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'sess_123'], 200)]);
        self::assertTrue((new AirtopSessionsGetInfo($service))->execute(['id' => 'sess/123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/api/v1/sessions/sess%2F123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        self::assertTrue((new AirtopSessionsWindowsLoadUrl($service))->execute([
            'session_id' => 'sess_123',
            'window_id' => 'win_123',
            'body' => ['url' => 'https://example.test'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/sessions/sess_123/windows/win_123'
            && $request['url'] === 'https://example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['pushed' => true], 200)]);
        self::assertTrue((new AirtopFilesPush($service))->execute([
            'id' => 'file_123',
            'body' => ['sessionId' => 'sess_123'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/files/file_123/push'
            && $request['sessionId'] === 'sess_123');
    }

    public function test_validation_errors_test_connection_and_multi_account(): void
    {
        $service = new AirtopService('key-123', 'https://api.example.test/api');

        $missingPath = (new AirtopSessionsGetInfo($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('id is required', (string) $missingPath->error);

        $missingBody = (new AirtopSessionsCreate($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body is required', (string) $missingBody->error);

        $unconfigured = (new AirtopSessionsList(new AirtopService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['error' => 'Invalid API key'], 401)]);
        $apiError = (new AirtopSessionsList($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertSame(
            ['success' => true, 'message' => 'Connected to Airtop API.'],
            (new AirtopToolProvider)->testConnection([
                'api_key' => 'key-123',
                'url' => 'https://api.example.test/api',
            ]),
        );
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/api/v1/sessions'
            && $request->hasHeader('Authorization', 'Bearer key-123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['airtop', 'api_key', 'workspace'] => 'account-key',
                    ['airtop', 'url', 'workspace'] => 'https://account-api.example.test/api',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'airtop' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'airtop' ? ['workspace'] : [];
            }
        });

        $tool = (new AirtopToolProvider)->createTool(AirtopSessionsList::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-api.example.test/api/v1/sessions'
            && $request->hasHeader('Authorization', 'Bearer account-key'));
    }
}
