<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Quotes Latest v2.
 *
 * Maps to the official CoinMarketCap endpoint GET /v2/cryptocurrency/quotes/latest.
 */
class CoinMarketCapGetV2CryptocurrencyQuotesLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v2_cryptocurrency_quotes_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/quotes/latest.';
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v2/cryptocurrency/quotes/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'aux' => 'aux',
        'skip_invalid' => 'skip_invalid',
    ];
    protected const BODY_REQUIRED = false;
}
