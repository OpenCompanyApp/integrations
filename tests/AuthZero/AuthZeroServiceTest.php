<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AuthZero;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\AuthZero\AuthZeroService;
use OpenCompany\Integrations\AuthZero\AuthZeroToolProvider;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroCreateUser;
use OpenCompany\Integrations\AuthZero\Tools\AuthZeroGetCurrentUser;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for Auth0 Management API request mapping and metadata.
 */
final class AuthZeroServiceTest extends TestCase
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

    public function test_provider_metadata_credentials_and_health_connection(): void
    {
        Http::fake([
            'https://tenant.example.test/api/v2/tenants/settings' => Http::response(['friendly_name' => 'Example Tenant'], 200),
        ]);

        $provider = new AuthZeroToolProvider;

        self::assertSame('auth-zero', $provider->appName());
        self::assertSame('Auth0', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['access_token'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame(['access_token', 'domain'], array_column($provider->credentialFields(), 'key'));
        self::assertCount(7, $provider->tools());
        self::assertArrayHasKey('auth_zero_list_users', $provider->tools());
        self::assertArrayHasKey('auth_zero_get_current_user', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());

        $connection = $provider->testConnection([
            'access_token' => 'auth0_test',
            'domain' => 'https://tenant.example.test/path/ignored',
        ]);

        self::assertTrue($connection['success']);
        self::assertStringContainsString('tenant.example.test', (string) $connection['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant.example.test/api/v2/tenants/settings'
            && $request->hasHeader('Authorization', 'Bearer auth0_test'));
    }

    public function test_service_normalizes_domains_and_maps_management_api_paths(): void
    {
        Http::fake(['https://tenant.example.test/*' => Http::response(['ok' => true], 200)]);

        $service = new AuthZeroService('auth0_test', 'https://tenant.example.test/path/ignored');

        $service->listUsers(['per_page' => 10, 'q' => 'email:*@example.test']);
        $service->getUser('auth0|abc');
        $service->createUser([
            'email' => 'jane@example.test',
            'password' => 'secret',
            'connection' => 'Username-Password-Authentication',
        ]);
        $service->listConnections(['strategy' => 'auth0']);
        $service->getRoles(['page' => 0]);
        $service->healthCheck();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer auth0_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://tenant.example.test/api/v2/users?')
            && str_contains($request->url(), 'per_page=10')
            && str_contains($request->url(), 'q=email%3A%2A%40example.test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant.example.test/api/v2/users/auth0%7Cabc');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://tenant.example.test/api/v2/users'
            && $request['email'] === 'jane@example.test'
            && $request['connection'] === 'Username-Password-Authentication');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://tenant.example.test/api/v2/connections?')
            && str_contains($request->url(), 'strategy=auth0'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://tenant.example.test/api/v2/roles?')
            && str_contains($request->url(), 'page=0'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant.example.test/api/v2/tenants/settings');
    }

    public function test_health_tool_and_create_user_validation(): void
    {
        Http::fake([
            'https://tenant.example.test/api/v2/tenants/settings' => Http::response(['friendly_name' => 'Example Tenant'], 200),
            'https://tenant.example.test/api/v2/users' => Http::response(['user_id' => 'auth0|abc'], 201),
        ]);

        $service = new AuthZeroService('auth0_test', 'tenant.example.test');

        $health = (new AuthZeroGetCurrentUser($service))->execute([]);
        self::assertTrue($health->succeeded());
        self::assertSame('Example Tenant', $health->data['friendly_name']);
        self::assertStringContainsString('Management API token is valid', $health->data['_health_check']);

        $created = (new AuthZeroCreateUser($service))->execute([
            'email' => 'jane@example.test',
            'password' => 'secret',
            'connection' => 'Username-Password-Authentication',
        ]);
        self::assertTrue($created->succeeded());
        self::assertSame('auth0|abc', $created->data['user_id']);

        $missingEmail = (new AuthZeroCreateUser($service))->execute([
            'password' => 'secret',
            'connection' => 'Username-Password-Authentication',
        ]);
        self::assertFalse($missingEmail->succeeded());
        self::assertStringContainsString('email', (string) $missingEmail->error);

        $unconfigured = (new AuthZeroCreateUser(new AuthZeroService('', 'tenant.example.test')))->execute([
            'email' => 'jane@example.test',
            'password' => 'secret',
            'connection' => 'Username-Password-Authentication',
        ]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }
}
