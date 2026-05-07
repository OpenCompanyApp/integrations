<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Braze;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\Integrations\Braze\BrazeToolProvider;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCatalogItems;
use OpenCompany\Integrations\Braze\Tools\BrazeListCampaigns;
use OpenCompany\Integrations\Braze\Tools\BrazeSendMessages;
use OpenCompany\Integrations\Braze\Tools\BrazeTrackUsers;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Braze endpoint mapping and metadata.
 */
final class BrazeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BrazeService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BrazeService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_bearer_auth_and_region_base_url(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BrazeService(apiKey: 'key-test', baseUrl: 'https://rest.fra-01.braze.eu');
        $service->apiGet('/campaigns/list', ['limit' => 20]);
        $service->apiPost('/users/track', ['attributes' => []]);
        $service->apiPut('/preference_center/v1/prefs', ['name' => 'Prefs']);
        $service->apiDelete('/catalogs/products/items', [], ['items' => [['id' => 'sku-1']]]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer key-test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rest.fra-01.braze.eu/campaigns/list?limit=20');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://rest.fra-01.braze.eu/users/track'
            && $request['attributes'] === []);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://rest.fra-01.braze.eu/preference_center/v1/prefs'
            && $request['name'] === 'Prefs');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://rest.fra-01.braze.eu/catalogs/products/items'
            && $request['items'] === [['id' => 'sku-1']]);
    }

    public function test_tools_shape_query_payload_and_delete_body(): void
    {
        $service = new BrazeService(apiKey: 'key-test');

        Http::fake(['*' => Http::response(['campaigns' => []], 200)]);
        self::assertTrue((new BrazeListCampaigns($service))->execute(['page' => 0, 'limit' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rest.iad-01.braze.com/campaigns/list?page=0&limit=10');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'success'], 200)]);
        self::assertTrue((new BrazeTrackUsers($service))->execute([
            'payload' => ['attributes' => [['external_id' => 'user_123']]],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rest.iad-01.braze.com/users/track'
            && $request['attributes'][0]['external_id'] === 'user_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['dispatch_id' => 'dispatch-123'], 200)]);
        self::assertTrue((new BrazeSendMessages($service))->execute(['payload' => ['messages' => ['email' => ['subject' => 'Hello']]]])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rest.iad-01.braze.com/messages/send'
            && $request['messages']['email']['subject'] === 'Hello');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'success'], 200)]);
        self::assertTrue((new BrazeDeleteCatalogItems($service))->execute([
            'catalog_name' => 'products',
            'payload' => ['items' => [['id' => 'sku-1']]],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://rest.iad-01.braze.com/catalogs/products/items'
            && $request['items'] === [['id' => 'sku-1']]);
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new BrazeToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://www.braze.com/docs/api/basics/', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(110, count($tools));
        self::assertArrayHasKey('braze_track_users', $tools);
        self::assertArrayHasKey('braze_send_messages', $tools);
        self::assertArrayHasKey('braze_list_catalogs', $tools);
        self::assertArrayHasKey('braze_api_get', $tools);

        self::assertSame(['success' => false, 'error' => 'API key is required.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['campaigns' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Braze API at https://rest.example.test.'], $provider->testConnection([
            'api_key' => 'key-test',
            'url' => 'https://rest.example.test',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rest.example.test/campaigns/list?limit=1&page=0');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['campaigns' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['braze', 'api_key', 'eu'] => 'account-key',
                    ['braze', 'url', 'eu'] => 'https://rest.fra-01.braze.eu',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'braze' && $account === 'eu';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'braze' ? ['eu'] : [];
            }
        });

        $tool = $provider->createTool(BrazeListCampaigns::class, ['account' => 'eu']);
        self::assertTrue($tool->execute(['limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rest.fra-01.braze.eu/campaigns/list?limit=1'
            && $request->hasHeader('Authorization', 'Bearer account-key'));
    }
}
