<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AlphaVantage;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\AlphaVantage\AlphaVantageService;
use OpenCompany\Integrations\AlphaVantage\AlphaVantageToolProvider;
use OpenCompany\Integrations\AlphaVantage\Tools\AlphaVantageCurrencyExchangeRate;
use OpenCompany\Integrations\AlphaVantage\Tools\AlphaVantageMarketStatus;
use OpenCompany\Integrations\AlphaVantage\Tools\AlphaVantageNewsSentiment;
use OpenCompany\Integrations\AlphaVantage\Tools\AlphaVantageOverview;
use OpenCompany\Integrations\AlphaVantage\Tools\AlphaVantageRsi;
use OpenCompany\Integrations\AlphaVantage\Tools\AlphaVantageSymbolSearch;
use OpenCompany\Integrations\AlphaVantage\Tools\AlphaVantageTimeSeriesIntraday;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Alpha Vantage query API integration.
 */
final class AlphaVantageServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AlphaVantageService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AlphaVantageService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new AlphaVantageToolProvider;

        self::assertSame('alpha-vantage', $provider->appName());
        self::assertSame('Alpha Vantage', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame($provider->configSchema(), $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(124, $provider->tools());
        self::assertArrayHasKey('alpha_vantage_time_series_intraday', $provider->tools());
        self::assertArrayHasKey('alpha_vantage_news_sentiment', $provider->tools());
        self::assertArrayHasKey('alpha_vantage_treasury_yield', $provider->tools());
        self::assertArrayHasKey('alpha_vantage_sma', $provider->tools());
    }

    public function test_equity_fx_news_fundamental_and_indicator_tools_map_query_parameters(): void
    {
        Http::fake(['*' => Http::response(['Meta Data' => ['2. Symbol' => 'IBM']], 200, ['Content-Type' => 'application/json'])]);

        $service = new AlphaVantageService(apiKey: 'key-test', baseUrl: 'https://api.example.test/query');
        $intraday = (new AlphaVantageTimeSeriesIntraday($service))->execute([
            'symbol' => 'IBM',
            'interval' => '5min',
            'adjusted' => false,
            'query' => ['datatype' => 'csv'],
            'datatype' => 'json',
        ]);

        self::assertTrue($intraday->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.example.test/query?')
            && str_contains($request->url(), 'function=TIME_SERIES_INTRADAY')
            && str_contains($request->url(), 'symbol=IBM')
            && str_contains($request->url(), 'interval=5min')
            && str_contains($request->url(), 'adjusted=0')
            && str_contains($request->url(), 'datatype=json')
            && str_contains($request->url(), 'apikey=key-test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Realtime Currency Exchange Rate' => ['1. From_Currency Code' => 'EUR']], 200, ['Content-Type' => 'application/json'])]);
        $fx = (new AlphaVantageCurrencyExchangeRate($service))->execute([
            'from_symbol' => 'EUR',
            'to_symbol' => 'USD',
        ]);
        self::assertTrue($fx->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'function=CURRENCY_EXCHANGE_RATE')
            && str_contains($request->url(), 'from_symbol=EUR')
            && str_contains($request->url(), 'to_symbol=USD'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['feed' => [['title' => 'Example']]], 200, ['Content-Type' => 'application/json'])]);
        $news = (new AlphaVantageNewsSentiment($service))->execute([
            'tickers' => ['IBM', 'CRYPTO:BTC'],
            'topics' => 'technology',
            'limit' => 5,
        ]);
        self::assertTrue($news->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'function=NEWS_SENTIMENT')
            && str_contains($request->url(), 'tickers=IBM%2CCRYPTO%3ABTC')
            && str_contains($request->url(), 'topics=technology')
            && str_contains($request->url(), 'limit=5'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Symbol' => 'IBM'], 200, ['Content-Type' => 'application/json'])]);
        $overview = (new AlphaVantageOverview($service))->execute(['symbol' => 'IBM']);
        self::assertTrue($overview->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'function=OVERVIEW')
            && str_contains($request->url(), 'symbol=IBM'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Technical Analysis: RSI' => []], 200, ['Content-Type' => 'application/json'])]);
        $rsi = (new AlphaVantageRsi($service))->execute([
            'symbol' => 'IBM',
            'interval' => 'daily',
            'time_period' => 14,
            'series_type' => 'close',
        ]);
        self::assertTrue($rsi->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'function=RSI')
            && str_contains($request->url(), 'time_period=14')
            && str_contains($request->url(), 'series_type=close'));
    }

    public function test_symbol_search_market_status_csv_and_error_handling(): void
    {
        $service = new AlphaVantageService(apiKey: 'key-test', baseUrl: 'https://api.example.test/query');

        Http::fake(['*' => Http::response(['bestMatches' => [['1. symbol' => 'IBM']]], 200, ['Content-Type' => 'application/json'])]);
        $search = (new AlphaVantageSymbolSearch($service))->execute(['keywords' => 'International Business Machines']);
        self::assertTrue($search->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'function=SYMBOL_SEARCH')
            && str_contains($request->url(), 'keywords=International%20Business%20Machines'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['markets' => [['market_type' => 'Equity']]], 200, ['Content-Type' => 'application/json'])]);
        $status = (new AlphaVantageMarketStatus($service))->execute([]);
        self::assertTrue($status->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'function=MARKET_STATUS'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response("timestamp,open\n2024-01-01,1.23\n", 200, ['Content-Type' => 'text/csv'])]);
        $csv = (new AlphaVantageTimeSeriesIntraday($service))->execute([
            'symbol' => 'IBM',
            'interval' => '5min',
            'datatype' => 'csv',
        ]);
        self::assertTrue($csv->succeeded());
        self::assertStringContainsString('timestamp,open', $csv->data['body']);

        $missing = (new AlphaVantageOverview($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('symbol is required', (string) $missing->error);

        $unconfigured = (new AlphaVantageOverview(new AlphaVantageService))->execute(['symbol' => 'IBM']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is not configured', (string) $unconfigured->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Note' => 'Thank you for using Alpha Vantage!'], 200, ['Content-Type' => 'application/json'])]);
        $rateLimited = (new AlphaVantageOverview($service))->execute(['symbol' => 'IBM']);
        self::assertFalse($rateLimited->succeeded());
        self::assertStringContainsString('Thank you for using Alpha Vantage', (string) $rateLimited->error);
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['markets' => []], 200, ['Content-Type' => 'application/json'])]);

        $provider = new AlphaVantageToolProvider;
        $ok = $provider->testConnection(['api_key' => 'key-test']);

        self::assertTrue($ok['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://www.alphavantage.co/query?')
            && str_contains($request->url(), 'function=MARKET_STATUS')
            && str_contains($request->url(), 'apikey=key-test'));

        $missingKey = $provider->testConnection([]);
        self::assertFalse($missingKey['success']);
        self::assertStringContainsString('No API key', (string) $missingKey['error']);

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return [$integration, $key, $account] === ['alpha-vantage', 'api_key', 'acct_1'] ? 'key-account' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'alpha-vantage' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'alpha-vantage' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(AlphaVantageOverview::class, ['account' => 'acct_1']);
        $result = $tool->execute(['symbol' => 'IBM']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'function=OVERVIEW')
            && str_contains($request->url(), 'apikey=key-account'));
    }
}
