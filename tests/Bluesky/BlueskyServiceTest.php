<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Bluesky;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Bluesky\BlueskyService;
use OpenCompany\Integrations\Bluesky\BlueskyToolProvider;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetPosts;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyLikePost;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyXrpcGet;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Bluesky XRPC endpoint mappings.
 */
final class BlueskyServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_common_views_records_and_generic_xrpc(): void
    {
        Http::fake([
            'https://bsky.test/xrpc/*' => Http::response(['ok' => true, 'uri' => 'at://did:plc:me/app.bsky.feed.post/rkey', 'cid' => 'cid_123'], 200),
        ]);

        $service = new BlueskyService('token_123', 'https://bsky.test', 'did:plc:me');

        $service->getTimeline(10);
        $service->getAuthorFeed('alice.bsky.social', 11, filter: 'posts_no_replies');
        $service->getFeed('at://did:plc:feed/app.bsky.feed.generator/main', 12);
        $service->getFeedGenerator('at://did:plc:feed/app.bsky.feed.generator/main');
        $service->getPostThread('at://did:plc:alice/app.bsky.feed.post/abc', 3, 1);
        $service->getPosts(['at://did:plc:alice/app.bsky.feed.post/abc', 'at://did:plc:bob/app.bsky.feed.post/def']);
        $service->getLikes('at://did:plc:alice/app.bsky.feed.post/abc', 'cid_abc', 13);
        $service->getRepostedBy('at://did:plc:alice/app.bsky.feed.post/abc', 'cid_abc', 14);
        $service->listNotifications(15);
        $service->likePost('at://did:plc:alice/app.bsky.feed.post/abc', 'cid_abc');
        $service->repostPost('at://did:plc:alice/app.bsky.feed.post/abc', 'cid_abc');
        $service->followActor('did:plc:alice');
        $service->deleteRecord('app.bsky.feed.post', 'abc');
        $service->xrpcGet('app.bsky.actor.searchActors', ['q' => 'alice']);
        $service->xrpcPost('com.atproto.repo.applyWrites', ['repo' => 'did:plc:me', 'writes' => []]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer token_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://bsky.test/xrpc/app.bsky.feed.getTimeline?') && str_contains($request->url(), 'limit=10'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getAuthorFeed') && str_contains($request->url(), 'filter=posts_no_replies'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getFeed?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getFeedGenerator?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getPostThread?') && str_contains($request->url(), 'parentHeight=1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getPosts?') && substr_count($request->url(), 'uris=') === 2);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getLikes?') && str_contains($request->url(), 'limit=13'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getRepostedBy?') && str_contains($request->url(), 'limit=14'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.notification.listNotifications?') && str_contains($request->url(), 'limit=15'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://bsky.test/xrpc/com.atproto.repo.createRecord' && $request['repo'] === 'did:plc:me' && $request['collection'] === 'app.bsky.feed.like');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://bsky.test/xrpc/com.atproto.repo.createRecord' && $request['collection'] === 'app.bsky.feed.repost');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://bsky.test/xrpc/com.atproto.repo.createRecord' && $request['collection'] === 'app.bsky.graph.follow');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://bsky.test/xrpc/com.atproto.repo.deleteRecord' && $request['rkey'] === 'abc');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.actor.searchActors?') && str_contains($request->url(), 'q=alice'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://bsky.test/xrpc/com.atproto.repo.applyWrites');
    }

    public function test_tools_delegate_to_new_service_methods(): void
    {
        Http::fake([
            'https://bsky.test/xrpc/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new BlueskyService('token_123', 'https://bsky.test', 'did:plc:me');

        self::assertNull((new BlueskyGetPosts($service))->execute([
            'uris' => ['at://did:plc:alice/app.bsky.feed.post/abc'],
        ])->error);
        self::assertNull((new BlueskyLikePost($service))->execute([
            'uri' => 'at://did:plc:alice/app.bsky.feed.post/abc',
            'cid' => 'cid_abc',
        ])->error);
        self::assertNull((new BlueskyXrpcGet($service))->execute([
            'method' => 'app.bsky.actor.searchActors',
            'params' => ['q' => 'alice'],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.feed.getPosts?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://bsky.test/xrpc/com.atproto.repo.createRecord' && $request['collection'] === 'app.bsky.feed.like');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), 'app.bsky.actor.searchActors?'));
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://bsky.social/xrpc/app.bsky.actor.getProfile*' => Http::response(['handle' => 'alice.bsky.social'], 200),
        ]);

        $provider = new BlueskyToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('bluesky_get_timeline', $tools);
        self::assertArrayHasKey('bluesky_get_post_thread', $tools);
        self::assertArrayHasKey('bluesky_like_post', $tools);
        self::assertArrayHasKey('bluesky_xrpc_get', $tools);
        self::assertArrayHasKey('bluesky_xrpc_post', $tools);
        self::assertSame(22, count($tools));
        self::assertTrue($provider->testConnection(['access_token' => 'token_123', 'did' => 'did:plc:alice'])['success']);
    }
}
