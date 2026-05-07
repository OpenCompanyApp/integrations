<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Tavily;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Tavily\TavilyService;
use OpenCompany\Integrations\Tavily\TavilyToolProvider;
use OpenCompany\Integrations\Tavily\Tools\TavilyCreateResearchTask;
use OpenCompany\Integrations\Tavily\Tools\TavilySearch;
use PHPUnit\Framework\TestCase;

final class TavilyServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new TavilyToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/tavily/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('Tavily', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
    }

    public function test_official_endpoint_mappings_and_project_header(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new TavilyService('tvly-test', projectId: 'project-1');
        $service->search(['query' => 'AI news', 'include_usage' => true]);
        $service->extract(['urls' => ['https://example.test/a'], 'format' => 'markdown']);
        $service->crawl(['url' => 'https://example.test/docs', 'limit' => 10, 'timeout' => 20]);
        $service->map(['url' => 'https://example.test/docs', 'select_paths' => ['/docs/.*']]);
        $service->createResearch(['input' => 'Research this', 'model' => 'mini']);
        $service->getResearch('request-1');
        $service->usage();

        $expected = [
            ['POST', 'https://api.tavily.com/search'],
            ['POST', 'https://api.tavily.com/extract'],
            ['POST', 'https://api.tavily.com/crawl'],
            ['POST', 'https://api.tavily.com/map'],
            ['POST', 'https://api.tavily.com/research'],
            ['GET', 'https://api.tavily.com/research/request-1'],
            ['GET', 'https://api.tavily.com/usage'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer tvly-test')
                && $request->hasHeader('X-Project-ID', 'project-1'));
        }
    }

    public function test_search_tool_filters_payload_and_validates_enums(): void
    {
        Http::fake([
            'https://api.tavily.com/search' => Http::response([
                'query' => 'AI news',
                'results' => [],
                'request_id' => 'request-1',
            ], 200),
        ]);

        $tool = new TavilySearch(new TavilyService('tvly-test'));
        $result = $tool->execute([
            'query' => 'AI news',
            'search_depth' => 'advanced',
            'topic' => 'news',
            'include_answer' => 'basic',
            'max_results' => 3,
            'unknown' => 'ignored',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://api.tavily.com/search'
                && $request->data()['query'] === 'AI news'
                && $request->data()['search_depth'] === 'advanced'
                && $request->data()['topic'] === 'news'
                && $request->data()['include_answer'] === 'basic'
                && !array_key_exists('unknown', $request->data());
        });

        $invalid = $tool->execute([
            'query' => 'AI news',
            'search_depth' => 'deep',
        ]);

        self::assertFalse($invalid->succeeded());
        self::assertStringContainsString('search_depth must be one of', (string) $invalid->error);
    }

    public function test_research_streaming_is_explicitly_unsupported(): void
    {
        $tool = new TavilyCreateResearchTask(new TavilyService('tvly-test'));

        $result = $tool->execute([
            'input' => 'Research this',
            'stream' => true,
        ]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('stream=true is not supported', (string) $result->error);
    }
}
