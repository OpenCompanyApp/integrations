<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Bitwarden;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Bitwarden\BitwardenOperations;
use OpenCompany\Integrations\Bitwarden\BitwardenService;
use OpenCompany\Integrations\Bitwarden\BitwardenToolProvider;
use OpenCompany\Integrations\Bitwarden\Tools\BitwardenCollectionsGet;
use OpenCompany\Integrations\Bitwarden\Tools\BitwardenEventsList;
use OpenCompany\Integrations\Bitwarden\Tools\BitwardenMembersList;
use PHPUnit\Framework\TestCase;

final class BitwardenServiceTest extends TestCase
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
        $provider = new BitwardenToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/bitwarden/bitwarden-openapi-manifest.json'), true);

        self::assertSame('bitwarden', $provider->appName());
        self::assertSame('Bitwarden', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://bitwarden.com/help/api/', $provider->integrationMeta()['source_url']);
        self::assertSame(28, $manifest['method_count']);
        self::assertCount($manifest['method_count'], BitwardenOperations::all());
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('oauth_client_credentials', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertArrayHasKey('bitwarden_collections_list', $provider->tools());
        self::assertArrayHasKey('bitwarden_events_list', $provider->tools());
        self::assertArrayHasKey('bitwarden_members_revoke', $provider->tools());
        self::assertArrayHasKey('bitwarden_policies_put', $provider->tools());
    }

    public function test_service_exchanges_client_credentials_and_maps_path_query_and_body(): void
    {
        Http::fake([
            'https://identity.example.test/connect/token' => Http::response(['access_token' => 'token-123', 'expires_in' => 3600, 'token_type' => 'Bearer'], 200),
            'https://api.example.test/public/collections/col%201' => Http::response(['id' => 'col 1'], 200),
            'https://api.example.test/public/events*' => Http::response(['object' => 'list', 'data' => [['type' => 1000]], 'continuationToken' => 'next'], 200),
        ]);

        $service = new BitwardenService(
            clientId: 'organization.client',
            clientSecret: 'secret',
            baseUrl: 'https://api.example.test',
            identityUrl: 'https://identity.example.test/connect/token',
        );

        self::assertSame(['id' => 'col 1'], $service->request('PUT', '/public/collections/{id}', ['id' => 'col 1'], [], [], ['externalId' => 'external-1']));
        self::assertSame(['object' => 'list', 'data' => [['type' => 1000]], 'continuationToken' => 'next'], $service->request('GET', '/public/events', [], [
            'start' => '2026-01-01T00:00:00Z',
            'continuationToken' => 'next',
        ]));

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://identity.example.test/connect/token'
            && $request['grant_type'] === 'client_credentials'
            && $request['scope'] === 'api.organization'
            && $request['client_id'] === 'organization.client'
            && $request['client_secret'] === 'secret');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/public/collections/col%201'
            && $request->hasHeader('Authorization', 'Bearer token-123')
            && $request['externalId'] === 'external-1');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://api.example.test/public/events?')
                && ($query['start'] ?? null) === '2026-01-01T00:00:00Z'
                && ($query['continuationToken'] ?? null) === 'next';
        });
    }

    public function test_generated_tools_validate_and_map_arguments(): void
    {
        Http::fake([
            'https://api.example.test/public/collections/abc' => Http::response(['id' => 'abc'], 200),
            'https://api.example.test/public/events*' => Http::response(['data' => [['type' => 1000]]], 200),
        ]);

        $service = new BitwardenService(accessToken: 'direct-token', baseUrl: 'https://api.example.test');

        $get = new BitwardenCollectionsGet($service);
        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('id must be a non-empty parameter.', $missing->error);

        $success = $get->execute(['id' => 'abc']);
        self::assertTrue($success->succeeded());
        self::assertSame('abc', $success->data['id']);

        $events = (new BitwardenEventsList($service))->execute(['acting_user_id' => 'user-1']);
        self::assertTrue($events->succeeded());
        self::assertSame(1000, $events->data['data'][0]['type']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://api.example.test/public/events?')
                && ($query['actingUserId'] ?? null) === 'user-1'
                && $request->hasHeader('Authorization', 'Bearer direct-token');
        });
    }

    public function test_provider_connection_and_named_account_resolution(): void
    {
        Http::fake([
            'https://api.example.test/public/organization/subscription' => Http::response(['plan' => 'enterprise'], 200),
            'https://tenant.example.test/public/members' => Http::response(['data' => [['id' => 'member-1']]], 200),
        ]);

        $provider = new BitwardenToolProvider;
        self::assertTrue($provider->testConnection([
            'access_token' => 'direct-token',
            'api_url' => 'https://api.example.test',
        ])['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'bitwarden' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-token',
                    'api_url' => 'https://tenant.example.test',
                    'identity_url' => 'https://identity.example.test/connect/token',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'bitwarden' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'bitwarden' ? ['work'] : [];
            }
        });

        $tool = $provider->createTool(BitwardenMembersList::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('member-1', $result->data['data'][0]['id']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant.example.test/public/members'
            && $request->hasHeader('Authorization', 'Bearer tenant-token'));
    }
}
