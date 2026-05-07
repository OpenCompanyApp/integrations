<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\HackerNews;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\HackerNews\HackerNewsService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Hacker News official Firebase API endpoint mappings.
 */
final class HackerNewsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_core_item_and_user_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://hacker-news.firebaseio.com/v0/item/8863.json' => Http::response(['id' => 8863], 200),
            'https://hacker-news.firebaseio.com/v0/user/jl.json' => Http::response(['id' => 'jl'], 200),
        ]);

        $service = new HackerNewsService();
        $service->getItem(8863);
        $service->getUser('jl');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://hacker-news.firebaseio.com/v0/item/8863.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://hacker-news.firebaseio.com/v0/user/jl.json');
    }

    public function test_all_story_feed_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://hacker-news.firebaseio.com/v0/topstories.json' => Http::response([1], 200),
            'https://hacker-news.firebaseio.com/v0/newstories.json' => Http::response([2], 200),
            'https://hacker-news.firebaseio.com/v0/beststories.json' => Http::response([3], 200),
            'https://hacker-news.firebaseio.com/v0/askstories.json' => Http::response([4], 200),
            'https://hacker-news.firebaseio.com/v0/showstories.json' => Http::response([5], 200),
            'https://hacker-news.firebaseio.com/v0/jobstories.json' => Http::response([6], 200),
        ]);

        $service = new HackerNewsService();
        $service->topStories();
        $service->newStories();
        $service->bestStories();
        $service->askStories();
        $service->showStories();
        $service->jobStories();

        foreach (['topstories', 'newstories', 'beststories', 'askstories', 'showstories', 'jobstories'] as $feed) {
            Http::assertSent(static fn (Request $request): bool => $request->url() === "https://hacker-news.firebaseio.com/v0/{$feed}.json");
        }
    }

    public function test_live_data_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://hacker-news.firebaseio.com/v0/maxitem.json' => Http::response(9130260, 200),
            'https://hacker-news.firebaseio.com/v0/updates.json' => Http::response([
                'items' => [8423305],
                'profiles' => ['thefox'],
            ], 200),
        ]);

        $service = new HackerNewsService();

        self::assertSame(9130260, $service->maxItem());
        self::assertSame([
            'items' => [8423305],
            'profiles' => ['thefox'],
        ], $service->updates());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hacker-news.firebaseio.com/v0/maxitem.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hacker-news.firebaseio.com/v0/updates.json');
    }

    public function test_fetch_items_respects_limit_and_skips_missing_items(): void
    {
        Http::fake([
            'https://hacker-news.firebaseio.com/v0/item/1.json' => Http::response(['id' => 1], 200),
            'https://hacker-news.firebaseio.com/v0/item/2.json' => Http::response(null, 200),
            'https://hacker-news.firebaseio.com/v0/item/3.json' => Http::response(['id' => 3], 200),
        ]);

        $service = new HackerNewsService();
        $items = $service->fetchItems([1, 2, 3, 4], 3);

        self::assertSame([['id' => 1], ['id' => 3]], $items);
        Http::assertSentCount(3);
    }
}
