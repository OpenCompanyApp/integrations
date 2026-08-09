<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CoinMarketCap;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\CoinMarketCap\CoinMarketCapService;
use OpenCompany\Integrations\CoinMarketCap\CoinMarketCapToolProvider;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3CryptocurrencyQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3CryptocurrencyListingsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1KeyInfo;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexTokensTrendingList;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated CoinMarketCap API integration.
 */
final class CoinMarketCapServiceTest extends TestCase
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

    public function test_provider_matches_manifest_and_docs(): void
    {
        $provider = new CoinMarketCapToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/coinmarketcap/coinmarketcap-openapi-manifest.json'), true);

        self::assertSame(91, $manifest['method_count']);
        self::assertSame('2.0.4', $manifest['version']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('CoinMarketCap', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('coinmarketcap_get_v3_cryptocurrency_quotes_latest', array_keys($provider->tools()));
        self::assertContains('coinmarketcap_get_v3_cryptocurrency_listings_latest', array_keys($provider->tools()));
        self::assertContains('coinmarketcap_get_v1_key_info', array_keys($provider->tools()));
    }

    public function test_service_maps_api_key_query_and_json_body_requests(): void
    {
        Http::fake(['*' => Http::response(['data' => ['ok' => true], 'status' => ['error_code' => 0]], 200)]);

        $service = new CoinMarketCapService('cmc-key', 'https://cmc.example.test');
        $service->request('GET', '/v3/cryptocurrency/quotes/latest', ['symbol' => 'BTC,ETH', 'convert' => 'USD']);
        $service->request('POST', '/v1/dex/tokens/trending/list', [], ['network_slug' => 'ethereum']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://cmc.example.test/v3/cryptocurrency/quotes/latest?symbol=BTC%2CETH&convert=USD'
            && $request->hasHeader('X-CMC_PRO_API_KEY', 'cmc-key')
            && $request->hasHeader('Accept', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://cmc.example.test/v1/dex/tokens/trending/list'
            && $request['network_slug'] === 'ethereum');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['data' => ['ok' => true], 'status' => ['error_code' => 0]], 200)]);

        $service = new CoinMarketCapService('cmc-key', 'https://cmc.example.test');

        self::assertTrue((new CoinMarketCapGetV3CryptocurrencyQuotesLatest($service))->execute(['symbol' => 'BTC', 'convert' => 'USD'])->succeeded());
        self::assertTrue((new CoinMarketCapGetV3CryptocurrencyListingsLatest($service))->execute(['start' => 1, 'limit' => 10])->succeeded());
        self::assertTrue((new CoinMarketCapGetV1KeyInfo($service))->execute([])->succeeded());
        self::assertTrue((new CoinMarketCapPostV1DexTokensTrendingList($service))->execute(['body' => ['network_slug' => 'ethereum']])->succeeded());

        $badBody = (new CoinMarketCapPostV1DexTokensTrendingList($service))->execute(['body' => 'not-object']);
        $unconfigured = (new CoinMarketCapGetV3CryptocurrencyQuotesLatest(new CoinMarketCapService('', 'https://cmc.example.test')))->execute(['symbol' => 'BTC']);

        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $badBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_key_info_endpoint(): void
    {
        Http::fake(['cmc.example.test/v1/key/info' => Http::response(['data' => ['plan' => 'example']], 200)]);

        $result = (new CoinMarketCapToolProvider)->testConnection(['api_key' => 'cmc-key', 'url' => 'https://cmc.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://cmc.example.test/v1/key/info'
            && $request->hasHeader('X-CMC_PRO_API_KEY', 'cmc-key'));
    }
}
