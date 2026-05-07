<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\BraveSearch;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\BraveSearch\BraveSearchService;
use OpenCompany\Integrations\BraveSearch\BraveSearchToolProvider;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchAnswer;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchLlmContext;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchLlmContextPost;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchLocalPois;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchPlaceSearch;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchRelatedSummarizerSummary;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchSpellcheck;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchWebSearch;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Brave Search integration.
 */
final class BraveSearchServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BraveSearchService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BraveSearchService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new BraveSearchToolProvider;

        self::assertSame('brave-search', $provider->appName());
        self::assertSame('Brave Search', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(19, $provider->tools());
        self::assertContains('brave_search_llm_context', array_keys($provider->tools()));
        self::assertContains('brave_search_answer', array_keys($provider->tools()));
        self::assertContains('brave_search_summarizer_entity_info', array_keys($provider->tools()));
    }

    public function test_web_search_maps_query_and_location_headers(): void
    {
        $service = new BraveSearchService(apiKey: 'test-key', baseUrl: 'https://brave.example.test/res/v1');

        Http::fake(['*' => Http::response(['web' => ['results' => [['title' => 'Example']]]], 200)]);
        $result = (new BraveSearchWebSearch($service))->execute([
            'q' => 'laravel queues',
            'country' => 'US',
            'search_lang' => 'en',
            'count' => 10,
            'freshness' => 'pm',
            'extra_snippets' => true,
            'enable_rich_callback' => true,
            'loc_lat' => 37.7749,
            'loc_long' => -122.4194,
            'loc_city' => 'San Francisco',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://brave.example.test/res/v1/web/search?')
            && $request->hasHeader('X-Subscription-Token', 'test-key')
            && $request->hasHeader('Accept-Encoding', 'gzip')
            && $request->hasHeader('X-Loc-Lat', '37.7749')
            && $request->hasHeader('X-Loc-Long', '-122.4194')
            && $request->hasHeader('X-Loc-City', 'San Francisco')
            && str_contains($request->url(), 'q=laravel%20queues')
            && str_contains($request->url(), 'country=US')
            && str_contains($request->url(), 'search_lang=en')
            && str_contains($request->url(), 'count=10')
            && str_contains($request->url(), 'freshness=pm')
            && str_contains($request->url(), 'extra_snippets=true')
            && str_contains($request->url(), 'enable_rich_callback=true'));
    }

    public function test_llm_context_place_local_pois_and_summarizer_paths_are_mapped(): void
    {
        $service = new BraveSearchService(apiKey: 'test-key', baseUrl: 'https://brave.example.test/res/v1');

        Http::fake(['*' => Http::response(['grounding' => ['generic' => []], 'sources' => []], 200)]);
        self::assertTrue((new BraveSearchLlmContext($service))->execute(['q' => 'fresh search', 'maximum_number_of_tokens' => 2048, 'context_threshold_mode' => 'strict'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://brave.example.test/res/v1/llm/context?')
            && str_contains($request->url(), 'q=fresh%20search')
            && str_contains($request->url(), 'maximum_number_of_tokens=2048')
            && str_contains($request->url(), 'context_threshold_mode=strict'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['type' => 'locations', 'results' => []], 200)]);
        self::assertTrue((new BraveSearchPlaceSearch($service))->execute(['latitude' => 37.7, 'longitude' => -122.4, 'q' => 'coffee', 'radius' => 1000])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://brave.example.test/res/v1/local/place_search?')
            && str_contains($request->url(), 'latitude=37.7')
            && str_contains($request->url(), 'longitude=-122.4')
            && str_contains($request->url(), 'q=coffee')
            && str_contains($request->url(), 'radius=1000'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['results' => []], 200)]);
        self::assertTrue((new BraveSearchLocalPois($service))->execute(['ids' => ['loc-a', 'loc-b'], 'units' => 'metric'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://brave.example.test/res/v1/local/pois?')
            && (str_contains($request->url(), 'ids%5B0%5D=loc-a') || str_contains($request->url(), 'ids=loc-a'))
            && str_contains($request->url(), 'units=metric'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['summary' => ['text' => 'Example']], 200)]);
        self::assertTrue((new BraveSearchRelatedSummarizerSummary($service))->execute(['key' => 'opaque-key', 'inline_references' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://brave.example.test/res/v1/summarizer/summary?')
            && str_contains($request->url(), 'key=opaque-key')
            && str_contains($request->url(), 'inline_references=true'));
    }

    public function test_post_body_answer_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new BraveSearchService(apiKey: 'test-key', baseUrl: 'https://brave.example.test/res/v1');

        Http::fake(['*' => Http::response(['grounding' => ['generic' => []]], 200)]);
        self::assertTrue((new BraveSearchLlmContextPost($service))->execute(['q' => 'long query', 'maximum_number_of_tokens' => 8192, 'loc_country' => 'US'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://brave.example.test/res/v1/llm/context'
            && $request->hasHeader('X-Loc-Country', 'US')
            && ($request->data()['q'] ?? null) === 'long query'
            && ($request->data()['maximum_number_of_tokens'] ?? null) === 8192);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['choices' => [['message' => ['content' => 'Answer']]]], 200)]);
        self::assertTrue((new BraveSearchAnswer($service))->execute(['messages' => [['role' => 'user', 'content' => 'hello']], 'stream' => false])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://brave.example.test/res/v1/chat/completions'
            && ($request->data()['model'] ?? null) === 'brave'
            && ($request->data()['stream'] ?? null) === 'false');

        $badPlace = (new BraveSearchPlaceSearch($service))->execute(['latitude' => 37.7]);
        self::assertFalse($badPlace->succeeded());
        self::assertStringContainsString('latitude and longitude must be provided together', (string) $badPlace->error);

        $missingQuery = (new BraveSearchSpellcheck($service))->execute([]);
        self::assertFalse($missingQuery->succeeded());
        self::assertStringContainsString('q is required', (string) $missingQuery->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => ['message' => 'Bad token']], 401)]);
        $apiError = (new BraveSearchSpellcheck($service))->execute(['q' => 'helo']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Bad token', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['type' => 'spellcheck', 'results' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Brave Search API key accepted.'], (new BraveSearchToolProvider)->testConnection(['api_key' => 'test-key']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['type' => 'spellcheck', 'results' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'brave-search' && $key === 'api_key' && $account === 'search' ? 'account-key' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'brave-search' && $account === 'search';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'brave-search' ? ['search'] : [];
            }
        });

        $tool = (new BraveSearchToolProvider)->createTool(BraveSearchSpellcheck::class, ['account' => 'search']);
        self::assertTrue($tool->execute(['q' => 'hello'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Subscription-Token', 'account-key'));
    }
}
