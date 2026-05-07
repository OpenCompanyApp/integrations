<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\JinaAI;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\JinaAI\JinaAIService;
use OpenCompany\Integrations\JinaAI\JinaAIToolProvider;
use OpenCompany\Integrations\JinaAI\Tools\JinaAIClassify;
use OpenCompany\Integrations\JinaAI\Tools\JinaAISegment;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Jina AI Search Foundation endpoint mappings.
 */
final class JinaAIServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_reader_search_and_grounding_use_documented_jina_hosts(): void
    {
        Http::fake([
            'https://s.jina.ai/' => Http::response(['data' => ['result' => []]], 200),
            'https://r.jina.ai/' => Http::response(['data' => ['content' => 'Example']], 200),
            'https://g.jina.ai/' => Http::response(['data' => ['result' => true]], 200),
        ]);

        $service = new JinaAIService('key-test', 'https://api.jina.test/v1');
        $service->search(['q' => 'example query']);
        $service->read(['url' => 'https://example.test/article']);
        $service->ground(['statement' => 'Example is a test domain.']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://s.jina.ai/' && $request->hasHeader('Authorization', 'Bearer key-test') && $request->data()['q'] === 'example query');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://r.jina.ai/' && $request->data()['url'] === 'https://example.test/article');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://g.jina.ai/' && $request->data()['statement'] === 'Example is a test domain.');
    }

    public function test_v1_model_endpoints_still_use_configured_base_url(): void
    {
        Http::fake([
            'https://api.jina.test/v1/embeddings' => Http::response(['data' => []], 200),
            'https://api.jina.test/v1/rerank' => Http::response(['results' => []], 200),
            'https://api.jina.test/v1/classify' => Http::response(['data' => []], 200),
            'https://api.jina.test/v1/segment' => Http::response(['tokens' => []], 200),
        ]);

        $service = new JinaAIService('key-test', 'https://api.jina.test/v1');
        $service->embeddings(['input' => ['text'], 'model' => 'jina-embeddings-v3']);
        $service->rerank(['query' => 'test', 'documents' => ['doc']]);
        $service->classify(['input' => ['text'], 'labels' => ['a', 'b']]);
        $service->segment(['content' => 'split this text']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.jina.test/v1/embeddings');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.jina.test/v1/rerank');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.jina.test/v1/classify' && $request->data()['labels'] === ['a', 'b']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.jina.test/v1/segment' && $request->data()['content'] === 'split this text');
    }

    public function test_new_tools_shape_classify_and_segment_payloads(): void
    {
        Http::fake([
            'https://api.jina.test/v1/classify' => Http::response(['data' => []], 200),
            'https://api.jina.test/v1/segment' => Http::response(['chunks' => []], 200),
        ]);

        $service = new JinaAIService('key-test', 'https://api.jina.test/v1');
        $classify = (new JinaAIClassify($service))->execute([
            'input' => ['Example text'],
            'labels' => ['docs', 'news'],
            'top_k' => 1,
        ]);
        $segment = (new JinaAISegment($service))->execute([
            'content' => 'Long example text',
            'return_chunks' => true,
        ]);

        self::assertNull($classify->error);
        self::assertNull($segment->error);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.jina.test/v1/classify' && $request->data()['top_k'] === 1);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.jina.test/v1/segment' && $request->data()['return_chunks'] === true);
    }

    public function test_provider_catalog_metadata_is_data_category_and_includes_new_tools(): void
    {
        $provider = new JinaAIToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('jinaai_classify', $tools);
        self::assertArrayHasKey('jinaai_segment', $tools);
        self::assertSame(7, count($tools));
    }
}
