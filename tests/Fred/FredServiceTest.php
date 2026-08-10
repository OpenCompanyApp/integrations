<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Fred;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Fred\FredService;
use OpenCompany\Integrations\Fred\FredToolProvider;
use OpenCompany\Integrations\Fred\Tools\FredCategoryRelated;
use OpenCompany\Integrations\Fred\Tools\FredCategorySeries;
use OpenCompany\Integrations\Fred\Tools\FredRelatedTags;
use OpenCompany\Integrations\Fred\Tools\FredSeriesObservations;
use OpenCompany\Integrations\Fred\Tools\FredSeriesSearch;
use OpenCompany\Integrations\Fred\Tools\FredTags;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the FRED integration.
 */
final class FredServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(FredService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(FredService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new FredToolProvider;

        self::assertSame('fred', $provider->appName());
        self::assertSame('FRED', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(31, $provider->tools());
        self::assertContains('fred_series_observations', array_keys($provider->tools()));
        self::assertContains('fred_release_tables', array_keys($provider->tools()));
        self::assertContains('fred_tags_series', array_keys($provider->tools()));
    }

    public function test_series_observations_maps_query_parameters_and_api_key(): void
    {
        $service = new FredService(apiKey: 'test-key', baseUrl: 'https://fred.example.test/fred');

        Http::fake(['*' => Http::response(['observations' => [['date' => '2026-01-01', 'value' => '4.0']]], 200)]);
        $result = (new FredSeriesObservations($service))->execute([
            'series_id' => 'UNRATE',
            'observation_start' => '2020-01-01',
            'observation_end' => '2026-01-01',
            'units' => 'pch',
            'frequency' => 'm',
            'aggregation_method' => 'avg',
            'output_type' => 1,
            'vintage_dates' => '2026-01-01,2026-02-01',
            'limit' => 50,
            'offset' => 5,
            'sort_order' => 'asc',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://fred.example.test/fred/series/observations?')
            && str_contains($request->url(), 'api_key=test-key')
            && str_contains($request->url(), 'file_type=json')
            && str_contains($request->url(), 'series_id=UNRATE')
            && str_contains($request->url(), 'observation_start=2020-01-01')
            && str_contains($request->url(), 'observation_end=2026-01-01')
            && str_contains($request->url(), 'units=pch')
            && str_contains($request->url(), 'frequency=m')
            && str_contains($request->url(), 'aggregation_method=avg')
            && str_contains($request->url(), 'output_type=1')
            && str_contains($request->url(), 'vintage_dates=2026-01-01%2C2026-02-01')
            && str_contains($request->url(), 'limit=50')
            && str_contains($request->url(), 'offset=5')
            && str_contains($request->url(), 'sort_order=asc'));
    }

    public function test_category_search_and_tag_paths_are_mapped(): void
    {
        $service = new FredService(apiKey: 'test-key', baseUrl: 'https://fred.example.test/fred');

        Http::fake(['*' => Http::response(['seriess' => [['id' => 'GDP']]], 200)]);
        self::assertTrue((new FredCategorySeries($service))->execute(['category_id' => 125, 'tag_names' => 'usa;monthly', 'limit' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://fred.example.test/fred/category/series?')
            && str_contains($request->url(), 'category_id=125')
            && str_contains($request->url(), 'tag_names=usa%3Bmonthly')
            && str_contains($request->url(), 'limit=10'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['seriess' => [['id' => 'UNRATE']]], 200)]);
        self::assertTrue((new FredSeriesSearch($service))->execute(['search_text' => 'unemployment', 'order_by' => 'popularity'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://fred.example.test/fred/series/search?')
            && str_contains($request->url(), 'search_text=unemployment')
            && str_contains($request->url(), 'order_by=popularity'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['tags' => [['name' => 'usa']]], 200)]);
        self::assertTrue((new FredRelatedTags($service))->execute(['tag_names' => 'usa;monthly', 'exclude_tag_names' => 'discontinued'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://fred.example.test/fred/related_tags?')
            && str_contains($request->url(), 'tag_names=usa%3Bmonthly')
            && str_contains($request->url(), 'exclude_tag_names=discontinued'));
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new FredService(apiKey: 'test-key', baseUrl: 'https://fred.example.test/fred');

        $missing = (new FredCategoryRelated($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('category_id is required', (string) $missing->error);

        $missingTags = (new FredRelatedTags($service))->execute([]);
        self::assertFalse($missingTags->succeeded());
        self::assertStringContainsString('tag_names is required', (string) $missingTags->error);

        Http::fake(['*' => Http::response(['error_code' => 400, 'error_message' => 'Bad request'], 400)]);
        $apiError = (new FredTags($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('FRED API error 400', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['category' => ['id' => 0, 'name' => 'Categories']], 200)]);
        self::assertSame(['success' => true, 'message' => 'FRED API key accepted.'], (new FredToolProvider)->testConnection(['api_key' => 'test-key']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['seriess' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'fred' && $key === 'api_key' && $account === 'macro' ? 'account-key' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'fred' && $account === 'macro';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'fred' ? ['macro'] : [];
            }
        });

        $tool = (new FredToolProvider)->createTool(FredSeriesSearch::class, ['account' => 'macro']);
        self::assertTrue($tool->execute(['search_text' => 'gdp'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'api_key=account-key'));
    }
}
