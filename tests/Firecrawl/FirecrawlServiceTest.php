<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Firecrawl;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\Integrations\Firecrawl\FirecrawlToolProvider;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlBatchScrape;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlSearch;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Firecrawl v2 endpoint coverage and payload mappings.
 */
final class FirecrawlServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_core_v2_endpoints_map_to_configured_base_url(): void
    {
        Http::fake([
            'https://api.firecrawl.test/v2/scrape' => Http::response(['success' => true], 200),
            'https://api.firecrawl.test/v2/search' => Http::response(['data' => []], 200),
            'https://api.firecrawl.test/v2/crawl' => Http::response(['id' => 'crawl-test'], 200),
            'https://api.firecrawl.test/v2/crawl/crawl-test' => Http::sequence()
                ->push(['status' => 'scraping'], 200)
                ->push(['success' => true], 200),
            'https://api.firecrawl.test/v2/crawl/crawl-test/errors' => Http::response(['errors' => []], 200),
            'https://api.firecrawl.test/v2/crawl/active' => Http::response(['crawls' => []], 200),
            'https://api.firecrawl.test/v2/crawl/params-preview' => Http::response(['params' => []], 200),
            'https://api.firecrawl.test/v2/map' => Http::response(['links' => []], 200),
        ]);

        $service = new FirecrawlService('key-test', 'https://api.firecrawl.test/v2');
        $service->scrape('https://example.test', ['formats' => ['markdown']]);
        $service->search(['query' => 'example query', 'limit' => 3]);
        $service->crawl('https://example.test', ['limit' => 10]);
        $service->getCrawlStatus('crawl-test');
        $service->cancelCrawl('crawl-test');
        $service->getCrawlErrors('crawl-test');
        $service->getActiveCrawls();
        $service->previewCrawlParams(['prompt' => 'docs only']);
        $service->map('https://example.test', ['limit' => 50]);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/scrape' && $request->hasHeader('Authorization', 'Bearer key-test') && $request->data()['formats'] === ['markdown']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/search' && $request->data()['query'] === 'example query');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/crawl' && $request->data()['limit'] === 10);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.firecrawl.test/v2/crawl/crawl-test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.firecrawl.test/v2/crawl/crawl-test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/crawl/crawl-test/errors');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/crawl/active');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/crawl/params-preview');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/map' && $request->data()['limit'] === 50);
    }

    public function test_batch_extract_agent_browser_and_team_endpoints_map_to_v2_paths(): void
    {
        Http::fake([
            'https://api.firecrawl.test/v2/batch/scrape' => Http::response(['id' => 'batch-test'], 200),
            'https://api.firecrawl.test/v2/batch/scrape/batch-test' => Http::sequence()
                ->push(['status' => 'scraping'], 200)
                ->push(['success' => true], 200),
            'https://api.firecrawl.test/v2/batch/scrape/batch-test/errors' => Http::response(['errors' => []], 200),
            'https://api.firecrawl.test/v2/extract' => Http::response(['id' => 'extract-test'], 200),
            'https://api.firecrawl.test/v2/extract/extract-test' => Http::response(['status' => 'completed'], 200),
            'https://api.firecrawl.test/v2/agent' => Http::response(['id' => 'agent-test'], 200),
            'https://api.firecrawl.test/v2/agent/agent-test' => Http::sequence()
                ->push(['status' => 'running'], 200)
                ->push(['success' => true], 200),
            'https://api.firecrawl.test/v2/browser' => Http::response(['sessionId' => 'browser-test'], 200),
            'https://api.firecrawl.test/v2/browser?*' => Http::response(['sessions' => []], 200),
            'https://api.firecrawl.test/v2/browser/browser-test/execute' => Http::response(['result' => 'ok'], 200),
            'https://api.firecrawl.test/v2/browser/browser-test' => Http::response(['success' => true], 200),
            'https://api.firecrawl.test/v2/team/credit-usage' => Http::response(['remaining' => 100], 200),
            'https://api.firecrawl.test/v2/team/credit-usage/historical*' => Http::response(['data' => []], 200),
            'https://api.firecrawl.test/v2/team/token-usage' => Http::response(['remaining' => 1000], 200),
            'https://api.firecrawl.test/v2/team/token-usage/historical*' => Http::response(['data' => []], 200),
            'https://api.firecrawl.test/v2/team/queue-status' => Http::response(['queued' => 0], 200),
            'https://api.firecrawl.test/v2/team/activity*' => Http::response(['data' => []], 200),
        ]);

        $service = new FirecrawlService('key-test', 'https://api.firecrawl.test/v2');
        $service->batchScrape(['https://example.test/a'], ['formats' => ['markdown']]);
        $service->getBatchScrapeStatus('batch-test');
        $service->cancelBatchScrape('batch-test');
        $service->getBatchScrapeErrors('batch-test');
        $service->extract(['https://example.test/a'], ['prompt' => 'Extract title']);
        $service->getExtractStatus('extract-test');
        $service->agent(['prompt' => 'Find title']);
        $service->getAgentStatus('agent-test');
        $service->cancelAgent('agent-test');
        $service->createBrowser(['url' => 'https://example.test']);
        $service->listBrowsers(['status' => 'active']);
        $service->executeBrowser('browser-test', ['prompt' => 'Read title']);
        $service->deleteBrowser('browser-test');
        $service->creditUsage();
        $service->historicalCreditUsage(['startDate' => '2026-01-01']);
        $service->tokenUsage();
        $service->historicalTokenUsage(['startDate' => '2026-01-01']);
        $service->queueStatus();
        $service->activity(['limit' => 10]);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/batch/scrape' && $request->data()['urls'] === ['https://example.test/a']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.firecrawl.test/v2/batch/scrape/batch-test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/extract' && $request->data()['prompt'] === 'Extract title');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/agent' && $request->data()['prompt'] === 'Find title');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/browser/browser-test/execute' && $request->data()['prompt'] === 'Read title');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.firecrawl.test/v2/team/credit-usage');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.firecrawl.test/v2/team/activity?') && $request->data()['limit'] === 10);
    }

    public function test_tools_and_provider_expose_v2_surface_without_user_endpoint(): void
    {
        Http::fake([
            'https://api.firecrawl.test/v2/search' => Http::response(['data' => []], 200),
            'https://api.firecrawl.test/v2/batch/scrape' => Http::response(['id' => 'batch-test'], 200),
        ]);

        $service = new FirecrawlService('key-test', 'https://api.firecrawl.test/v2');
        $search = (new FirecrawlSearch($service))->execute(['query' => 'example', 'limit' => 2]);
        $batch = (new FirecrawlBatchScrape($service))->execute(['urls' => ['https://example.test']]);

        self::assertNull($search->error);
        self::assertNull($batch->error);

        $provider = new FirecrawlToolProvider();
        $tools = $provider->tools();
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayNotHasKey('firecrawl_get_current_user', $tools);
        self::assertArrayHasKey('firecrawl_search', $tools);
        self::assertArrayHasKey('firecrawl_create_browser', $tools);
        self::assertSame(28, count($tools));
    }
}
