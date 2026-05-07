<?php

namespace OpenCompany\Integrations\CoinMarketCap;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyAirdrop;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyAirdrops;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyCategories;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyCategory;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyMap;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2CryptocurrencyInfo;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyListingsHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyListingsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyListingsNew;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyTrendingGainersLosers;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyTrendingLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyTrendingMostVisited;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2CryptocurrencyMarketPairsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2CryptocurrencyOhlcvHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2CryptocurrencyOhlcvLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2CryptocurrencyPricePerformanceStatsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3CryptocurrencyQuotesHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3CryptocurrencyQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3CryptocurrencyListingsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1SimplePrice;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ExchangeAssets;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ExchangeInfo;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ExchangeMap;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ExchangeListingsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ExchangeMarketPairsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ExchangeQuotesHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ExchangeQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3FearAndGreedHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3FearAndGreedLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1GlobalMetricsQuotesHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1GlobalMetricsQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1AltcoinSeasonIndexLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1AltcoinSeasonIndexHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ContentLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ContentPostsComments;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ContentPostsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ContentPostsTop;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CommunityTrendingToken;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CommunityTrendingTopic;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3IndexCmc100Historical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3IndexCmc100Latest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3IndexCmc20Historical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV3IndexCmc20Latest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexTokensTrendingList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexTokensBatchQuery;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexTokenPriceBatch;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexNewList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexMemeList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexGainerLoserList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexSpotPairsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexPairsQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexToken;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexTokenPrice;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexTokenPools;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexTokenLiquidityQuery;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexTokensTransactions;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexSecurityDetail;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexSearch;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexLiquidityChangeList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexPlatformList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexPlatformDetail;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexHoldersList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapPostV1DexHoldersDetail;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexHoldersTrendList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexHoldersTagCount;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1DexHoldersCount;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1KLinePoints;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1KLineCandles;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1FiatMap;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1KeyInfo;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ToolsPostman;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2ToolsPriceConversion;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1BlockchainStatisticsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyInfo;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1ToolsPriceConversion;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyMarketPairsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyOhlcvHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyOhlcvLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyPricePerformanceStatsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyQuotesHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1CryptocurrencyQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2CryptocurrencyQuotesHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV2CryptocurrencyQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1PartnersFlipsideCryptoFcasListingsLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV1PartnersFlipsideCryptoFcasQuotesLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexPairsTradeLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexPairsOhlcvLatest;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexPairsOhlcvHistorical;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexNetworksList;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexListingsQuotes;
use OpenCompany\Integrations\CoinMarketCap\Tools\CoinMarketCapGetV4DexListingsInfo;

/**
 * Tool catalog and configuration metadata for CoinMarketCap.
 *
 * Exposes the official CoinMarketCap Pro API reference as endpoint-specific
 * tools and resolves account-specific API keys for multi-account hosts.
 */
class CoinMarketCapToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['api_key'], 'notes' => ['CoinMarketCap Pro API requests use the X-CMC_PRO_API_KEY header.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'coinmarketcap'; }
    public function appMeta(): array { return ['label' => 'CoinMarketCap', 'description' => 'Cryptocurrency prices, listings, quotes, historical data, exchanges, DEX data, market metrics, content, community trends, indices, and utility endpoints', 'icon' => 'ph:currency-btc', 'logo' => 'ph:currency-btc']; }
    public function integrationMeta(): array { return ['name' => 'CoinMarketCap', 'description' => 'Fetch CoinMarketCap Pro API market data, crypto metadata, listings, quotes, exchange data, global metrics, DEX tokens, holders, OHLCV data, news, community trends, CMC indices, and utilities.', 'icon' => 'ph:currency-btc', 'logo' => 'ph:currency-btc', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://pro.coinmarketcap.com/api/documentation/']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'CoinMarketCap Pro API key', 'hint' => 'Sent as X-CMC_PRO_API_KEY.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://pro-api.coinmarketcap.com', 'default' => 'https://pro-api.coinmarketcap.com']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://pro-api.coinmarketcap.com'), '/');
        if ($apiKey === '') { return ['success' => false, 'error' => 'CoinMarketCap API key is required.']; }

        try {
            $response = Http::withHeaders(['Accept' => 'application/json', 'Accept-Encoding' => 'deflate, gzip', 'X-CMC_PRO_API_KEY' => $apiKey])->timeout(10)->get($baseUrl . '/v1/key/info');
            if (!$response->successful()) { return ['success' => false, 'error' => 'CoinMarketCap API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to CoinMarketCap at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'required|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'coinmarketcap_get_v1_cryptocurrency_airdrop' => [
                'class' => CoinMarketCapGetV1CryptocurrencyAirdrop::class,
                'name' => 'Airdrop',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/airdrop.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Airdrop Unique ID. This can be found using the Airdrops API.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_airdrops' => [
                'class' => CoinMarketCapGetV1CryptocurrencyAirdrops::class,
                'name' => 'Airdrops',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/airdrops.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What status of airdrops.',
                        'enum' => [
                            'ENDED',
                            'ONGOING',
                            'UPCOMING',
                        ],
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filtered airdrops by one cryptocurrency CoinMarketCap IDs. Example: 1',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively filter airdrops by a cryptocurrency slug. Example: "bitcoin"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively filter airdrops one cryptocurrency symbol. Example: "BTC".',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_categories' => [
                'class' => CoinMarketCapGetV1CryptocurrencyCategories::class,
                'name' => 'Categories',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/categories.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filtered categories by one or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively filter categories by a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively filter categories one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH".',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_category' => [
                'class' => CoinMarketCapGetV1CryptocurrencyCategory::class,
                'name' => 'Category',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/category.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Category ID. This can be found using the Categories API.',
                    ],
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of coins to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of coins to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_map' => [
                'class' => CoinMarketCapGetV1CryptocurrencyMap::class,
                'name' => 'CoinMarketCap ID Map',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/map.',
                'parameters' => [
                    'listing_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only active cryptocurrencies are returned by default. Pass `inactive` to get a list of cryptocurrencies that are no longer active. Pass `untracked` to get a list of cryptocurrencies that are listed but do not yet meet methodology requirements to have tracked markets available. You may pass one or more comma-separated values.',
                    ],
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list of cryptocurrencies by.',
                        'enum' => [
                            'cmc_rank',
                            'id',
                        ],
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally pass a comma-separated list of cryptocurrency symbols to return CoinMarketCap IDs for. If this option is passed, other options will be ignored.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `platform,first_historical_data,last_historical_data,is_active,status` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v2_cryptocurrency_info' => [
                'class' => CoinMarketCapGetV2CryptocurrencyInfo::class,
                'name' => 'Cryptocurrency Metadata',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/info.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,2"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request. Please note that starting in the v2 endpoint, due to the fact that a symbol is not unique, if you request by symbol each data response will contain an array of objects containing all of the coins that use each requested symbol. The v1 endpoint will still return a single object, the highest ranked coin using that symbol.',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass in a contract address. Example: "0xc40af1e4fecfa05ce6bab79dcd8b373d2e436c4e"',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `urls,logo,description,tags,platform,date_added,notice,status` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_listings_historical' => [
                'class' => CoinMarketCapGetV1CryptocurrencyListingsHistorical::class,
                'name' => 'Listings Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/listings/historical.',
                'parameters' => [
                    'date' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'date (Unix or ISO 8601) to reference day of snapshot.',
                    ],
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list of cryptocurrencies by.',
                        'enum' => [
                            'cmc_rank',
                            'name',
                            'symbol',
                            'market_cap',
                            'price',
                            'circulating_supply',
                            'total_supply',
                            'max_supply',
                            'num_market_pairs',
                            'volume_24h',
                            'percent_change_1h',
                            'percent_change_24h',
                            'percent_change_7d',
                        ],
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The direction in which to order cryptocurrencies against the specified sort.',
                        'enum' => [
                            'asc',
                            'desc',
                        ],
                    ],
                    'cryptocurrency_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The type of cryptocurrency to include.',
                        'enum' => [
                            'all',
                            'coins',
                            'tokens',
                        ],
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `platform,tags,date_added,circulating_supply,total_supply,max_supply,cmc_rank,num_market_pairs` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_listings_latest' => [
                'class' => CoinMarketCapGetV1CryptocurrencyListingsLatest::class,
                'name' => 'Listings Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/listings/latest.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'price_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum USD price to filter results by.',
                    ],
                    'price_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum USD price to filter results by.',
                    ],
                    'market_cap_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum market cap to filter results by.',
                    ],
                    'market_cap_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum market cap to filter results by.',
                    ],
                    'volume_24h_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum 24 hour USD volume to filter results by.',
                    ],
                    'volume_24h_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum 24 hour USD volume to filter results by.',
                    ],
                    'circulating_supply_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum circulating supply to filter results by.',
                    ],
                    'circulating_supply_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum circulating supply to filter results by.',
                    ],
                    'percent_change_24h_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum 24 hour percent change to filter results by.',
                    ],
                    'percent_change_24h_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum 24 hour percent change to filter results by.',
                    ],
                    'self_reported_circulating_supply_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum self reported circulating supply to filter results by.',
                    ],
                    'self_reported_circulating_supply_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum self reported circulating supply to filter results by.',
                    ],
                    'self_reported_market_cap_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum self reported market cap to filter results by.',
                    ],
                    'self_reported_market_cap_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum self reported market cap to filter results by.',
                    ],
                    'unlocked_market_cap_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum unlocked market cap to filter results by.',
                    ],
                    'unlocked_market_cap_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum unlocked market cap to filter results by.',
                    ],
                    'unlocked_circulating_supply_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum unlocked circulating supply to filter results by.',
                    ],
                    'unlocked_circulating_supply_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum unlocked circulating supply to filter results by.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list of cryptocurrencies by.',
                        'enum' => [
                            'name',
                            'symbol',
                            'date_added',
                            'market_cap',
                            'market_cap_strict',
                            'price',
                            'circulating_supply',
                            'total_supply',
                            'max_supply',
                            'num_market_pairs',
                            'volume_24h',
                            'percent_change_1h',
                            'percent_change_24h',
                            'percent_change_7d',
                            'market_cap_by_total_supply_strict',
                            'volume_7d',
                            'volume_30d',
                        ],
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The direction in which to order cryptocurrencies against the specified sort.',
                        'enum' => [
                            'asc',
                            'desc',
                        ],
                    ],
                    'cryptocurrency_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The type of cryptocurrency to include.',
                        'enum' => [
                            'all',
                            'coins',
                            'tokens',
                        ],
                    ],
                    'tag' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The tag of cryptocurrency to include.',
                        'enum' => [
                            'all',
                            'defi',
                            'filesharing',
                        ],
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply,market_cap_by_total_supply,volume_24h_reported,volume_7d,volume_7d_reported,volume_30d,volume_30d_reported,is_market_cap_included_in_calc` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_listings_new' => [
                'class' => CoinMarketCapGetV1CryptocurrencyListingsNew::class,
                'name' => 'Listings New',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/listings/new.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The direction in which to order cryptocurrencies against the specified sort.',
                        'enum' => [
                            'asc',
                            'desc',
                        ],
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_trending_gainers_losers' => [
                'class' => CoinMarketCapGetV1CryptocurrencyTrendingGainersLosers::class,
                'name' => 'Trending Gainers & Losers',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/trending/gainers-losers.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Adjusts the overall window of time for the biggest gainers and losers.',
                        'enum' => [
                            '1h',
                            '24h',
                            '30d',
                            '7d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list of cryptocurrencies by.',
                        'enum' => [
                            'percent_change_24h',
                        ],
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The direction in which to order cryptocurrencies against the specified sort.',
                        'enum' => [
                            'asc',
                            'desc',
                        ],
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_trending_latest' => [
                'class' => CoinMarketCapGetV1CryptocurrencyTrendingLatest::class,
                'name' => 'Trending Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/trending/latest.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Adjusts the overall window of time for the latest trending coins.',
                        'enum' => [
                            '24h',
                            '30d',
                            '7d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_trending_most_visited' => [
                'class' => CoinMarketCapGetV1CryptocurrencyTrendingMostVisited::class,
                'name' => 'Trending Most Visited',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/trending/most-visited.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Adjusts the overall window of time for most visited currencies.',
                        'enum' => [
                            '24h',
                            '30d',
                            '7d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v2_cryptocurrency_market_pairs_latest' => [
                'class' => CoinMarketCapGetV2CryptocurrencyMarketPairsLatest::class,
                'name' => 'Cryptocurrency Market Pairs Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/market-pairs/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A cryptocurrency or fiat currency by CoinMarketCap ID to list market pairs for. Example: "1"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a cryptocurrency by slug. Example: "bitcoin"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a cryptocurrency by symbol. Fiat currencies are not supported by this field. Example: "BTC". A single cryptocurrency "id", "slug", *or* "symbol" is required.',
                    ],
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the sort direction of markets returned.',
                        'enum' => [
                            'asc',
                            'desc',
                        ],
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the sort order of markets returned. By default we return a strict sort on 24 hour reported volume. Pass `cmc_rank` to return a CMC methodology based sort where markets with excluded volumes are returned last.',
                        'enum' => [
                            'volume_24h_strict',
                            'cmc_rank',
                            'cmc_rank_advanced',
                            'effective_liquidity',
                            'market_score',
                            'market_reputation',
                        ],
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,category,fee_type,market_url,currency_name,currency_slug,price_quote,notice,cmc_rank,effective_liquidity,market_score,market_reputation` to include all auxiliary fields.',
                    ],
                    'matched_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally include one or more fiat or cryptocurrency IDs to filter market pairs by. For example `?id=1&matched_id=2781` would only return BTC markets that matched: "BTC/USD" or "USD/BTC". This parameter cannot be used when `matched_symbol` is used.',
                    ],
                    'matched_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally include one or more fiat or cryptocurrency symbols to filter market pairs by. For example `?symbol=BTC&matched_symbol=USD` would only return BTC markets that matched: "BTC/USD" or "USD/BTC". This parameter cannot be used when `matched_id` is used.',
                    ],
                    'category' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The category of trading this market falls under. Spot markets are the most common but options include derivatives and OTC.',
                        'enum' => [
                            'all',
                            'spot',
                            'derivatives',
                            'otc',
                            'perpetual',
                        ],
                    ],
                    'fee_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The fee type the exchange enforces for this market.',
                        'enum' => [
                            'all',
                            'percentage',
                            'no-fees',
                            'transactional-mining',
                            'unknown',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v2_cryptocurrency_ohlcv_historical' => [
                'class' => CoinMarketCapGetV2CryptocurrencyOhlcvHistorical::class,
                'name' => 'OHLCV Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/ohlcv/historical.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,1027"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Time period to return OHLCV data for. The default is "daily". If hourly, the open will be 01:00 and the close will be 01:59. If daily, the open will be 00:00:00 for the day and close will be 23:59:99 for the same day. See the main endpoint description for details.',
                        'enum' => [
                            'daily',
                            'hourly',
                        ],
                    ],
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning OHLCV time periods for. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning OHLCV time periods for (inclusive). Optional, if not passed we\'ll default to the current time. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally limit the number of time periods to return results for. The default is 10 items. The current query limit is 10000 items.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally adjust the interval that "time_period" is sampled. For example with interval=monthly&time_period=daily you will see a daily OHLCV record for January, February, March and so on. See main endpoint description for available options.',
                        'enum' => [
                            'hourly',
                            'daily',
                            'weekly',
                            'monthly',
                            'yearly',
                            '1h',
                            '2h',
                            '3h',
                            '4h',
                            '6h',
                            '12h',
                            '1d',
                            '2d',
                            '3d',
                            '7d',
                            '14d',
                            '15d',
                            '30d',
                            '60d',
                            '90d',
                            '365d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 fiat currencies or cryptocurrencies.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v2_cryptocurrency_ohlcv_latest' => [
                'class' => CoinMarketCapGetV2CryptocurrencyOhlcvLatest::class,
                'name' => 'OHLCV Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/ohlcv/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "symbol" is required.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v2_cryptocurrency_price_performance_stats_latest' => [
                'class' => CoinMarketCapGetV2CryptocurrencyPricePerformanceStatsLatest::class,
                'name' => 'Price Performance Stats',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/price-performance-stats/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Specify one or more comma-delimited time periods to return stats for. `all_time` is the default. Pass `all_time,yesterday,24h,7d,30d,90d,365d` to return all supported time periods. All rolling periods have a rolling close time of the current request time. For example `24h` would have a close time of now and an open time of 24 hours before now. *Please note: `yesterday` is a UTC period and currently does not currently support `high` and `low` timestamps.*',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_cryptocurrency_quotes_historical' => [
                'class' => CoinMarketCapGetV3CryptocurrencyQuotesHistorical::class,
                'name' => 'Cryptocurrency Quotes Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/cryptocurrency/quotes/historical.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,2"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "symbol" is required for this request.',
                    ],
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning quotes for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning quotes for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 10 items. The current query limit is 10000.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Interval of time to return data points for. See details in endpoint description.',
                        'enum' => [
                            'yearly',
                            'monthly',
                            'weekly',
                            'daily',
                            'hourly',
                            '5m',
                            '10m',
                            '15m',
                            '30m',
                            '45m',
                            '1h',
                            '2h',
                            '3h',
                            '4h',
                            '6h',
                            '12h',
                            '24h',
                            '1d',
                            '2d',
                            '3d',
                            '7d',
                            '14d',
                            '15d',
                            '30d',
                            '60d',
                            '90d',
                            '365d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 other fiat currencies or cryptocurrencies.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `price,volume,market_cap,circulating_supply,total_supply,quote_timestamp,is_active,is_fiat,search_interval` to include all auxiliary fields.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_cryptocurrency_quotes_latest' => [
                'class' => CoinMarketCapGetV3CryptocurrencyQuotesLatest::class,
                'name' => 'Cryptocurrency Quotes Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/cryptocurrency/quotes/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs.',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs.',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                    'skip_invalid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_cryptocurrency_listings_latest' => [
                'class' => CoinMarketCapGetV3CryptocurrencyListingsLatest::class,
                'name' => 'Cryptocurrency Listings',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/cryptocurrency/listings/latest.',
                'parameters' => [
                    'start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the \\"start\\" parameter to determine your own pagination size.',
                    ],
                    'price_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum USD price to filter results by.',
                    ],
                    'price_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum USD price to filter results by.',
                    ],
                    'market_cap_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum market cap to filter results by.',
                    ],
                    'market_cap_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum market cap to filter results by.',
                    ],
                    'volume_24h_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum 24 hour USD volume to filter results by.',
                    ],
                    'volume_24h_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum 24 hour USD volume to filter results by.',
                    ],
                    'circulating_supply_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum circulating supply to filter results by.',
                    ],
                    'circulating_supply_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum circulating supply to filter results by.',
                    ],
                    'percent_change_24h_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum 24 hour percent change to filter results by.',
                    ],
                    'percent_change_24h_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum 24 hour percent change to filter results by.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list of cryptocurrencies by.',
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The direction in which to order cryptocurrencies against the specified sort.',
                    ],
                    'cryptocurrency_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The type of cryptocurrency to include.',
                    ],
                    'tag' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The tag of cryptocurrency to include.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply,market_cap_by_total_supply,volume_24h_reported,volume_7d,volume_7d_reported,volume_30d,volume_30d_reported,is_market_cap_included_in_calc to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_simple_price' => [
                'class' => CoinMarketCapGetV1SimplePrice::class,
                'name' => 'Simple Price',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/simple/price.',
                'parameters' => [
                    'ids' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Comma-separated list of CoinMarketCap cryptocurrency IDs. Example: "1,1027". Max query size 50.',
                    ],
                    'include_market_cap' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Include market cap values in the response.',
                    ],
                    'include_volume_24h' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Include 24-hour volume in the response.',
                    ],
                    'include_percent_change_24h' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Include 24-hour price change percentage in the response.',
                    ],
                    'include_last_updated' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Include last updated timestamp in the response.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_exchange_assets' => [
                'class' => CoinMarketCapGetV1ExchangeAssets::class,
                'name' => 'Exchange Assets',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/assets.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A CoinMarketCap exchange ID. Example: 270',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_exchange_info' => [
                'class' => CoinMarketCapGetV1ExchangeInfo::class,
                'name' => 'Metadata',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/info.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency exchange ids. Example: "1,2"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one or more comma-separated exchange names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens). Example: "binance,gdax". At least one "id" *or* "slug" is required.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `urls,logo,description,date_launched,notice,status` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_exchange_map' => [
                'class' => CoinMarketCapGetV1ExchangeMap::class,
                'name' => 'CoinMarketCap ID Map',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/map.',
                'parameters' => [
                    'listing_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Only active exchanges are returned by default. Pass `inactive` to get a list of exchanges that are no longer active. Pass `untracked` to get a list of exchanges that are registered but do not currently meet methodology requirements to have active markets tracked. You may pass one or more comma-separated values.',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally pass a comma-separated list of exchange slugs (lowercase URL friendly shorthand name with spaces replaced with dashes) to return CoinMarketCap IDs for. If this option is passed, other options will be ignored.',
                    ],
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list of exchanges by.',
                        'enum' => [
                            'volume_24h',
                            'id',
                        ],
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `first_historical_data,last_historical_data,is_active,status` to include all auxiliary fields.',
                    ],
                    'crypto_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally include one fiat or cryptocurrency IDs to filter market pairs by. For example `?crypto_id=1` would only return exchanges that have BTC.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_exchange_listings_latest' => [
                'class' => CoinMarketCapGetV1ExchangeListingsLatest::class,
                'name' => 'Exchange Listings Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/listings/latest.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list of exchanges by.',
                        'enum' => [
                            'name',
                            'volume_24h',
                            'volume_24h_adjusted',
                            'exchange_score',
                        ],
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The direction in which to order exchanges against the specified sort.',
                        'enum' => [
                            'asc',
                            'desc',
                        ],
                    ],
                    'market_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The type of exchange markets to include in rankings. This field is deprecated. Please use "all" for accurate sorting.',
                        'enum' => [
                            'fees',
                            'no_fees',
                            'all',
                        ],
                    ],
                    'category' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The category for this exchange.',
                        'enum' => [
                            'all',
                            'spot',
                            'derivatives',
                            'dex',
                            'lending',
                        ],
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,traffic_score,rank,exchange_score,effective_liquidity_24h,date_launched,fiats` to include all auxiliary fields.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_exchange_market_pairs_latest' => [
                'class' => CoinMarketCapGetV1ExchangeMarketPairsLatest::class,
                'name' => 'Market Pairs Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/market-pairs/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A CoinMarketCap exchange ID. Example: "1"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass an exchange "slug" (URL friendly all lowercase shorthand version of name with spaces replaced with hyphens). Example: "binance". One "id" *or* "slug" is required.',
                    ],
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,category,fee_type,market_url,currency_name,currency_slug,price_quote,effective_liquidity,market_score,market_reputation` to include all auxiliary fields.',
                    ],
                    'matched_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally include one or more comma-delimited fiat or cryptocurrency IDs to filter market pairs by. For example `?matched_id=2781` would only return BTC markets that matched: "BTC/USD" or "USD/BTC" for the requested exchange. This parameter cannot be used when `matched_symbol` is used.',
                    ],
                    'matched_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally include one or more comma-delimited fiat or cryptocurrency symbols to filter market pairs by. For example `?matched_symbol=USD` would only return BTC markets that matched: "BTC/USD" or "USD/BTC" for the requested exchange. This parameter cannot be used when `matched_id` is used.',
                    ],
                    'category' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The category of trading this market falls under. Spot markets are the most common but options include derivatives and OTC.',
                        'enum' => [
                            'all',
                            'spot',
                            'derivatives',
                            'otc',
                            'futures',
                            'perpetual',
                        ],
                    ],
                    'fee_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The fee type the exchange enforces for this market.',
                        'enum' => [
                            'all',
                            'percentage',
                            'no-fees',
                            'transactional-mining',
                            'unknown',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_exchange_quotes_historical' => [
                'class' => CoinMarketCapGetV1ExchangeQuotesHistorical::class,
                'name' => 'Quotes Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/quotes/historical.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated exchange CoinMarketCap ids. Example: "24,270"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one or more comma-separated exchange names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens). Example: "binance,kraken". At least one "id" *or* "slug" is required.',
                    ],
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning quotes for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning quotes for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 10 items. The current query limit is 10000.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Interval of time to return data points for. See details in endpoint description.',
                        'enum' => [
                            'yearly',
                            'monthly',
                            'weekly',
                            'daily',
                            'hourly',
                            '5m',
                            '10m',
                            '15m',
                            '30m',
                            '45m',
                            '1h',
                            '2h',
                            '3h',
                            '4h',
                            '6h',
                            '12h',
                            '24h',
                            '1d',
                            '2d',
                            '3d',
                            '7d',
                            '14d',
                            '15d',
                            '30d',
                            '60d',
                            '90d',
                            '365d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 other fiat currencies or cryptocurrencies.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_exchange_quotes_latest' => [
                'class' => CoinMarketCapGetV1ExchangeQuotesLatest::class,
                'name' => 'Quotes Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/quotes/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap exchange IDs. Example: "1,2"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, pass a comma-separated list of exchange "slugs" (URL friendly all lowercase shorthand version of name with spaces replaced with hyphens). Example: "binance,gdax". At least one "id" *or* "slug" is required.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,traffic_score,rank,exchange_score,liquidity_score,effective_liquidity_24h` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_fear_and_greed_historical' => [
                'class' => CoinMarketCapGetV3FearAndGreedHistorical::class,
                'name' => 'CMC Crypto Fear and Greed Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/fear-and-greed/historical.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_fear_and_greed_latest' => [
                'class' => CoinMarketCapGetV3FearAndGreedLatest::class,
                'name' => 'CMC Crypto Fear and Greed Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/fear-and-greed/latest.',
                'parameters' => [],
            ],
            'coinmarketcap_get_v1_global_metrics_quotes_historical' => [
                'class' => CoinMarketCapGetV1GlobalMetricsQuotesHistorical::class,
                'name' => 'Quotes Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/global-metrics/quotes/historical.',
                'parameters' => [
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning quotes for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning quotes for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 10 items. The current query limit is 10000.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Interval of time to return data points for. See details in endpoint description.',
                        'enum' => [
                            'yearly',
                            'monthly',
                            'weekly',
                            'daily',
                            'hourly',
                            '5m',
                            '10m',
                            '15m',
                            '30m',
                            '45m',
                            '1h',
                            '2h',
                            '3h',
                            '4h',
                            '6h',
                            '12h',
                            '24h',
                            '1d',
                            '2d',
                            '3d',
                            '7d',
                            '14d',
                            '15d',
                            '30d',
                            '60d',
                            '90d',
                            '365d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 other fiat currencies or cryptocurrencies.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `btc_dominance,eth_dominance,active_cryptocurrencies,active_exchanges,active_market_pairs,total_volume_24h,total_volume_24h_reported,altcoin_market_cap,altcoin_volume_24h,altcoin_volume_24h_reported,search_interval` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_global_metrics_quotes_latest' => [
                'class' => CoinMarketCapGetV1GlobalMetricsQuotesLatest::class,
                'name' => 'Quotes Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/global-metrics/quotes/latest.',
                'parameters' => [
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_altcoin_season_index_latest' => [
                'class' => CoinMarketCapGetV1AltcoinSeasonIndexLatest::class,
                'name' => 'Altcoin Season Index Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/altcoin-season-index/latest.',
                'parameters' => [],
            ],
            'coinmarketcap_get_v1_altcoin_season_index_historical' => [
                'class' => CoinMarketCapGetV1AltcoinSeasonIndexHistorical::class,
                'name' => 'Altcoin Season Index Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/altcoin-season-index/historical.',
                'parameters' => [
                    'timeframe' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timeframe for historical data. Valid values are 7d, 30d, and 90d. Default is 7d.',
                        'enum' => [
                            '7d',
                            '30d',
                            '90d',
                        ],
                    ],
                ],
            ],
            'coinmarketcap_get_v1_content_latest' => [
                'class' => CoinMarketCapGetV1ContentLatest::class,
                'name' => 'Content Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/latest.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally pass a comma-separated list of CoinMarketCap cryptocurrency IDs. Example: "1,1027"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally pass a comma-separated list of cryptocurrency symbols. Example: "BTC,ETH". Optionally pass "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'news_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields: `news`, `community`, or `alexandria` to filter news sources. Pass `all` or leave it blank to include all news types.',
                    ],
                    'content_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields: `news`, `video`, or `audio` to filter news\'s content. Pass `all` or leave it blank to include all content types.',
                    ],
                    'category' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally pass a comma-separated list of categories. Example: "GameFi,NFT".',
                    ],
                    'language' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally pass a language code. Example: "en". If not specified the default value is "en".',
                        'enum' => [
                            'en',
                            'zh',
                            'zh-tw',
                            'de',
                            'id',
                            'ja',
                            'ko',
                            'es',
                            'th',
                            'tr',
                            'vi',
                            'ru',
                            'fr',
                            'nl',
                            'ar',
                            'pt-br',
                            'hi',
                            'pl',
                            'uk',
                            'fil-rph',
                            'it',
                        ],
                    ],
                ],
            ],
            'coinmarketcap_get_v1_content_posts_comments' => [
                'class' => CoinMarketCapGetV1ContentPostsComments::class,
                'name' => 'Content Post Comments',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/posts/comments.',
                'parameters' => [
                    'post_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Required post ID. Example: 325670123',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_content_posts_latest' => [
                'class' => CoinMarketCapGetV1ContentPostsLatest::class,
                'name' => 'Content Latest Posts',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/posts/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional one cryptocurrency CoinMarketCap ID. Example: 1027',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one cryptocurrency slug. Example: "ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one cryptocurrency symbols. Example: "ETH"',
                    ],
                    'last_score' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional. The score is given in the response for finding next batch posts. Example: 1662903634322',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_content_posts_top' => [
                'class' => CoinMarketCapGetV1ContentPostsTop::class,
                'name' => 'Content Top Posts',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/posts/top.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional one cryptocurrency CoinMarketCap ID. Example: 1027',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one cryptocurrency slug. Example: "ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one cryptocurrency symbols. Example: "ETH"',
                    ],
                    'last_score' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional. The score is given in the response for finding next batch of related posts. Example: 38507.8865',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_community_trending_token' => [
                'class' => CoinMarketCapGetV1CommunityTrendingToken::class,
                'name' => 'Community Trending Tokens',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/community/trending/token.',
                'parameters' => [
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_community_trending_topic' => [
                'class' => CoinMarketCapGetV1CommunityTrendingTopic::class,
                'name' => 'Community Trending Topics',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/community/trending/topic.',
                'parameters' => [
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return.',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_index_cmc100_historical' => [
                'class' => CoinMarketCapGetV3IndexCmc100Historical::class,
                'name' => 'CoinMarketCap 100 Index Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/index/cmc100-historical.',
                'parameters' => [
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning CoinMarketCap 100 Index data for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning CoinMarketCap 100 Index data for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 5 items. If "time_start" and "time_end" are supplied, the query limit is 10 and the count starts from "time_start".',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally adjust the interval of data returned.Valid values:"5m","15m","daily".',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_index_cmc100_latest' => [
                'class' => CoinMarketCapGetV3IndexCmc100Latest::class,
                'name' => 'CoinMarketCap 100 Index Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/index/cmc100-latest.',
                'parameters' => [],
            ],
            'coinmarketcap_get_v3_index_cmc20_historical' => [
                'class' => CoinMarketCapGetV3IndexCmc20Historical::class,
                'name' => 'CoinMarketCap 20 Index Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/index/cmc20-historical.',
                'parameters' => [
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning CoinMarketCap 20 Index data for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning CoinMarketCap 20 Index data for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 5 items. If "time_start" and "time_end" are supplied, the query limit is 10 and the count starts from "time_start".',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally adjust the interval of data returned.Valid values:"5m","15m","daily".',
                    ],
                ],
            ],
            'coinmarketcap_get_v3_index_cmc20_latest' => [
                'class' => CoinMarketCapGetV3IndexCmc20Latest::class,
                'name' => 'CoinMarketCap 20 Index Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/index/cmc20-latest.',
                'parameters' => [],
            ],
            'coinmarketcap_post_v1_dex_tokens_trending_list' => [
                'class' => CoinMarketCapPostV1DexTokensTrendingList::class,
                'name' => 'Get trending tokens',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/tokens/trending/list.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_post_v1_dex_tokens_batch_query' => [
                'class' => CoinMarketCapPostV1DexTokensBatchQuery::class,
                'name' => 'Batch query tokens',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/tokens/batch-query.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_post_v1_dex_token_price_batch' => [
                'class' => CoinMarketCapPostV1DexTokenPriceBatch::class,
                'name' => 'Batch get token prices',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/token/price/batch.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_post_v1_dex_new_list' => [
                'class' => CoinMarketCapPostV1DexNewList::class,
                'name' => 'Get new tokens',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/new/list.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_post_v1_dex_meme_list' => [
                'class' => CoinMarketCapPostV1DexMemeList::class,
                'name' => 'Get meme tokens',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/meme/list.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_post_v1_dex_gainer_loser_list' => [
                'class' => CoinMarketCapPostV1DexGainerLoserList::class,
                'name' => 'Get top gainers and losers',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/gainer-loser/list.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_spot_pairs_latest' => [
                'class' => CoinMarketCapGetV4DexSpotPairsLatest::class,
                'name' => 'Pairs Listings Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/spot-pairs/latest.',
                'parameters' => [
                    'network_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency network ids.',
                    ],
                    'network_slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one or more comma-separated network names in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
                    ],
                    'dex_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap dex exchange ids',
                    ],
                    'dex_slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one or more comma-separated dex exchange names in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
                    ],
                    'base_asset_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency ids.',
                    ],
                    'base_asset_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one or more comma-separated network symbol in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens).At least one id or slug is required.',
                    ],
                    'base_asset_contract_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one base asset contract address in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens).At least one id or slug is required.',
                    ],
                    'base_asset_ucid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs.',
                    ],
                    'quote_asset_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency ids.',
                    ],
                    'quote_asset_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one or more comma-separated network symbol in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
                    ],
                    'quote_asset_contract_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one quote asset contract address in URL friendly shorthand slug format (all lowercase, spaces replaced with hyphens). At least one id or slug is required.',
                    ],
                    'quote_asset_ucid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs.',
                    ],
                    'scroll_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'After your initial query, the API responds with the initial set of results and a scroll_ids. To retrieve the next set of results, provide this scroll_id of the last JSON with your follow-up request. scroll_id is an alternative to traditional pagination techniques.',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the start parameter to determine your own pagination size.',
                    ],
                    'liquidity_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum liquidity to filter results by.',
                    ],
                    'liquidity_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum liquidity to filter results by.',
                    ],
                    'volume_24h_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum 24 hour USD volume to filter results by.',
                    ],
                    'volume_24h_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum 24 hour USD volume to filter results by.',
                    ],
                    'no_of_transactions_24h_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum 24h no. of transactions to filter results by.',
                    ],
                    'no_of_transactions_24h_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum 24h no. of transactions to filter results by.',
                    ],
                    'percent_change_24h_min' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of minimum 24 hour percent change to filter results by.',
                    ],
                    'percent_change_24h_max' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a threshold of maximum 24 hour percent change to filter results by.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"volume_24h"`
Valid values:  `"volume_24h"` `"liquidity"` `"no_of_transactions_24h"` `"percent_change_24h"` // todo
Sort the list of dex spot pairs by.',
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"desc"`
Valid values: `"desc"` `"asc"`
The direction in which to order dex spot pairs against the specified sort.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"pool_created"` `"percent_pooled_base_asset"` `"num_transactions_24h"` `"pool_base_asset"` `"pool_quote_asset"` `"24h_volume_quote_asset"` `"total_supply_quote_asset"` `"total_supply_base_asset"` `"holders"` `"buy_tax"` `"sell_tax"` `"security_scan"` `"24h_no_of_buys"` `"24h_no_of_sells"` `"24h_buy_volume"` `"24h_sell_volume"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                    'reverse_order' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true Token B/Token A pairing as it exists in the pool.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to convert outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when convert is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_pairs_quotes_latest' => [
                'class' => CoinMarketCapGetV4DexPairsQuotesLatest::class,
                'name' => 'Quotes Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/pairs/quotes/latest.',
                'parameters' => [
                    'contract_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated contract addresses.',
                    ],
                    'network_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more CoinMarketCap cryptocurrency network ids',
                    ],
                    'network_slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one network names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens).',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"pool_created"` `"percent_pooled_base_asset"` `"num_transactions_24h"` `"pool_base_asset"` `"pool_quote_asset"` `"24h_volume_quote_asset"` `"total_supply_quote_asset"` `"total_supply_base_asset"` `"holders"` `"buy_tax"` `"sell_tax"` `"security_scan"` `"24h_no_of_buys"` `"24h_no_of_sells"` `"24h_buy_volume"` `"24h_sell_volume"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to convert outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when convert is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to relax request validation rules. When requesting records on multiple spot pairs an error is returned if no match is found for 1 or more requested spot pairs. If set to true, invalid lookups will be skipped allowing valid spot pairs to still be returned.',
                    ],
                    'reverse_order' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true Token B/Token A pairing as it exists in the pool.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_token' => [
                'class' => CoinMarketCapGetV1DexToken::class,
                'name' => 'Get token detail',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/token.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token address',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_token_price' => [
                'class' => CoinMarketCapGetV1DexTokenPrice::class,
                'name' => 'Get token price',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/token/price.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token address',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_token_pools' => [
                'class' => CoinMarketCapGetV1DexTokenPools::class,
                'name' => 'Get token pools',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/token/pools.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token address',
                    ],
                    'size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Query parameter `size`.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_token_liquidity_query' => [
                'class' => CoinMarketCapGetV1DexTokenLiquidityQuery::class,
                'name' => 'Query token liquidity',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/token-liquidity/query.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token address',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Time interval',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Result limit',
                    ],
                    'to' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'End timestamp',
                    ],
                    'needlatest' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to include latest value',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_tokens_transactions' => [
                'class' => CoinMarketCapGetV1DexTokensTransactions::class,
                'name' => 'Get swap list',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/tokens/transactions.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Blockchain platform name (bsc/sol/etc)',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token contract address',
                    ],
                    'type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Transaction type (0 for buy, 1 for sell)',
                    ],
                    'types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Transaction types filter, supports: buy, sell, open, close, add, reduce',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'maker' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Maker address, support comma separated list',
                    ],
                    'sortby' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Field to sort by (currently only supports \'time\')',
                    ],
                    'sorttype' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort direction (\'asc\' or \'desc\', default is \'desc\')',
                    ],
                    'starttime' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Start timestamp (inclusive)',
                    ],
                    'endtime' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'End timestamp (inclusive)',
                    ],
                    'minvolume' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Minimum volume (inclusive)',
                    ],
                    'maxvolume' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Maximum volume (inclusive)',
                    ],
                    'lastid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor for pagination, format: ts_txHash_logId',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Result limit',
                    ],
                    'version' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Version',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_security_detail' => [
                'class' => CoinMarketCapGetV1DexSecurityDetail::class,
                'name' => 'Get security detail',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/security/detail.',
                'parameters' => [
                    'platformname' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token address',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_search' => [
                'class' => CoinMarketCapGetV1DexSearch::class,
                'name' => 'Search tokens',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/search.',
                'parameters' => [
                    'q' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search keyword',
                    ],
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform filter',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort field',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Result limit',
                    ],
                    'code' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Code filter',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_liquidity_change_list' => [
                'class' => CoinMarketCapGetV1DexLiquidityChangeList::class,
                'name' => 'Get liquidity change list',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/liquidity-change/list.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Blockchain platform name (bsc/sol/etc)',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token contract address',
                    ],
                    'type' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Liquidity change type',
                    ],
                    'maker' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Maker address, support comma separated list',
                    ],
                    'sortby' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Field to sort by (currently only supports \'ts\')',
                    ],
                    'sorttype' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort direction (\'asc\' or \'desc\', default is \'desc\')',
                    ],
                    'starttime' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Start timestamp (inclusive)',
                    ],
                    'endtime' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'End timestamp (inclusive)',
                    ],
                    'minvolume' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Minimum USD volume (inclusive)',
                    ],
                    'maxvolume' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Maximum USD volume (inclusive)',
                    ],
                    'lastid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor for pagination, format: ts_txHash_logId',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Result limit',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_platform_list' => [
                'class' => CoinMarketCapGetV1DexPlatformList::class,
                'name' => 'Get platform list',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/platform/list.',
                'parameters' => [],
            ],
            'coinmarketcap_get_v1_dex_platform_detail' => [
                'class' => CoinMarketCapGetV1DexPlatformDetail::class,
                'name' => 'Get platform detail',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/platform/detail.',
                'parameters' => [
                    'platformname' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name',
                    ],
                ],
            ],
            'coinmarketcap_post_v1_dex_holders_list' => [
                'class' => CoinMarketCapPostV1DexHoldersList::class,
                'name' => 'Get holders list',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/holders/list.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_post_v1_dex_holders_detail' => [
                'class' => CoinMarketCapPostV1DexHoldersDetail::class,
                'name' => 'Get holder detail',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/holders/detail.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_holders_trend_list' => [
                'class' => CoinMarketCapGetV1DexHoldersTrendList::class,
                'name' => 'Get holder trend list',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/holders/trend/list.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name or id',
                    ],
                    'tokenaddress' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token  address',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Kline interval: 1d',
                    ],
                    'from' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'start timestamp',
                    ],
                    'to' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'End timestamp',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of to load',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_holders_tag_count' => [
                'class' => CoinMarketCapGetV1DexHoldersTagCount::class,
                'name' => 'Get holder tag count',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/holders/tag_count.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Query parameter `platform`.',
                    ],
                    'tokenaddress' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Query parameter `tokenAddress`.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_dex_holders_count' => [
                'class' => CoinMarketCapGetV1DexHoldersCount::class,
                'name' => 'Get holder count',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/holders/count.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Query parameter `platform`.',
                    ],
                    'tokenaddress' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Query parameter `tokenAddress`.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_k_line_points' => [
                'class' => CoinMarketCapGetV1KLinePoints::class,
                'name' => 'Get K-line points',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/k-line/points.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name or id',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token or pool address',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Kline interval: 1s/5s/30s/1min/3min/5min/15min/30min/1h/2h/4h/6h/8h/12h/1d/3d/1w/1m',
                    ],
                    'from' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Start timestamp (UNIX epoch)',
                    ],
                    'to' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'End timestamp (UNIX epoch)',
                    ],
                    'unit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Kline unit: usd, native, quote',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of points to load',
                    ],
                    'pm' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Kline type: p (price), m (marketcap)',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_k_line_candles' => [
                'class' => CoinMarketCapGetV1KLineCandles::class,
                'name' => 'Get K-line candles',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/k-line/candles.',
                'parameters' => [
                    'platform' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Platform name or id',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token or pool address',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Kline interval: 1s/5s/30s/1min/3min/5min/15min/30min/1h/2h/4h/6h/8h/12h/1d/3d/1w/1m',
                    ],
                    'from' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Start timestamp (UNIX epoch)',
                    ],
                    'to' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'End timestamp (UNIX epoch)',
                    ],
                    'unit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Kline unit: usd, native, quote',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of candles to load',
                    ],
                    'pm' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Kline type: p (price), m (marketcap)',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_fiat_map' => [
                'class' => CoinMarketCapGetV1FiatMap::class,
                'name' => 'Fiat ID Map',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/fiat/map.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'What field to sort the list by.',
                        'enum' => [
                            'name',
                            'id',
                        ],
                    ],
                    'include_metals' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to include precious metals.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_key_info' => [
                'class' => CoinMarketCapGetV1KeyInfo::class,
                'name' => 'Key Info',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/key/info.',
                'parameters' => [],
            ],
            'coinmarketcap_get_v1_tools_postman' => [
                'class' => CoinMarketCapGetV1ToolsPostman::class,
                'name' => 'Postman Conversion v1',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/tools/postman.',
                'parameters' => [],
            ],
            'coinmarketcap_get_v2_tools_price_conversion' => [
                'class' => CoinMarketCapGetV2ToolsPriceConversion::class,
                'name' => 'Price Conversion v2',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/tools/price-conversion.',
                'parameters' => [
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'An amount of currency to convert. Example: 10.43',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The CoinMarketCap currency ID of the base cryptocurrency or fiat to convert from. Example: "1"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively the currency symbol of the base cryptocurrency or fiat to convert from. Example: "BTC". One "id" *or* "symbol" is required. Please note that starting in the v2 endpoint, due to the fact that a symbol is not unique, if you request by symbol each quote response will contain an array of objects containing all of the coins that use each requested symbol. The v1 endpoint will still return a single object, the highest ranked coin using that symbol.',
                    ],
                    'time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional timestamp (Unix or ISO 8601) to reference historical pricing during conversion. If not passed, the current time will be used. If passed, we\'ll reference the closest historic values available for this conversion.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass up to 120 comma-separated fiat or cryptocurrency symbols to convert the source amount to.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_blockchain_statistics_latest' => [
                'class' => CoinMarketCapGetV1BlockchainStatisticsLatest::class,
                'name' => 'Statistics Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/blockchain/statistics/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs to return blockchain data for. Pass `1,2,1027` to request all currently supported blockchains.',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Pass `BTC,LTC,ETH` to request all currently supported blockchains.',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Pass `bitcoin,litecoin,ethereum` to request all currently supported blockchains.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_info' => [
                'class' => CoinMarketCapGetV1CryptocurrencyInfo::class,
                'name' => 'Metadata v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/info.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,2"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request. Please note that starting in the v2 endpoint, due to the fact that a symbol is not unique, if you request by symbol each data response will contain an array of objects containing all of the coins that use each requested symbol. The v1 endpoint will still return a single object, the highest ranked coin using that symbol.',
                    ],
                    'address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass in a contract address. Example: "0xc40af1e4fecfa05ce6bab79dcd8b373d2e436c4e"',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `urls,logo,description,tags,platform,date_added,notice,status` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_tools_price_conversion' => [
                'class' => CoinMarketCapGetV1ToolsPriceConversion::class,
                'name' => 'Price Conversion v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/tools/price-conversion.',
                'parameters' => [
                    'amount' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'An amount of currency to convert. Example: 10.43',
                    ],
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The CoinMarketCap currency ID of the base cryptocurrency or fiat to convert from. Example: "1"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively the currency symbol of the base cryptocurrency or fiat to convert from. Example: "BTC". One "id" *or* "symbol" is required. Please note that starting in the v2 endpoint, due to the fact that a symbol is not unique, if you request by symbol each quote response will contain an array of objects containing all of the coins that use each requested symbol. The v1 endpoint will still return a single object, the highest ranked coin using that symbol.',
                    ],
                    'time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional timestamp (Unix or ISO 8601) to reference historical pricing during conversion. If not passed, the current time will be used. If passed, we\'ll reference the closest historic values available for this conversion.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass up to 120 comma-separated fiat or cryptocurrency symbols to convert the source amount to.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_market_pairs_latest' => [
                'class' => CoinMarketCapGetV1CryptocurrencyMarketPairsLatest::class,
                'name' => 'Market Pairs Latest v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/market-pairs/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A cryptocurrency or fiat currency by CoinMarketCap ID to list market pairs for. Example: "1"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a cryptocurrency by slug. Example: "bitcoin"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a cryptocurrency by symbol. Fiat currencies are not supported by this field. Example: "BTC". A single cryptocurrency "id", "slug", *or* "symbol" is required.',
                    ],
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the sort direction of markets returned.',
                        'enum' => [
                            'asc',
                            'desc',
                        ],
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the sort order of markets returned. By default we return a strict sort on 24 hour reported volume. Pass `cmc_rank` to return a CMC methodology based sort where markets with excluded volumes are returned last.',
                        'enum' => [
                            'volume_24h_strict',
                            'cmc_rank',
                            'cmc_rank_advanced',
                            'effective_liquidity',
                            'market_score',
                            'market_reputation',
                        ],
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,category,fee_type,market_url,currency_name,currency_slug,price_quote,notice,cmc_rank,effective_liquidity,market_score,market_reputation` to include all auxiliary fields.',
                    ],
                    'matched_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally include one or more fiat or cryptocurrency IDs to filter market pairs by. For example `?id=1&matched_id=2781` would only return BTC markets that matched: "BTC/USD" or "USD/BTC". This parameter cannot be used when `matched_symbol` is used.',
                    ],
                    'matched_symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally include one or more fiat or cryptocurrency symbols to filter market pairs by. For example `?symbol=BTC&matched_symbol=USD` would only return BTC markets that matched: "BTC/USD" or "USD/BTC". This parameter cannot be used when `matched_id` is used.',
                    ],
                    'category' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The category of trading this market falls under. Spot markets are the most common but options include derivatives and OTC.',
                        'enum' => [
                            'all',
                            'spot',
                            'derivatives',
                            'otc',
                            'perpetual',
                        ],
                    ],
                    'fee_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The fee type the exchange enforces for this market.',
                        'enum' => [
                            'all',
                            'percentage',
                            'no-fees',
                            'transactional-mining',
                            'unknown',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_ohlcv_historical' => [
                'class' => CoinMarketCapGetV1CryptocurrencyOhlcvHistorical::class,
                'name' => 'OHLCV Historical v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/ohlcv/historical.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,1027"',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Time period to return OHLCV data for. The default is "daily". If hourly, the open will be 01:00 and the close will be 01:59. If daily, the open will be 00:00:00 for the day and close will be 23:59:99 for the same day. See the main endpoint description for details.',
                        'enum' => [
                            'daily',
                            'hourly',
                        ],
                    ],
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning OHLCV time periods for. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning OHLCV time periods for (inclusive). Optional, if not passed we\'ll default to the current time. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Optionally limit the number of time periods to return results for. The default is 10 items. The current query limit is 10000 items.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally adjust the interval that "time_period" is sampled. For example with interval=monthly&time_period=daily you will see a daily OHLCV record for January, February, March and so on. See main endpoint description for available options.',
                        'enum' => [
                            'hourly',
                            'daily',
                            'weekly',
                            'monthly',
                            'yearly',
                            '1h',
                            '2h',
                            '3h',
                            '4h',
                            '6h',
                            '12h',
                            '1d',
                            '2d',
                            '3d',
                            '7d',
                            '14d',
                            '15d',
                            '30d',
                            '60d',
                            '90d',
                            '365d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 fiat currencies or cryptocurrencies.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_ohlcv_latest' => [
                'class' => CoinMarketCapGetV1CryptocurrencyOhlcvLatest::class,
                'name' => 'OHLCV Latest v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/ohlcv/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "symbol" is required.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_price_performance_stats_latest' => [
                'class' => CoinMarketCapGetV1CryptocurrencyPricePerformanceStatsLatest::class,
                'name' => 'Price Performance Stats v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/price-performance-stats/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Specify one or more comma-delimited time periods to return stats for. `all_time` is the default. Pass `all_time,yesterday,24h,7d,30d,90d,365d` to return all supported time periods. All rolling periods have a rolling close time of the current request time. For example `24h` would have a close time of now and an open time of 24 hours before now. *Please note: `yesterday` is a UTC period and currently does not currently support `high` and `low` timestamps.*',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_quotes_historical' => [
                'class' => CoinMarketCapGetV1CryptocurrencyQuotesHistorical::class,
                'name' => 'Quotes Historical v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/quotes/historical.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,2"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "symbol" is required for this request.',
                    ],
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning quotes for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning quotes for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 10 items. The current query limit is 10000.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Interval of time to return data points for. See details in endpoint description.',
                        'enum' => [
                            'yearly',
                            'monthly',
                            'weekly',
                            'daily',
                            'hourly',
                            '5m',
                            '10m',
                            '15m',
                            '30m',
                            '45m',
                            '1h',
                            '2h',
                            '3h',
                            '4h',
                            '6h',
                            '12h',
                            '24h',
                            '1d',
                            '2d',
                            '3d',
                            '7d',
                            '14d',
                            '15d',
                            '30d',
                            '60d',
                            '90d',
                            '365d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 other fiat currencies or cryptocurrencies.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `price,volume,market_cap,circulating_supply,total_supply,quote_timestamp,is_active,is_fiat,search_interval` to include all auxiliary fields.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_cryptocurrency_quotes_latest' => [
                'class' => CoinMarketCapGetV1CryptocurrencyQuotesLatest::class,
                'name' => 'Quotes Latest v1 (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/quotes/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply,market_cap_by_total_supply,volume_24h_reported,volume_7d,volume_7d_reported,volume_30d,volume_30d_reported,is_active,is_fiat` to include all auxiliary fields.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v2_cryptocurrency_quotes_historical' => [
                'class' => CoinMarketCapGetV2CryptocurrencyQuotesHistorical::class,
                'name' => 'Quotes Historical v2',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/quotes/historical.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,2"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "symbol" is required for this request.',
                    ],
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning quotes for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning quotes for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 10 items. The current query limit is 10000.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Interval of time to return data points for. See details in endpoint description.',
                        'enum' => [
                            'yearly',
                            'monthly',
                            'weekly',
                            'daily',
                            'hourly',
                            '5m',
                            '10m',
                            '15m',
                            '30m',
                            '45m',
                            '1h',
                            '2h',
                            '3h',
                            '4h',
                            '6h',
                            '12h',
                            '24h',
                            '1d',
                            '2d',
                            '3d',
                            '7d',
                            '14d',
                            '15d',
                            '30d',
                            '60d',
                            '90d',
                            '365d',
                        ],
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 other fiat currencies or cryptocurrencies.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `price,volume,market_cap,circulating_supply,total_supply,quote_timestamp,is_active,is_fiat,search_interval` to include all auxiliary fields.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v2_cryptocurrency_quotes_latest' => [
                'class' => CoinMarketCapGetV2CryptocurrencyQuotesLatest::class,
                'name' => 'Quotes Latest v2',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/quotes/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'convert' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `num_market_pairs,cmc_rank,date_added,tags,platform,max_supply,circulating_supply,total_supply,market_cap_by_total_supply,volume_24h_reported,volume_7d,volume_7d_reported,volume_30d,volume_30d_reported,is_active,is_fiat` to include all auxiliary fields.',
                    ],
                    'skip_invalid' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if no match is found for 1 or more requested cryptocurrencies. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_partners_flipside_crypto_fcas_listings_latest' => [
                'class' => CoinMarketCapGetV1PartnersFlipsideCryptoFcasListingsLatest::class,
                'name' => 'FCAS Listings Latest (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/partners/flipside-crypto/fcas/listings/latest.',
                'parameters' => [
                    'start' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `point_change_24h,percent_change_24h` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v1_partners_flipside_crypto_fcas_quotes_latest' => [
                'class' => CoinMarketCapGetV1PartnersFlipsideCryptoFcasQuotesLatest::class,
                'name' => 'FCAS Quotes Latest (deprecated)',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/partners/flipside-crypto/fcas/quotes/latest.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated cryptocurrency CoinMarketCap IDs. Example: 1,2',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
                    ],
                    'symbol' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `point_change_24h,percent_change_24h` to include all auxiliary fields.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_pairs_trade_latest' => [
                'class' => CoinMarketCapGetV4DexPairsTradeLatest::class,
                'name' => 'Trades Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/pairs/trade/latest.',
                'parameters' => [
                    'contract_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated contract addresses.',
                    ],
                    'network_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One CoinMarketCap cryptocurrency network id.',
                    ],
                    'network_slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one network names in URL friendly shorthand "slug"
format (all lowercase, spaces replaced with hyphens).',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"transaction_hash"` `"blockchain_explorer_link"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 30 currencies at once by passing a comma-separated list of cryptocurrency
or fiat currency IDs. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found in our API document. Each conversion is returned in its
own "trade" object.',
                    ],
                    'skip_invalid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to relax request validation rules. When requesting records on multiple spot pairs an error is returned
if no match is found for 1 or more requested spot pairs. If set to true, invalid lookups will be skipped allowing valid
spot pairs to still be returned.',
                    ],
                    'reverse_order' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and
is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true
Token B/Token A pairing as it exists in the pool.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_pairs_ohlcv_latest' => [
                'class' => CoinMarketCapGetV4DexPairsOhlcvLatest::class,
                'name' => 'OHLCV Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/pairs/ohlcv/latest.',
                'parameters' => [
                    'contract_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated contract addresses.',
                    ],
                    'network_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more CoinMarketCap cryptocurrency network ids',
                    ],
                    'network_slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one network names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens).',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"pool_created"` `"percent_pooled_base_asset"` `"num_transactions_24h"` `"pool_base_asset"` `"pool_quote_asset"` `"24h_volume_quote_asset"` `"total_supply_quote_asset"` `"total_supply_base_asset"` `"holders"` `"buy_tax"` `"sell_tax"` `"security_scan"` `"24h_no_of_buys"` `"24h_no_of_sells"` `"24h_buy_volume"` `"24h_sell_volume"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to convert outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when convert is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to relax request validation rules. When requesting records on multiple spot pairs an error is returned if no match is found for 1 or more requested spot pairs. If set to true, invalid lookups will be skipped allowing valid spot pairs to still be returned.',
                    ],
                    'reverse_order' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true Token B/Token A pairing as it exists in the pool.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_pairs_ohlcv_historical' => [
                'class' => CoinMarketCapGetV4DexPairsOhlcvHistorical::class,
                'name' => 'OHLCV Historical',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/pairs/ohlcv/historical.',
                'parameters' => [
                    'contract_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One contract address. Example:"0x88e6a0c2ddd26feeb64f039a2c41296fcb3f5640".
If network/dex/base asset/quote asset information is passed, contract address cannot be passed.
Note: contract_address is case sensitive for all non-EVM chains and not case sensitive for all EVM chains. EVM chains contract address addresses begin with 0x, and are followed by 40 alphanumeric characters(numerals and letters)',
                    ],
                    'network_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more CoinMarketCap cryptocurrency network ids',
                    ],
                    'network_slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Alternatively, one network names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens).',
                    ],
                    'time_period' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"daily"`
Valid values: `"daily"` `"hourly"` `"1m"` `"5m"` `"15m"` `"4h"`
Time period to return OHLCV data for. If hourly, the open will be 01:00 and the close will be 01:59. If daily, the open will be 00:00:00 for the day and close will be 23:59:99 for the same day. See the main endpoint description for details.',
                    ],
                    'time_start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to start returning OHLCV time periods for. Only the date portion of the timestamp
is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
                    ],
                    'time_end' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Timestamp (Unix or ISO 8601) to stop returning OHLCV time periods for (inclusive). Optional, if not passed we\'ll default
to the current time. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an
ISO date format like "2018-09-19" without time.',
                    ],
                    'count' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally limit the number of time periods to return results for. The default is 10 items. The current query
limit is 500 items.',
                    ],
                    'interval' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"daily"`
Valid values: `"1m"` `"5m"` `"15m"` `"30m"` `"1h"` `"4h"` `"8h"` `"12h"` `"daily"` `"weekly"` `"monthly"`
Optionally adjust the interval that "time_period" is sampled. For example with interval=monthly&time_period=daily you will see a daily OHLCV record for January, February, March and so on. See main endpoint description for available options.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"pool_created"` `"percent_pooled_base_asset"` `"num_transactions_24h"` `"pool_base_asset"` `"pool_quote_asset"` `"24h_volume_quote_asset"` `"total_supply_quote_asset"` `"total_supply_base_asset"` `"holders"` `"buy_tax"` `"sell_tax"` `"security_scan"` `"24h_no_of_buys"` `"24h_no_of_sells"` `"24h_buy_volume"` `"24h_sell_volume"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to convert outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when convert is used.',
                    ],
                    'skip_invalid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to relax request validation rules. When requesting records on multiple spot pairs an error is returned if no match is found for 1 or more requested spot pairs. If set to true, invalid lookups will be skipped allowing valid spot pairs to still be returned.',
                    ],
                    'reverse_order' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pass true to invert the order of a spot pair. For example, a trading pair is set up as Token B/Token A in the contract and is commonly referred to as Token A/Token B. Using reverse_order would change the order to reflect the true Token B/Token A pairing as it exists in the pool.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_networks_list' => [
                'class' => CoinMarketCapGetV4DexNetworksList::class,
                'name' => 'CoinMarketCap ID Map',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/networks/list.',
                'parameters' => [
                    'start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the
"start" parameter to determine your own pagination size.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"id"`
Valid values: `"id"` `"name"`
What field to sort the list of networks by.',
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"desc"`
Valid values: `"desc"` `"asc"`
The direction in which to order networks against the specified sort.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"alternativeName"` `"cryptocurrencyId"` `"cryptocurrenySlug"` `"wrappedTokenId"` `"wrappedTokenSlug"` `"tokenExplorerUrl"` `"poolExplorerUrl"` `"transactionHashUrl"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_listings_quotes' => [
                'class' => CoinMarketCapGetV4DexListingsQuotes::class,
                'name' => 'DEX Listings Latest',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/listings/quotes.',
                'parameters' => [
                    'start' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
                    ],
                    'limit' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally specify the number of results to return. Use this parameter and the
"start" parameter to determine your own pagination size.',
                    ],
                    'sort' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"volume_24h"`
Valid values: `"name"` `"volume_24h"` `"market_share"` `"num_markets"`
What field to sort the list of exchanges by.',
                    ],
                    'sort_dir' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"desc"`
Valid values: `"desc"` `"asc"`
The direction in which to order exchanges against the specified sort.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`"all"`
Valid values: `"all"` `"orderbook"` `"swap"` `"aggregator"`
The category for this exchange.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"date_launched"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                    'convert_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optionally calculate market quotes in up to 30 currencies at once by passing a comma-separated list of cryptocurrency
or fiat currency IDs. Each additional convert option beyond the first requires an additional call credit. A list of
supported fiat options can be found in our API document. Each conversion is returned in its own "quote" object.',
                    ],
                ],
            ],
            'coinmarketcap_get_v4_dex_listings_info' => [
                'class' => CoinMarketCapGetV4DexListingsInfo::class,
                'name' => 'DEX Metadata',
                'description' => 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/listings/info.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'One or more comma-separated CoinMarketCap cryptocurrency exchange ids.',
                    ],
                    'aux' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Default:`""`
Valid values: `"urls"` `"logo"` `"description"` `"date_launched"` `"notice"`
Optionally specify a comma-separated list of supplemental data fields to return.',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): CoinMarketCapService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new CoinMarketCapService(apiKey: $creds->get('coinmarketcap', 'api_key', '', $account), baseUrl: $creds->get('coinmarketcap', 'url', 'https://pro-api.coinmarketcap.com', $account));
        }

        return app(CoinMarketCapService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/coinmarketcap.md'; }
    public function isIntegration(): bool { return true; }
}
