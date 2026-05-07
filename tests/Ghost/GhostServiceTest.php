<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Ghost;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Ghost\GhostService;
use OpenCompany\Integrations\Ghost\GhostToolProvider;
use OpenCompany\Integrations\Ghost\Tools\GhostApiGet;
use OpenCompany\Integrations\Ghost\Tools\GhostCreateTag;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Ghost Admin API integration.
 */
final class GhostServiceTest extends TestCase
{
    private string $apiKey = 'kid123:0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef';

    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(GhostService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(GhostService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new GhostToolProvider;

        self::assertSame('ghost', $provider->appName());
        self::assertSame('Ghost CMS', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(42, $provider->tools());
        self::assertArrayHasKey('ghost_delete_post', $provider->tools());
        self::assertArrayHasKey('ghost_create_page', $provider->tools());
        self::assertArrayHasKey('ghost_list_tiers', $provider->tools());
        self::assertArrayHasKey('ghost_list_webhooks', $provider->tools());
        self::assertArrayHasKey('ghost_api_delete', $provider->tools());
    }

    public function test_service_maps_content_members_monetization_webhook_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GhostService($this->apiKey, 'https://example.test/ghost/api/admin');
        $service->listPosts(['limit' => 5, 'include' => 'tags,authors']);
        $service->createPost(['title' => 'Hello']);
        $service->updatePage('page-1', ['title' => 'Updated', 'updated_at' => '2026-01-01T00:00:00.000Z']);
        $service->createTag(['name' => 'News']);
        $service->updateMember('member-1', ['name' => 'Ada']);
        $service->listTiers(['limit' => 'all']);
        $service->createOffer(['name' => 'Launch']);
        $service->listNewsletters(['limit' => 10]);
        $service->createWebhook(['event' => 'post.published', 'target_url' => 'https://example.invalid/hook']);
        $service->getSite();
        $service->apiGet('/posts', ['include' => ['tags', 'authors']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/ghost/api/admin/posts?limit=5&include=tags%2Cauthors'
            && str_starts_with((string) ($request->header('Authorization')[0] ?? ''), 'Ghost ')
            && $request->hasHeader('Accept-Version', 'v5.0'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/ghost/api/admin/posts'
            && $request['posts'][0]['title'] === 'Hello');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://example.test/ghost/api/admin/pages/page-1'
            && $request['pages'][0]['title'] === 'Updated');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/ghost/api/admin/tags'
            && $request['tags'][0]['name'] === 'News');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://example.test/ghost/api/admin/members/member-1'
            && $request['members'][0]['name'] === 'Ada');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/ghost/api/admin/tiers?limit=all');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/ghost/api/admin/webhooks'
            && $request['webhooks'][0]['event'] === 'post.published');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/ghost/api/admin/site');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/ghost/api/admin/posts?include=tags&include=authors');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/posts');
    }

    public function test_jwt_header_contains_key_id(): void
    {
        Http::fake(['*' => Http::response(['users' => []], 200)]);

        (new GhostService($this->apiKey, 'https://example.test/ghost/api/admin'))->getCurrentUser();

        Http::assertSent(function (Request $request): bool {
            $header = (string) ($request->header('Authorization')[0] ?? '');
            $token = str_replace('Ghost ', '', $header);
            $parts = explode('.', $token);
            $jwtHeader = json_decode(base64_decode(strtr($parts[0] ?? '', '-_', '+/')), true);

            return ($jwtHeader['kid'] ?? null) === 'kid123'
                && ($jwtHeader['alg'] ?? null) === 'HS256';
        });
    }

    public function test_tools_validate_arguments_and_unconfigured_service(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GhostService($this->apiKey, 'https://example.test/ghost/api/admin');
        $tag = (new GhostCreateTag($service))->execute(['tag' => ['name' => 'News']]);
        $raw = (new GhostApiGet($service))->execute(['path' => '/posts']);

        self::assertTrue($tag->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new GhostApiGet($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('path is required', (string) $missing->error);

        $unconfigured = (new GhostApiGet(new GhostService('', '')))->execute(['path' => '/posts']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }
}
