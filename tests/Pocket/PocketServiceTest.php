<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Pocket;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Pocket\PocketService;
use OpenCompany\Integrations\Pocket\PocketToolProvider;
use OpenCompany\Integrations\Pocket\Tools\PocketAddItem;
use OpenCompany\Integrations\Pocket\Tools\PocketApiPost;
use OpenCompany\Integrations\Pocket\Tools\PocketArchiveItem;
use OpenCompany\Integrations\Pocket\Tools\PocketAuthorizeUrl;
use OpenCompany\Integrations\Pocket\Tools\PocketRetrieveItems;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Pocket v3 API.
 */
final class PocketServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PocketService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PocketService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new PocketToolProvider();

        self::assertSame('pocket', $provider->appName());
        self::assertSame('Pocket', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_variant', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(18, $provider->tools());
        self::assertArrayHasKey('pocket_request_token', $provider->tools());
        self::assertArrayHasKey('pocket_retrieve_items', $provider->tools());
        self::assertArrayHasKey('pocket_send_actions', $provider->tools());
        self::assertArrayHasKey('pocket_rename_tag', $provider->tools());
        self::assertArrayHasKey('pocket_api_post', $provider->tools());
    }

    public function test_service_maps_oauth_add_retrieve_and_modify_endpoints(): void
    {
        Http::fake(['https://pocket.test/*' => Http::response(['status' => 1], 200)]);

        $service = new PocketService('consumer-key', 'access-token', 'https://pocket.test');
        $requestToken = $service->requestToken(['redirect_uri' => 'https://example.test/callback', 'state' => 'abc']);
        $authorize = $service->authorizeUrl('request-code', 'https://example.test/callback', ['mobile' => 1]);
        $accessToken = $service->accessToken(['code' => 'request-code']);
        $add = $service->add(['url' => 'https://example.test/article', 'title' => 'Article']);
        $retrieve = $service->retrieve(['state' => 'unread', 'count' => 30, 'detailType' => 'complete']);
        $send = $service->sendActions([
            ['action' => 'archive', 'item_id' => '229279689'],
            ['action' => 'favorite', 'item_id' => '229279690'],
        ]);
        $rename = $service->sendAction('tag_rename', ['old_tag' => 'old', 'new_tag' => 'new']);
        $raw = $service->apiPost('/v3/get', ['count' => 10]);

        self::assertSame(1, $requestToken['status']);
        self::assertStringStartsWith('https://pocket.test/auth/authorize?', $authorize['url']);
        self::assertStringContainsString('request_token=request-code', $authorize['url']);
        self::assertSame(1, $accessToken['status']);
        self::assertSame(1, $add['status']);
        self::assertSame(1, $retrieve['status']);
        self::assertSame(1, $send['status']);
        self::assertSame(1, $rename['status']);
        self::assertSame(1, $raw['status']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Accept', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pocket.test/v3/oauth/request'
            && $request->data()['consumer_key'] === 'consumer-key'
            && $request->data()['redirect_uri'] === 'https://example.test/callback');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pocket.test/v3/oauth/authorize'
            && $request->data()['consumer_key'] === 'consumer-key'
            && $request->data()['code'] === 'request-code');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pocket.test/v3/add'
            && $request->data()['consumer_key'] === 'consumer-key'
            && $request->data()['access_token'] === 'access-token'
            && $request->data()['url'] === 'https://example.test/article');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pocket.test/v3/get'
            && ($request->data()['state'] ?? null) === 'unread'
            && ($request->data()['detailType'] ?? null) === 'complete');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pocket.test/v3/send'
            && ($request->data()['actions'][0]['action'] ?? null) === 'archive'
            && ($request->data()['actions'][1]['action'] ?? null) === 'favorite');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pocket.test/v3/send'
            && ($request->data()['actions'][0]['action'] ?? null) === 'tag_rename'
            && ($request->data()['actions'][0]['old_tag'] ?? null) === 'old');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://pocket.test/v3/get'
            && ($request->data()['count'] ?? null) === 10
            && $request->data()['consumer_key'] === 'consumer-key');
    }

    public function test_tools_validate_arguments_paths_and_configuration(): void
    {
        Http::fake(['https://pocket.test/*' => Http::response(['status' => 1], 200)]);

        $service = new PocketService('consumer-key', 'access-token', 'https://pocket.test');

        self::assertTrue((new PocketAuthorizeUrl($service))->execute([
            'request_token' => 'request-code',
            'redirect_uri' => 'https://example.test/callback',
        ])->succeeded());
        self::assertTrue((new PocketAddItem($service))->execute([
            'url' => 'https://example.test/article',
            'payload' => ['tags' => 'research'],
        ])->succeeded());
        self::assertTrue((new PocketRetrieveItems($service))->execute(['payload' => ['count' => 5]])->succeeded());
        self::assertTrue((new PocketArchiveItem($service))->execute(['item_id' => '229279689'])->succeeded());

        $missing = (new PocketAddItem($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('url is required', (string) $missing->error);

        $badRaw = (new PocketApiPost($service))->execute(['path' => 'https://evil.example.test/v3/get']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new PocketApiPost(new PocketService('', '', 'https://pocket.test')))->execute(['path' => '/v3/get']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new PocketToolProvider();

        self::assertSame(['success' => false, 'error' => 'Pocket consumer key is required.'], $provider->testConnection([]));
        self::assertSame(['success' => false, 'error' => 'Pocket access token is required.'], $provider->testConnection(['consumer_key' => 'consumer-key']));

        Http::fake(['https://getpocket.com/v3/get' => Http::response(['status' => 1, 'list' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Pocket API.'], $provider->testConnection([
            'consumer_key' => 'consumer-key',
            'access_token' => 'access-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.pocket.test/v3/get' => Http::response(['status' => 1, 'list' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['pocket', 'consumer_key', 'ops'] => 'account-key',
                    ['pocket', 'access_token', 'ops'] => 'account-token',
                    ['pocket', 'url', 'ops'] => 'https://ops.pocket.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'pocket' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'pocket' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(PocketRetrieveItems::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.pocket.test/v3/get'
            && $request->data()['consumer_key'] === 'account-key'
            && $request->data()['access_token'] === 'account-token');
    }
}
