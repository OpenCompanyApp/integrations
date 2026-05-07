<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Openrouter;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\Integrations\Openrouter\OpenrouterToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for OpenRouter endpoint coverage and metadata.
 */
final class OpenrouterServiceTest extends TestCase
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

    public function test_expanded_endpoint_mapping_uses_openrouter_v1_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new OpenrouterService('openrouter-token', 'https://openrouter.example.test/api/v1');

        $service->createResponse(['model' => 'openai/gpt-4o-mini', 'input' => 'Hello']);
        $service->createEmbedding(['model' => 'openai/text-embedding-3-small', 'input' => 'Search']);
        $service->rerank(['model' => 'cohere/rerank-english-v3.0', 'query' => 'A', 'documents' => ['A', 'B']]);
        $service->getCredits();
        $service->listModelEndpoints('openai', 'gpt-4o-mini');
        $service->updateApiKey('key_hash', ['name' => 'Worker']);
        $service->deleteApiKey('key_hash');
        $service->createVideo(['model' => 'google/veo-2', 'prompt' => 'City skyline']);
        $service->getVideo('job_123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://openrouter.example.test/api/v1/responses'
            && $request->hasHeader('Authorization', 'Bearer openrouter-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://openrouter.example.test/api/v1/embeddings'
            && $request['input'] === 'Search');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://openrouter.example.test/api/v1/rerank'
            && $request['documents'][1] === 'B');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://openrouter.example.test/api/v1/credits');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://openrouter.example.test/api/v1/models/openai/gpt-4o-mini/endpoints');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://openrouter.example.test/api/v1/keys/key_hash'
            && $request['name'] === 'Worker');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://openrouter.example.test/api/v1/keys/key_hash');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://openrouter.example.test/api/v1/videos');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://openrouter.example.test/api/v1/videos/job_123');
    }

    public function test_raw_path_helpers_reject_unsafe_paths(): void
    {
        $service = new OpenrouterService('openrouter-token', 'https://openrouter.example.test/api/v1');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Only safe relative OpenRouter API paths are supported.');

        $service->apiGet('https://example.invalid/keys');
    }

    public function test_provider_registers_expanded_catalog(): void
    {
        $provider = new OpenrouterToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(37, count($tools));
        self::assertArrayHasKey('openrouter_create_response', $tools);
        self::assertArrayHasKey('openrouter_create_embedding', $tools);
        self::assertArrayHasKey('openrouter_rerank', $tools);
        self::assertArrayHasKey('openrouter_get_credits', $tools);
        self::assertArrayHasKey('openrouter_create_api_key', $tools);
        self::assertArrayHasKey('openrouter_list_workspaces', $tools);
        self::assertArrayHasKey('openrouter_api_get', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new OpenrouterService('openrouter-token'));
            $names[] = $instance->name();
        }

        self::assertCount(count($names), array_unique($names));
    }
}
