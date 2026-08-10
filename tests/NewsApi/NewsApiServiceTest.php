<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\NewsApi;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\NewsApi\NewsApiService;
use OpenCompany\Integrations\NewsApi\NewsApiToolProvider;
use OpenCompany\Integrations\NewsApi\Tools\NewsApiEverything;
use OpenCompany\Integrations\NewsApi\Tools\NewsApiSources;
use OpenCompany\Integrations\NewsApi\Tools\NewsApiTopHeadlines;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the NewsAPI integration.
 */
final class NewsApiServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(NewsApiService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(NewsApiService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new NewsApiToolProvider;

        self::assertSame('newsapi', $provider->appName());
        self::assertSame('NewsAPI', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame(['newsapi_everything', 'newsapi_top_headlines', 'newsapi_sources'], array_keys($provider->tools()));
    }

    public function test_everything_maps_query_parameters_and_header_auth(): void
    {
        $service = new NewsApiService(apiKey: 'test-key', baseUrl: 'https://news.example.test/v2');

        Http::fake(['*' => Http::response(['status' => 'ok', 'totalResults' => 1, 'articles' => [['title' => 'Example']]], 200)]);
        $result = (new NewsApiEverything($service))->execute([
            'q' => '"ai"',
            'search_in' => 'title,content',
            'sources' => 'bbc-news',
            'domains' => 'example.test',
            'exclude_domains' => 'exclude.example.test',
            'from_date' => '2026-05-01',
            'to_date' => '2026-05-07',
            'language' => 'en',
            'sort_by' => 'publishedAt',
            'page_size' => 25,
            'page' => 2,
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://news.example.test/v2/everything?')
            && $request->hasHeader('X-Api-Key', 'test-key')
            && str_contains($request->url(), 'q=%22ai%22')
            && str_contains($request->url(), 'searchIn=title%2Ccontent')
            && str_contains($request->url(), 'excludeDomains=exclude.example.test')
            && str_contains($request->url(), 'from=2026-05-01')
            && str_contains($request->url(), 'to=2026-05-07')
            && str_contains($request->url(), 'sortBy=publishedAt')
            && str_contains($request->url(), 'pageSize=25')
            && str_contains($request->url(), 'page=2'));
    }

    public function test_top_headlines_and_sources_paths_are_mapped(): void
    {
        $service = new NewsApiService(apiKey: 'test-key', baseUrl: 'https://news.example.test/v2');

        Http::fake(['*' => Http::response(['status' => 'ok', 'totalResults' => 1, 'articles' => [['title' => 'Headline']]], 200)]);
        self::assertTrue((new NewsApiTopHeadlines($service))->execute(['country' => 'us', 'category' => 'technology', 'q' => 'space', 'page_size' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://news.example.test/v2/top-headlines?')
            && str_contains($request->url(), 'country=us')
            && str_contains($request->url(), 'category=technology')
            && str_contains($request->url(), 'q=space')
            && str_contains($request->url(), 'pageSize=10'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'ok', 'sources' => [['id' => 'bbc-news', 'language' => 'en']]], 200)]);
        self::assertTrue((new NewsApiSources($service))->execute(['language' => 'en', 'country' => 'us'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://news.example.test/v2/top-headlines/sources?')
            && str_contains($request->url(), 'language=en')
            && str_contains($request->url(), 'country=us'));
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new NewsApiService(apiKey: 'test-key', baseUrl: 'https://news.example.test/v2');

        $missing = (new NewsApiEverything($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('q, sources, or domains is required', (string) $missing->error);

        $badMix = (new NewsApiTopHeadlines($service))->execute(['sources' => 'bbc-news', 'country' => 'us']);
        self::assertFalse($badMix->succeeded());
        self::assertStringContainsString('sources cannot be mixed', (string) $badMix->error);

        $badLanguage = (new NewsApiSources($service))->execute(['language' => 'xx']);
        self::assertFalse($badLanguage->succeeded());
        self::assertStringContainsString('language must be one of', (string) $badLanguage->error);

        Http::fake(['*' => Http::response(['status' => 'error', 'code' => 'apiKeyInvalid', 'message' => 'Bad key'], 401)]);
        $apiError = (new NewsApiSources($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('apiKeyInvalid', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'ok', 'sources' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'NewsAPI API key accepted.'], (new NewsApiToolProvider)->testConnection(['api_key' => 'test-key']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'ok', 'sources' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'newsapi' && $key === 'api_key' && $account === 'research' ? 'account-key' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'newsapi' && $account === 'research';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'newsapi' ? ['research'] : [];
            }
        });

        $tool = (new NewsApiToolProvider)->createTool(NewsApiSources::class, ['account' => 'research']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Api-Key', 'account-key'));
    }
}
