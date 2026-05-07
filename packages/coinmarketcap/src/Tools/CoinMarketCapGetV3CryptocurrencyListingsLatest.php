<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Cryptocurrency Listings.
 *
 * Maps to the official CoinMarketCap endpoint GET /v3/cryptocurrency/listings/latest.
 */
class CoinMarketCapGetV3CryptocurrencyListingsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v3_cryptocurrency_listings_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/cryptocurrency/listings/latest.';
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/cryptocurrency/listings/latest';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'price_min' => 'price_min',
        'price_max' => 'price_max',
        'market_cap_min' => 'market_cap_min',
        'market_cap_max' => 'market_cap_max',
        'volume_24h_min' => 'volume_24h_min',
        'volume_24h_max' => 'volume_24h_max',
        'circulating_supply_min' => 'circulating_supply_min',
        'circulating_supply_max' => 'circulating_supply_max',
        'percent_change_24h_min' => 'percent_change_24h_min',
        'percent_change_24h_max' => 'percent_change_24h_max',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'sort' => 'sort',
        'sort_dir' => 'sort_dir',
        'cryptocurrency_type' => 'cryptocurrency_type',
        'tag' => 'tag',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
