<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CoinGecko;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\CoinGecko\CoinGeckoService;
use OpenCompany\Integrations\CoinGecko\CoinGeckoToolProvider;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoApiGet;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoListExchanges;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoSimpleTokenPrice;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for CoinGecko API v3 endpoint coverage.
 */
final class CoinGeckoServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_market_exchange_category_and_treasury_endpoints(): void
    {
        Http::fake([
            'https://api.coingecko.test/api/v3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CoinGeckoService('cg_test', 'https://api.coingecko.test/api/v3');

        $service->listCoins(['include_platform' => 'true']);
        $service->listNewCoins();
        $service->getTopGainersLosers('usd', ['duration' => '24h']);
        $service->getCoinTickers('bitcoin', ['page' => 1]);
        $service->getCoinHistory('bitcoin', '30-12-2025');
        $service->getSimpleTokenPrice('ethereum', ['0x0000000000000000000000000000000000000000'], ['usd']);
        $service->listAssetPlatforms(['filter' => 'nft']);
        $service->getTokenList('ethereum');
        $service->listCategories();
        $service->listCategoriesWithMarketData(['order' => 'market_cap_desc']);
        $service->listExchanges(['per_page' => 25]);
        $service->listExchangeIds();
        $service->getExchange('binance');
        $service->getExchangeTickers('binance', ['coin_ids' => 'bitcoin']);
        $service->getExchangeVolumeChart('binance', 30);
        $service->getExchangeRates();
        $service->getGlobalDefi();
        $service->listEntities();
        $service->getPublicTreasuryByCoin('companies', 'bitcoin', ['per_page' => 10]);
        $service->getPublicTreasuryEntity('strategy');
        $service->apiGet('/derivatives');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('x-cg-demo-api-key', 'cg_test'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/coins/list?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/coins/list/new');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/coins/top_gainers_losers?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/coins/bitcoin/tickers?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/coins/bitcoin/history?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/simple/token_price/ethereum?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/asset_platforms?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/token_lists/ethereum/all.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/coins/categories/list');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/coins/categories?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/exchanges?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/exchanges/list');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/exchanges/binance');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/exchanges/binance/tickers?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/exchanges/binance/volume_chart?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/exchange_rates');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/global/decentralized_finance_defi');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/entities/list');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.coingecko.test/api/v3/companies/public_treasury/bitcoin?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/public_treasury/strategy');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/derivatives');
    }

    public function test_new_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://api.coingecko.test/api/v3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CoinGeckoService('cg_test', 'https://api.coingecko.test/api/v3');

        self::assertTrue((new CoinGeckoSimpleTokenPrice($service))->execute([
            'asset_platform_id' => 'ethereum',
            'contract_addresses' => '0x0000000000000000000000000000000000000000',
            'currencies' => 'usd,eur',
        ])->succeeded());
        self::assertTrue((new CoinGeckoListExchanges($service))->execute([
            'params' => ['per_page' => 10],
        ])->succeeded());
        self::assertTrue((new CoinGeckoApiGet($service))->execute([
            'path' => '/nfts/list',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/simple/token_price/ethereum?'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/exchanges?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.coingecko.test/api/v3/nfts/list');
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.coingecko.com/api/v3/simple/price*' => Http::response(['bitcoin' => ['usd' => 100000]], 200),
        ]);

        $provider = new CoinGeckoToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('coingecko_list_coins', $tools);
        self::assertArrayHasKey('coingecko_simple_token_price', $tools);
        self::assertArrayHasKey('coingecko_list_asset_platforms', $tools);
        self::assertArrayHasKey('coingecko_list_exchanges', $tools);
        self::assertArrayHasKey('coingecko_exchange_rates', $tools);
        self::assertArrayHasKey('coingecko_public_treasury_by_coin', $tools);
        self::assertArrayHasKey('coingecko_api_get', $tools);
        self::assertSame(29, count($tools));
        self::assertTrue($provider->testConnection(['api_key' => 'cg_test'])['success']);
    }
}
