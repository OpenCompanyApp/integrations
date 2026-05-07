<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Clerk;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\Integrations\Clerk\ClerkToolProvider;
use OpenCompany\Integrations\Clerk\Tools\ClerkApiGet;
use OpenCompany\Integrations\Clerk\Tools\ClerkCreateOrganizationInvitation;
use OpenCompany\Integrations\Clerk\Tools\ClerkListSessions;
use OpenCompany\Integrations\Clerk\Tools\ClerkUpdateOrganizationMembership;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Clerk endpoint mapping and provider metadata.
 */
final class ClerkServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ClerkService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ClerkService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_supports_raw_methods_and_token_auth(): void
    {
        Http::fake(['*' => Http::response(['data' => []], 200)]);

        $service = new ClerkService('sk_test_123');
        $service->apiGet('/sessions', ['user_id' => 'user_123']);
        $service->apiPost('/organizations', ['name' => 'Example']);
        $service->apiPatch('/organizations/org_123', ['name' => 'Updated']);
        $service->apiDelete('/organizations/org_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer sk_test_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.clerk.com/v1/sessions?user_id=user_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.clerk.com/v1/organizations'
            && $request['name'] === 'Example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.clerk.com/v1/organizations/org_123'
            && $request['name'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.clerk.com/v1/organizations/org_123');
    }

    public function test_endpoint_tools_map_paths_query_and_bodies(): void
    {
        $service = new ClerkService('sk_test_123');

        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new ClerkApiGet($service))->execute([
            'path' => '/users',
            'query' => ['limit' => 1],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.clerk.com/v1/users?limit=1');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new ClerkListSessions($service))->execute([
            'user_id' => 'user_123',
            'status' => 'active',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.clerk.com/v1/sessions?user_id=user_123&status=active');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'inv_123'], 200)]);
        self::assertTrue((new ClerkCreateOrganizationInvitation($service))->execute([
            'organization_id' => 'org_123',
            'email_address' => 'person@example.test',
            'role' => 'org:member',
            'redirect_url' => 'https://example.test/welcome',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.clerk.com/v1/organizations/org_123/invitations'
            && $request['email_address'] === 'person@example.test'
            && $request['role'] === 'org:member');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'mem_123'], 200)]);
        self::assertTrue((new ClerkUpdateOrganizationMembership($service))->execute([
            'organization_id' => 'org_123',
            'user_id' => 'user_123',
            'role' => 'org:admin',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.clerk.com/v1/organizations/org_123/memberships/user_123'
            && $request['role'] === 'org:admin');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new ClerkToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://clerk.com/docs/reference/api/overview', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(35, count($tools));
        self::assertArrayHasKey('clerk_api_get', $tools);
        self::assertArrayHasKey('clerk_list_sessions', $tools);
        self::assertArrayHasKey('clerk_create_organization_invitation', $tools);
        self::assertArrayHasKey('clerk_create_sign_in_token', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new ClerkService('sk_test_123'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No secret key provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Clerk API successfully.'], $provider->testConnection([
            'secret_key' => 'sk_test_123',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.clerk.com/v1/users?limit=1');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['clerk', 'secret_key', 'auth'] => 'account-secret',
                    ['clerk', 'url', 'auth'] => 'https://clerk.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'clerk' && $account === 'auth';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'clerk' ? ['auth'] : [];
            }
        });

        $tool = $provider->createTool(ClerkApiGet::class, ['account' => 'auth']);
        self::assertTrue($tool->execute(['path' => '/users'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://clerk.example.test/v1/users'
            && $request->hasHeader('Authorization', 'Bearer account-secret'));
    }
}
