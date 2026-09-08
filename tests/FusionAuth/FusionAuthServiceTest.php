<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\FusionAuth;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\FusionAuth\FusionAuthOperations;
use OpenCompany\Integrations\FusionAuth\FusionAuthService;
use OpenCompany\Integrations\FusionAuth\FusionAuthToolProvider;
use OpenCompany\Integrations\FusionAuth\Tools\FusionAuthCreateUser;
use OpenCompany\Integrations\FusionAuth\Tools\FusionAuthRetrieveUser;
use OpenCompany\Integrations\FusionAuth\Tools\FusionAuthRetrieveUserWithId;
use PHPUnit\Framework\TestCase;

final class FusionAuthServiceTest extends TestCase
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
        $provider = new FusionAuthToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/fusionauth/fusionauth-openapi-manifest.json'), true);

        self::assertSame('fusionauth', $provider->appName());
        self::assertSame('FusionAuth', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://raw.githubusercontent.com/FusionAuth/fusionauth-openapi/main/openapi.yaml', $provider->integrationMeta()['source_url']);
        self::assertSame(322, $manifest['method_count']);
        self::assertCount($manifest['method_count'], FusionAuthOperations::all());
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('api_key_header', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertArrayHasKey('fusionauth_retrieve_user', $provider->tools());
        self::assertArrayHasKey('fusionauth_create_user', $provider->tools());
        self::assertArrayHasKey('fusionauth_search_applications_with_id', $provider->tools());
        self::assertArrayHasKey('fusionauth_retrieve_status', $provider->tools());
    }

    public function test_service_maps_api_key_tenant_path_query_json_body_and_empty_responses(): void
    {
        Http::fake(static function (Request $request) {
            if (str_starts_with($request->url(), 'https://auth.example.test/api/user/user%201')) {
                return Http::response(['user' => ['id' => 'user 1']], 200);
            }

            if ($request->method() === 'POST' && $request->url() === 'https://auth.example.test/api/user') {
                return Http::response('', 201);
            }

            return Http::response(['user' => ['id' => 'user-1', 'email' => 'alice@example.test']], 200);
        });

        $service = new FusionAuthService(apiKey: 'fusion-key', baseUrl: 'https://auth.example.test', tenantId: 'default-tenant');

        self::assertSame(['user' => ['id' => 'user-1', 'email' => 'alice@example.test']], $service->executeOperation(FusionAuthOperations::all()['fusionauth_retrieve_user'], [
            'email' => 'alice@example.test',
            'login_id' => 'alice',
        ]));
        self::assertSame(['success' => true, 'status' => 201], $service->executeOperation(FusionAuthOperations::all()['fusionauth_create_user'], [
            'tenant_id' => 'explicit-tenant',
            'body' => ['user' => ['email' => 'new@example.test', 'username' => 'new-user']],
        ]));
        self::assertSame(['user' => ['id' => 'user 1']], $service->executeOperation(FusionAuthOperations::all()['fusionauth_retrieve_user_with_id'], [
            'user_id' => 'user 1',
        ]));

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://auth.example.test/api/user?')
                && ($query['email'] ?? null) === 'alice@example.test'
                && ($query['loginId'] ?? null) === 'alice'
                && $request->hasHeader('Authorization', 'fusion-key')
                && $request->hasHeader('X-FusionAuth-TenantId', 'default-tenant');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://auth.example.test/api/user'
            && $request['user']['email'] === 'new@example.test'
            && $request->hasHeader('Authorization', 'fusion-key')
            && $request->hasHeader('X-FusionAuth-TenantId', 'explicit-tenant')
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://auth.example.test/api/user/user%201'
            && $request->hasHeader('X-FusionAuth-TenantId', 'default-tenant'));
    }

    public function test_generated_tools_validate_and_map_arguments(): void
    {
        Http::fake([
            'https://auth.example.test/api/user/user-1' => Http::response(['user' => ['id' => 'user-1']], 200),
            'https://auth.example.test/api/user*' => Http::response(['user' => ['id' => 'found-user']], 200),
        ]);

        $service = new FusionAuthService(apiKey: 'fusion-key', baseUrl: 'https://auth.example.test');

        $detail = new FusionAuthRetrieveUserWithId($service);
        $missing = $detail->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('user_id must be a non-empty parameter.', $missing->error);

        $success = $detail->execute(['user_id' => 'user-1']);
        self::assertTrue($success->succeeded());
        self::assertSame('user-1', $success->data['user']['id']);

        $found = (new FusionAuthRetrieveUser($service))->execute(['email' => 'agent@example.test', 'tenant_id' => 'tenant-a']);
        self::assertTrue($found->succeeded());
        self::assertSame('found-user', $found->data['user']['id']);

        $created = (new FusionAuthCreateUser($service))->execute(['body' => ['user' => ['email' => 'agent@example.test']]]);
        self::assertTrue($created->succeeded());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://auth.example.test/api/user?')
                && ($query['email'] ?? null) === 'agent@example.test'
                && $request->hasHeader('X-FusionAuth-TenantId', 'tenant-a');
        });
    }

    public function test_provider_connection_and_named_account_resolution(): void
    {
        Http::fake([
            'https://auth.example.test/api/status' => Http::response(['status' => 'OK'], 200),
            'https://tenant.example.test/api/user*' => Http::response(['user' => ['id' => 'tenant-user']], 200),
        ]);

        $provider = new FusionAuthToolProvider;
        self::assertTrue($provider->testConnection([
            'api_key' => 'fusion-key',
            'base_url' => 'https://auth.example.test',
        ])['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'fusionauth' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_key' => 'tenant-key',
                    'base_url' => 'https://tenant.example.test',
                    'tenant_id' => 'tenant-default',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'fusionauth' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'fusionauth' ? ['work'] : [];
            }
        });

        $tool = $provider->createTool(FusionAuthRetrieveUser::class, ['account' => 'work']);
        $result = $tool->execute(['email' => 'agent@example.test']);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-user', $result->data['user']['id']);
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://tenant.example.test/api/user?')
                && ($query['email'] ?? null) === 'agent@example.test'
                && $request->hasHeader('Authorization', 'tenant-key')
                && $request->hasHeader('X-FusionAuth-TenantId', 'tenant-default');
        });
    }
}
