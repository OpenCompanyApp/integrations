<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Instapaper;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Instapaper\InstapaperService;
use OpenCompany\Integrations\Instapaper\InstapaperToolProvider;
use OpenCompany\Integrations\Instapaper\Tools\InstapaperAddBookmark;
use OpenCompany\Integrations\Instapaper\Tools\InstapaperApiPost;
use OpenCompany\Integrations\Instapaper\Tools\InstapaperGetAccessToken;
use OpenCompany\Integrations\Instapaper\Tools\InstapaperListFolders;
use OpenCompany\Integrations\Instapaper\Tools\InstapaperSimpleAddUrl;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Instapaper Full API and Simple API.
 */
final class InstapaperServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(InstapaperService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(InstapaperService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new InstapaperToolProvider();

        self::assertSame('instapaper', $provider->appName());
        self::assertSame('Instapaper', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth1', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(22, $provider->tools());
        self::assertCount(21, InstapaperService::operations());
        self::assertArrayHasKey('instapaper_get_access_token', $provider->tools());
        self::assertArrayHasKey('instapaper_get_bookmark_text', $provider->tools());
        self::assertArrayHasKey('instapaper_simple_add_url', $provider->tools());
        self::assertArrayHasKey('instapaper_api_post', $provider->tools());
    }

    public function test_service_maps_documented_full_api_endpoints_with_oauth_headers(): void
    {
        Http::fake([
            'https://instapaper.test/api/1/bookmarks/get_text' => Http::response('<article>Readable</article>', 200),
            'https://instapaper.test/*' => Http::response(['type' => 'ok'], 200),
        ]);

        $service = new InstapaperService('ckey', 'csecret', 'otoken', 'osecret', baseUrl: 'https://instapaper.test');
        $service->call('verify_credentials');
        $service->call('list_bookmarks', ['folder_id' => 'unread', 'limit' => 5]);
        $service->call('update_read_progress', ['bookmark_id' => '100', 'progress' => '0.5']);
        $service->call('add_bookmark', ['url' => 'https://example.test/article', 'title' => 'Example']);
        $service->call('delete_bookmark', ['bookmark_id' => '100']);
        $service->call('star_bookmark', ['bookmark_id' => '100']);
        $service->call('unstar_bookmark', ['bookmark_id' => '100']);
        $service->call('archive_bookmark', ['bookmark_id' => '100']);
        $service->call('unarchive_bookmark', ['bookmark_id' => '100']);
        $service->call('move_bookmark', ['bookmark_id' => '100', 'folder_id' => '200']);
        $text = $service->call('get_bookmark_text', ['bookmark_id' => '100']);
        $service->call('list_folders');
        $service->call('add_folder', ['title' => 'Research']);
        $service->call('delete_folder', ['folder_id' => '200']);
        $service->call('set_folder_order', ['folder_ids' => '200,201']);
        $service->call('list_highlights', ['bookmark_id' => '100']);
        $service->call('create_highlight', ['bookmark_id' => '100', 'text' => 'Important']);
        $service->call('delete_highlight', ['highlight_id' => '300']);
        $service->apiPost('/api/1/bookmarks/list', ['limit' => 10]);

        self::assertSame('<article>Readable</article>', $text['value']);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization')
            && str_starts_with($request->header('Authorization')[0], 'OAuth ')
            && str_contains($request->header('Authorization')[0], 'oauth_consumer_key="ckey"')
            && str_contains($request->header('Authorization')[0], 'oauth_token="otoken"')
            && str_contains($request->header('Authorization')[0], 'oauth_signature_method="HMAC-SHA1"'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://instapaper.test/api/1/account/verify_credentials');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://instapaper.test/api/1/bookmarks/list' && ($request->data()['folder_id'] ?? null) === 'unread');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://instapaper.test/api/1/bookmarks/add' && $request->data()['url'] === 'https://example.test/article');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://instapaper.test/api/1/bookmarks/move' && $request->data()['folder_id'] === '200');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://instapaper.test/api/1/folders/add' && $request->data()['title'] === 'Research');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://instapaper.test/api/1.1/bookmarks/100/highlights');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://instapaper.test/api/1.1/bookmarks/100/highlight' && $request->data()['text'] === 'Important');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://instapaper.test/api/1.1/highlights/300/delete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://instapaper.test/api/1/bookmarks/list' && ($request->data()['limit'] ?? null) === 10);
    }

    public function test_xauth_and_simple_api_behaviour(): void
    {
        Http::fake([
            'https://instapaper.test/api/1/oauth/access_token' => Http::response('oauth_token=tok&oauth_token_secret=sec', 200),
            'https://instapaper.test/api/authenticate' => Http::response('', 200),
            'https://instapaper.test/api/add' => Http::response('201', 201),
        ]);

        $service = new InstapaperService('ckey', 'csecret', simpleUsername: 'reader@example.test', simplePassword: 'fake-password', baseUrl: 'https://instapaper.test');

        $token = $service->call('get_access_token', ['x_auth_username' => 'reader@example.test', 'x_auth_password' => 'fake-password']);
        $auth = $service->call('simple_authenticate');
        $saved = $service->call('simple_add_url', ['url' => 'https://example.test/post', 'title' => 'Post']);

        self::assertSame('tok', $token['oauth_token']);
        self::assertSame('sec', $token['oauth_token_secret']);
        self::assertTrue($auth['success']);
        self::assertSame(201, $saved['status']);
        self::assertSame('201', $saved['value']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://instapaper.test/api/1/oauth/access_token'
            && str_contains($request->header('Authorization')[0], 'oauth_consumer_key="ckey"')
            && !str_contains($request->header('Authorization')[0], 'oauth_token=')
            && $request->data()['x_auth_mode'] === 'client_auth');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://instapaper.test/api/add'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('reader@example.test:fake-password'))
            && $request->data()['url'] === 'https://example.test/post');
    }

    public function test_tools_validate_required_values_paths_and_configuration(): void
    {
        Http::fake(['https://instapaper.test/*' => Http::response(['ok' => true], 200)]);

        $service = new InstapaperService('ckey', 'csecret', 'otoken', 'osecret', 'reader@example.test', 'fake-password', 'https://instapaper.test');

        self::assertTrue((new InstapaperAddBookmark($service))->execute([
            'url' => 'https://example.test/article',
            'payload' => ['title' => 'Example'],
        ])->succeeded());
        self::assertTrue((new InstapaperSimpleAddUrl($service))->execute(['url' => 'https://example.test/post'])->succeeded());
        self::assertTrue((new InstapaperGetAccessToken(new InstapaperService('ckey', 'csecret', baseUrl: 'https://instapaper.test')))
            ->execute(['x_auth_username' => 'reader@example.test', 'x_auth_password' => 'fake-password'])->succeeded());

        $badRaw = (new InstapaperApiPost($service))->execute(['path' => 'https://evil.example.test/api/1/bookmarks/list']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new InstapaperApiPost(new InstapaperService('', '', '', '', baseUrl: 'https://instapaper.test')))->execute(['path' => '/api/1/bookmarks/list']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new InstapaperToolProvider();

        self::assertSame(['success' => false, 'error' => 'Instapaper consumer_key is required.'], $provider->testConnection([]));

        Http::fake(['https://www.instapaper.com/api/1/account/verify_credentials' => Http::response(['username' => 'reader'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Instapaper API.'], $provider->testConnection([
            'consumer_key' => 'ckey',
            'consumer_secret' => 'csecret',
            'oauth_token' => 'otoken',
            'oauth_token_secret' => 'osecret',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.instapaper.test/api/1/folders/list' => Http::response([['folder_id' => '200']], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['instapaper', 'consumer_key', 'ops'] => 'account-key',
                    ['instapaper', 'consumer_secret', 'ops'] => 'account-secret',
                    ['instapaper', 'oauth_token', 'ops'] => 'account-token',
                    ['instapaper', 'oauth_token_secret', 'ops'] => 'account-token-secret',
                    ['instapaper', 'url', 'ops'] => 'https://ops.instapaper.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'instapaper' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'instapaper' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(InstapaperListFolders::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.instapaper.test/api/1/folders/list'
            && str_contains($request->header('Authorization')[0], 'oauth_consumer_key="account-key"')
            && str_contains($request->header('Authorization')[0], 'oauth_token="account-token"'));
    }
}
