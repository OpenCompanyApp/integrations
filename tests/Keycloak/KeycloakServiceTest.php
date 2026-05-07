<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Keycloak;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Keycloak\KeycloakOperations;
use OpenCompany\Integrations\Keycloak\KeycloakService;
use OpenCompany\Integrations\Keycloak\KeycloakToolProvider;
use OpenCompany\Integrations\Keycloak\Tools\KeycloakGetAdminRealmsRealmUsers;
use OpenCompany\Integrations\Keycloak\Tools\KeycloakGetAdminRealmsRealmUsersUserId;
use PHPUnit\Framework\TestCase;

final class KeycloakServiceTest extends TestCase
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
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_matches_official_openapi_manifest_and_docs(): void
    {
        $provider = new KeycloakToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/keycloak/keycloak-openapi-manifest.json'), true);

        self::assertSame('keycloak', $provider->appName());
        self::assertSame('Keycloak', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://www.keycloak.org/docs-api/latest/rest-api/openapi.json', $provider->integrationMeta()['source_url']);
        self::assertSame(401, $manifest['method_count']);
        self::assertCount($manifest['method_count'], KeycloakOperations::all());
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertArrayHasKey('keycloak_get_admin_realms_realm_users', $provider->tools());
        self::assertArrayHasKey('keycloak_post_admin_realms_realm_users', $provider->tools());
        self::assertArrayHasKey('keycloak_get_admin_realms_realm_clients', $provider->tools());
        self::assertArrayHasKey('keycloak_get_admin_realms_realm_groups', $provider->tools());
    }

    public function test_service_maps_bearer_path_query_json_body_and_empty_responses(): void
    {
        Http::fake(static function (Request $request) {
            if (str_starts_with($request->url(), 'https://keycloak.example.test/admin/realms/master/users/user%201')) {
                return Http::response(['id' => 'user 1'], 200);
            }

            if ($request->method() === 'POST' && $request->url() === 'https://keycloak.example.test/admin/realms/master/users') {
                return Http::response('', 201);
            }

            return Http::response([['id' => 'user-1', 'username' => 'alice']], 200);
        });

        $service = new KeycloakService(accessToken: 'kc-token', baseUrl: 'https://keycloak.example.test');

        self::assertSame([['id' => 'user-1', 'username' => 'alice']], $service->executeOperation(KeycloakOperations::all()['keycloak_get_admin_realms_realm_users'], [
            'realm' => 'master',
            'username' => 'alice',
            'brief_representation' => true,
            'first' => 0,
            'max' => 10,
        ]));
        self::assertSame(['success' => true, 'status' => 201], $service->executeOperation(KeycloakOperations::all()['keycloak_post_admin_realms_realm_users'], [
            'realm' => 'master',
            'body' => ['username' => 'agent-test', 'enabled' => true],
        ]));
        self::assertSame(['id' => 'user 1'], $service->executeOperation(KeycloakOperations::all()['keycloak_get_admin_realms_realm_users_user_id'], [
            'realm' => 'master',
            'user_id' => 'user 1',
            'user_profile_metadata' => true,
        ]));

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://keycloak.example.test/admin/realms/master/users?')
                && ($query['username'] ?? null) === 'alice'
                && ($query['briefRepresentation'] ?? null) === 'true'
                && ($query['first'] ?? null) === '0'
                && ($query['max'] ?? null) === '10'
                && $request->hasHeader('Authorization', 'Bearer kc-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://keycloak.example.test/admin/realms/master/users'
            && $request['username'] === 'agent-test'
            && $request['enabled'] === true
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://keycloak.example.test/admin/realms/master/users/user%201?')
                && ($query['userProfileMetadata'] ?? null) === 'true';
        });
    }

    public function test_generated_tools_validate_and_map_arguments(): void
    {
        Http::fake([
            'https://keycloak.example.test/admin/realms/master/users/user-1*' => Http::response(['id' => 'user-1'], 200),
            'https://keycloak.example.test/admin/realms/master/users*' => Http::response([['id' => 'user-1']], 200),
        ]);

        $service = new KeycloakService(accessToken: 'kc-token', baseUrl: 'https://keycloak.example.test');

        $users = new KeycloakGetAdminRealmsRealmUsers($service);
        $missing = $users->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('realm must be a non-empty parameter.', $missing->error);

        $success = $users->execute(['realm' => 'master', 'email_verified' => true]);
        self::assertTrue($success->succeeded());
        self::assertSame('user-1', $success->data[0]['id']);

        $detail = (new KeycloakGetAdminRealmsRealmUsersUserId($service))->execute(['realm' => 'master', 'user_id' => 'user-1']);
        self::assertTrue($detail->succeeded());
        self::assertSame('user-1', $detail->data['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://keycloak.example.test/admin/realms/master/users?')
                && ($query['emailVerified'] ?? null) === 'true'
                && $request->hasHeader('Authorization', 'Bearer kc-token');
        });
    }

    public function test_provider_connection_and_named_account_resolution(): void
    {
        Http::fake([
            'https://keycloak.example.test/admin/realms/master' => Http::response(['realm' => 'master'], 200),
            'https://tenant.example.test/admin/realms/acme/users*' => Http::response([['id' => 'tenant-user']], 200),
        ]);

        $provider = new KeycloakToolProvider;
        self::assertTrue($provider->testConnection([
            'access_token' => 'kc-token',
            'base_url' => 'https://keycloak.example.test',
            'realm' => 'master',
        ])['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'keycloak' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-token',
                    'base_url' => 'https://tenant.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'keycloak' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'keycloak' ? ['work'] : [];
            }
        });

        $tool = $provider->createTool(KeycloakGetAdminRealmsRealmUsers::class, ['account' => 'work']);
        $result = $tool->execute(['realm' => 'acme']);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-user', $result->data[0]['id']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant.example.test/admin/realms/acme/users'
            && $request->hasHeader('Authorization', 'Bearer tenant-token'));
    }
}
