<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Directus;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Directus\DirectusOperations;
use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\Integrations\Directus\DirectusToolProvider;
use OpenCompany\Integrations\Directus\Tools\DirectusCreateItem;
use OpenCompany\Integrations\Directus\Tools\DirectusGetCurrentUser;
use OpenCompany\Integrations\Directus\Tools\DirectusGetItem;
use OpenCompany\Integrations\Directus\Tools\DirectusListItems;
use OpenCompany\Integrations\Directus\Tools\DirectusPing;
use PHPUnit\Framework\TestCase;

final class DirectusServiceTest extends TestCase
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

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new DirectusToolProvider;

        self::assertSame('directus', $provider->appName());
        self::assertSame('Directus', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.directus.io/reference/introduction', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://unpkg.com/@directus/specs@13.0.0/dist/openapi.json', $provider->integrationMeta()['source_url']);
        self::assertCount(133, DirectusOperations::all());
        self::assertCount(133, $provider->tools());
        self::assertArrayHasKey('directus_list_items', $provider->tools());
        self::assertArrayHasKey('directus_get_item', $provider->tools());
        self::assertArrayHasKey('directus_create_item', $provider->tools());
        self::assertArrayHasKey('directus_update_item', $provider->tools());
        self::assertArrayHasKey('directus_delete_item', $provider->tools());
        self::assertArrayHasKey('directus_list_collections', $provider->tools());
        self::assertArrayHasKey('directus_get_current_user', $provider->tools());
        self::assertArrayHasKey('directus_get_content_versions', $provider->tools());
        self::assertArrayHasKey('directus_schema_snapshot', $provider->tools());
    }

    public function test_service_maps_common_directus_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://directus.example.test/items/articles/example-id' => Http::response(['data' => ['id' => 'example-id']], 200),
            'https://directus.example.test/items/articles*' => Http::response(['data' => [['id' => 1]]], 200),
            'https://directus.example.test/collections' => Http::response(['data' => [['collection' => 'articles']]], 200),
            'https://directus.example.test/users/me' => Http::response(['data' => ['email' => 'agent@example.test']], 200),
        ]);

        $service = new DirectusService(accessToken: 'directus-token', baseUrl: 'https://directus.example.test');

        self::assertSame(['data' => [['id' => 1]]], $service->listItems('articles', ['limit' => 5]));
        self::assertSame(['data' => ['id' => 'example-id']], $service->getItem('articles', 'example-id'));
        self::assertSame(['data' => [['id' => 1]]], $service->createItem('articles', ['title' => 'Example']));
        self::assertSame(['data' => [['collection' => 'articles']]], $service->listCollections());
        self::assertSame(['data' => ['email' => 'agent@example.test']], $service->getCurrentUser());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://directus.example.test/items/articles?')
                && ($query['limit'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer directus-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://directus.example.test/items/articles'
            && $request['title'] === 'Example');
    }

    public function test_generated_tools_map_path_query_and_loose_body_arguments(): void
    {
        Http::fake([
            'https://directus.example.test/items/articles/example-id' => Http::response(['data' => ['id' => 'example-id']], 200),
            'https://directus.example.test/items/articles*' => Http::response(['data' => [['id' => 1]]], 200),
        ]);

        $service = new DirectusService(accessToken: 'directus-token', baseUrl: 'https://directus.example.test');
        $get = new DirectusGetItem($service);

        $success = $get->execute(['collection' => 'articles', 'id' => 'example-id']);
        self::assertTrue($success->succeeded());
        self::assertSame('example-id', $success->data['data']['id']);

        $missing = $get->execute(['collection' => 'articles']);
        self::assertFalse($missing->succeeded());
        self::assertSame('The id parameter is required.', $missing->error);

        $list = new DirectusListItems($service);
        $listed = $list->execute(['collection' => 'articles', 'limit' => 3]);
        self::assertTrue($listed->succeeded());
        self::assertSame(1, $listed->data['data'][0]['id']);

        $create = new DirectusCreateItem($service);
        $created = $create->execute([
            'collection' => 'articles',
            'title' => 'Loose Body',
            'status' => 'draft',
        ]);
        self::assertTrue($created->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://directus.example.test/items/articles/example-id');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://directus.example.test/items/articles?')
                && ($query['limit'] ?? null) === '3';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://directus.example.test/items/articles'
            && $request['title'] === 'Loose Body'
            && $request['status'] === 'draft');
    }

    public function test_public_ping_operation_can_run_without_token(): void
    {
        Http::fake([
            'https://directus.example.test/server/ping' => Http::response('pong', 200, ['Content-Type' => 'text/plain']),
        ]);

        $tool = new DirectusPing(new DirectusService(baseUrl: 'https://directus.example.test'));
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('pong', $result->data['body']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://directus.example.test/server/ping'
            && !$request->hasHeader('Authorization'));
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-directus.example.test/users/me' => Http::response(['data' => ['email' => 'tenant@example.test']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'directus' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-directus-token',
                    'url' => 'https://tenant-directus.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'directus' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'directus' ? ['work'] : [];
            }
        });

        $tool = (new DirectusToolProvider)->createTool(DirectusGetCurrentUser::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant@example.test', $result->data['data']['email']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-directus.example.test/users/me'
            && $request->hasHeader('Authorization', 'Bearer tenant-directus-token'));
    }
}
