<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Logto;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Logto\LogtoOperations;
use OpenCompany\Integrations\Logto\LogtoService;
use OpenCompany\Integrations\Logto\LogtoToolProvider;
use OpenCompany\Integrations\Logto\Tools\LogtoCreateUser;
use OpenCompany\Integrations\Logto\Tools\LogtoGetUser;
use OpenCompany\Integrations\Logto\Tools\LogtoListUsers;
use PHPUnit\Framework\TestCase;

final class LogtoServiceTest extends TestCase
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
        $provider = new LogtoToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/logto/logto-openapi-manifest.json'), true);

        self::assertSame('logto', $provider->appName());
        self::assertSame('Logto', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://openapi.logto.io/source.json', $provider->integrationMeta()['source_url']);
        self::assertSame(335, $manifest['method_count']);
        self::assertCount($manifest['method_count'], LogtoOperations::all());
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('oauth_client_credentials', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertArrayHasKey('logto_list_users', $provider->tools());
        self::assertArrayHasKey('logto_create_user', $provider->tools());
        self::assertArrayHasKey('logto_get_application', $provider->tools());
        self::assertArrayHasKey('logto_list_organizations', $provider->tools());
    }

    public function test_service_exchanges_client_credentials_and_maps_path_query_and_body(): void
    {
        Http::fake(static function (Request $request) {
            if ($request->url() === 'https://tenant.example.test/oidc/token') {
                return Http::response(['access_token' => 'logto-token', 'token_type' => 'Bearer', 'expires_in' => 3600, 'scope' => 'all'], 200);
            }

            if (str_starts_with($request->url(), 'https://tenant.example.test/api/users/user%201')) {
                return Http::response(['id' => 'user 1'], 200);
            }

            if ($request->method() === 'POST' && $request->url() === 'https://tenant.example.test/api/users') {
                return Http::response(['id' => 'created-user'], 201);
            }

            return Http::response([['id' => 'user-1']], 200);
        });

        $service = new LogtoService(clientId: 'client-id', clientSecret: 'secret', baseUrl: 'https://tenant.example.test');

        self::assertSame([['id' => 'user-1']], $service->executeOperation(LogtoOperations::all()['logto_list_users'], [
            'page' => 2,
            'page_size' => 50,
        ]));
        self::assertSame(['id' => 'created-user'], $service->executeOperation(LogtoOperations::all()['logto_create_user'], [
            'body' => ['primaryEmail' => 'agent@example.test', 'name' => 'Agent Test'],
        ]));
        self::assertSame(['id' => 'user 1'], $service->executeOperation(LogtoOperations::all()['logto_get_user'], [
            'user_id' => 'user 1',
            'include_sso_identities' => 'true',
        ]));

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant.example.test/oidc/token'
            && $request['grant_type'] === 'client_credentials'
            && $request['client_id'] === 'client-id'
            && $request['client_secret'] === 'secret'
            && $request['resource'] === 'https://tenant.example.test/api'
            && $request['scope'] === 'all');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://tenant.example.test/api/users?')
                && ($query['page'] ?? null) === '2'
                && ($query['page_size'] ?? null) === '50'
                && $request->hasHeader('Authorization', 'Bearer logto-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://tenant.example.test/api/users'
            && $request['primaryEmail'] === 'agent@example.test'
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://tenant.example.test/api/users/user%201?')
                && ($query['includeSsoIdentities'] ?? null) === 'true';
        });
    }

    public function test_generated_tools_validate_and_map_arguments(): void
    {
        Http::fake([
            'https://tenant.example.test/api/users/user-1*' => Http::response(['id' => 'user-1'], 200),
            'https://tenant.example.test/api/users*' => Http::response([['id' => 'user-1']], 200),
        ]);

        $service = new LogtoService(accessToken: 'direct-token', baseUrl: 'https://tenant.example.test');

        $detail = new LogtoGetUser($service);
        $missing = $detail->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('user_id must be a non-empty parameter.', $missing->error);

        $success = $detail->execute(['user_id' => 'user-1']);
        self::assertTrue($success->succeeded());
        self::assertSame('user-1', $success->data['id']);

        $list = (new LogtoListUsers($service))->execute(['page' => 1]);
        self::assertTrue($list->succeeded());
        self::assertSame('user-1', $list->data[0]['id']);

        $created = (new LogtoCreateUser($service))->execute(['body' => ['primaryEmail' => 'agent@example.test']]);
        self::assertTrue($created->succeeded());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://tenant.example.test/api/users?')
                && ($query['page'] ?? null) === '1'
                && $request->hasHeader('Authorization', 'Bearer direct-token');
        });
    }

    public function test_provider_connection_and_named_account_resolution(): void
    {
        Http::fake([
            'https://tenant.example.test/api/applications' => Http::response([['id' => 'app-1']], 200),
            'https://work.example.test/api/users*' => Http::response([['id' => 'work-user']], 200),
        ]);

        $provider = new LogtoToolProvider;
        self::assertTrue($provider->testConnection([
            'access_token' => 'direct-token',
            'base_url' => 'https://tenant.example.test',
        ])['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'logto' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'work-token',
                    'base_url' => 'https://work.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'logto' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'logto' ? ['work'] : [];
            }
        });

        $tool = $provider->createTool(LogtoListUsers::class, ['account' => 'work']);
        $result = $tool->execute(['page_size' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame('work-user', $result->data[0]['id']);
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://work.example.test/api/users?')
                && ($query['page_size'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer work-token');
        });
    }
}
