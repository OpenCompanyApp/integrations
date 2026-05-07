<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Exa;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Exa\ExaService;
use OpenCompany\Integrations\Exa\Tools\ExaGetContents;
use OpenCompany\Integrations\Exa\Tools\ExaSearchAndContents;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Exa endpoint coverage and payload mappings.
 */
final class ExaServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_search_uses_x_api_key_header(): void
    {
        Http::fake([
            'https://api.exa.test/search' => Http::response(['results' => []], 200),
        ]);

        $service = new ExaService(apiKey: 'key-test', baseUrl: 'https://api.exa.test');
        $service->search(['query' => 'example query', 'type' => 'fast']);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.exa.test/search'
                && $request->hasHeader('x-api-key', 'key-test')
                && $request->data()['query'] === 'example query'
                && $request->data()['type'] === 'fast';
        });
    }

    public function test_contents_accepts_url_first_payload_with_current_options(): void
    {
        Http::fake([
            'https://api.exa.test/contents' => Http::response(['results' => []], 200),
        ]);

        $service = new ExaService('key-test', 'https://api.exa.test');
        $service->getContents([
            'urls' => ['https://example.test/article'],
            'text' => true,
            'summary' => ['query' => 'Summarize for engineers.'],
            'maxAgeHours' => 24,
            'subpages' => 2,
        ]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.exa.test/contents'
                && $request->data()['urls'] === ['https://example.test/article']
                && $request->data()['summary']['query'] === 'Summarize for engineers.'
                && $request->data()['maxAgeHours'] === 24
                && $request->data()['subpages'] === 2;
        });
    }

    public function test_answer_maps_to_answer_endpoint(): void
    {
        Http::fake([
            'https://api.exa.test/answer' => Http::response([
                'answer' => 'Example answer.',
                'citations' => [],
            ], 200),
        ]);

        $service = new ExaService('key-test', 'https://api.exa.test');
        $service->answer(['query' => 'What changed?', 'text' => true]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.exa.test/answer'
                && $request->data()['query'] === 'What changed?'
                && $request->data()['text'] === true;
        });
    }

    public function test_find_similar_and_user_paths_still_map_correctly(): void
    {
        Http::fake([
            'https://api.exa.test/findSimilar' => Http::response(['results' => []], 200),
            'https://api.exa.test/user' => Http::response(['email' => 'person@example.test'], 200),
        ]);

        $service = new ExaService('key-test', 'https://api.exa.test/');
        $service->findSimilar([
            'url' => 'https://example.test',
            'numResults' => 5,
            'excludeSourceDomain' => true,
        ]);
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.exa.test/findSimilar' && $request->data()['excludeSourceDomain'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.exa.test/user');
    }

    public function test_search_and_contents_tool_nests_contents_options(): void
    {
        Http::fake([
            'https://api.exa.test/search' => Http::response(['results' => []], 200),
        ]);

        $tool = new ExaSearchAndContents(new ExaService('key-test', 'https://api.exa.test'));
        $result = $tool->execute([
            'query' => 'example query',
            'type' => 'fast',
            'text' => true,
            'highlights' => ['query' => 'example'],
            'summary' => ['query' => 'summarize'],
            'max_age_hours' => 12,
        ]);

        self::assertNull($result->error);
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://api.exa.test/search'
                && !array_key_exists('text', $request->data())
                && $request->data()['contents']['text'] === true
                && $request->data()['contents']['highlights']['query'] === 'example'
                && $request->data()['contents']['summary']['query'] === 'summarize'
                && $request->data()['contents']['maxAgeHours'] === 12;
        });
    }

    public function test_get_contents_tool_maps_snake_case_to_current_payload_keys(): void
    {
        Http::fake([
            'https://api.exa.test/contents' => Http::response(['results' => []], 200),
        ]);

        $tool = new ExaGetContents(new ExaService('key-test', 'https://api.exa.test'));
        $result = $tool->execute([
            'urls' => ['https://example.test/article'],
            'max_age_hours' => 24,
            'subpage_target' => 'docs',
            'summary' => ['query' => 'summarize'],
        ]);

        self::assertNull($result->error);
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://api.exa.test/contents'
                && $request->data()['urls'] === ['https://example.test/article']
                && $request->data()['maxAgeHours'] === 24
                && $request->data()['subpageTarget'] === 'docs';
        });
    }
}
