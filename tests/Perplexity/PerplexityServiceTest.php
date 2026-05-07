<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Perplexity;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\Integrations\Perplexity\PerplexityToolProvider;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityAsk;
use OpenCompany\Integrations\Perplexity\Tools\PerplexityCreateAsyncSonar;
use OpenCompany\Integrations\Perplexity\Tools\PerplexitySearch;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Perplexity endpoint coverage and payload mappings.
 */
final class PerplexityServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_chat_uses_current_sonar_endpoint(): void
    {
        Http::fake([
            'https://api.perplexity.test/v1/sonar' => Http::response(['id' => 'chat-test'], 200),
        ]);

        $service = new PerplexityService('key-test', 'https://api.perplexity.test');
        $service->chat([
            ['role' => 'user', 'content' => 'What is Sonar?'],
        ], 'sonar-pro', [
            'web_search_options' => ['search_domain_filter' => ['example.test']],
        ]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.perplexity.test/v1/sonar'
                && $request->hasHeader('Authorization', 'Bearer key-test')
                && $request->data()['model'] === 'sonar-pro'
                && $request->data()['messages'][0]['content'] === 'What is Sonar?'
                && $request->data()['web_search_options']['search_domain_filter'] === ['example.test'];
        });
    }

    public function test_ask_wraps_query_into_sonar_chat(): void
    {
        Http::fake([
            'https://api.perplexity.test/v1/sonar' => Http::response(['id' => 'ask-test'], 200),
        ]);

        $service = new PerplexityService('key-test', 'https://api.perplexity.test');
        $service->ask('What changed?', ['model' => 'sonar']);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.perplexity.test/v1/sonar'
                && $request->data()['model'] === 'sonar'
                && $request->data()['messages'] === [['role' => 'user', 'content' => 'What changed?']];
        });
    }

    public function test_search_uses_documented_search_endpoint(): void
    {
        Http::fake([
            'https://api.perplexity.test/search' => Http::response(['results' => []], 200),
        ]);

        $service = new PerplexityService('key-test', 'https://api.perplexity.test');
        $service->search(['query' => 'perplexity api', 'max_results' => 3]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.perplexity.test/search'
                && $request->data()['query'] === 'perplexity api'
                && $request->data()['max_results'] === 3;
        });
    }

    public function test_async_sonar_endpoints_map_to_current_paths(): void
    {
        Http::fake([
            'https://api.perplexity.test/v1/async/sonar' => Http::sequence()
                ->push(['id' => 'async-test', 'status' => 'CREATED'], 200)
                ->push(['requests' => []], 200),
            'https://api.perplexity.test/v1/async/sonar/async-test' => Http::response(['id' => 'async-test', 'status' => 'COMPLETED'], 200),
        ]);

        $service = new PerplexityService('key-test', 'https://api.perplexity.test');
        $service->createAsyncSonar([
            'model' => 'sonar-deep-research',
            'messages' => [['role' => 'user', 'content' => 'Research this']],
        ], 'idem-test');
        $service->listAsyncSonar();
        $service->getAsyncSonar('async-test');

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.perplexity.test/v1/async/sonar'
                && $request->data()['idempotency_key'] === 'idem-test'
                && $request->data()['request']['model'] === 'sonar-deep-research';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.perplexity.test/v1/async/sonar');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.perplexity.test/v1/async/sonar/async-test');
    }

    public function test_agent_embeddings_models_endpoints_map_to_current_paths(): void
    {
        Http::fake([
            'https://api.perplexity.test/v1/agent' => Http::response(['id' => 'response-test'], 200),
            'https://api.perplexity.test/v1/embeddings' => Http::response(['object' => 'list'], 200),
            'https://api.perplexity.test/v1/contextualizedembeddings' => Http::response(['object' => 'list'], 200),
            'https://api.perplexity.test/v1/models' => Http::response(['object' => 'list', 'data' => []], 200),
        ]);

        $service = new PerplexityService('key-test', 'https://api.perplexity.test');
        $service->agent(['input' => 'Summarize this']);
        $service->embeddings(['input' => 'text', 'model' => 'pplx-embed-v1-0.6b']);
        $service->contextualizedEmbeddings(['input' => [['chunk']], 'model' => 'pplx-embed-context-v1-0.6b']);
        $service->listModels();

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.perplexity.test/v1/agent' && $request->data()['input'] === 'Summarize this');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.perplexity.test/v1/embeddings' && $request->data()['model'] === 'pplx-embed-v1-0.6b');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.perplexity.test/v1/contextualizedembeddings' && $request->data()['model'] === 'pplx-embed-context-v1-0.6b');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.perplexity.test/v1/models');
    }

    public function test_tools_shape_current_payloads_and_provider_does_not_expose_removed_user_endpoint(): void
    {
        Http::fake([
            'https://api.perplexity.test/search' => Http::response(['results' => []], 200),
            'https://api.perplexity.test/v1/sonar' => Http::response(['id' => 'ask-test'], 200),
            'https://api.perplexity.test/v1/async/sonar' => Http::response(['id' => 'async-test'], 200),
        ]);

        $service = new PerplexityService('key-test', 'https://api.perplexity.test');

        $searchResult = (new PerplexitySearch($service))->execute([
            'query' => 'example query',
            'max_results' => 2,
        ]);
        $askResult = (new PerplexityAsk($service))->execute([
            'query' => 'example question',
            'search_domain_filter' => ['example.test'],
        ]);
        $asyncResult = (new PerplexityCreateAsyncSonar($service))->execute([
            'query' => 'long research request',
        ]);

        self::assertNull($searchResult->error);
        self::assertNull($askResult->error);
        self::assertNull($asyncResult->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.perplexity.test/search' && $request->data()['max_results'] === 2);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.perplexity.test/v1/sonar' && $request->data()['web_search_options']['search_domain_filter'] === ['example.test']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.perplexity.test/v1/async/sonar' && $request->data()['request']['model'] === 'sonar-deep-research');

        $tools = (new PerplexityToolProvider())->tools();
        self::assertArrayNotHasKey('perplexity_get_current_user', $tools);
        self::assertArrayHasKey('perplexity_search', $tools);
        self::assertArrayHasKey('perplexity_contextualized_embeddings', $tools);
    }
}
