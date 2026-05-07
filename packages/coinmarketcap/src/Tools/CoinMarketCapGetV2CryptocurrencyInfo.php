<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Cryptocurrency Metadata.
 *
 * Maps to the official CoinMarketCap endpoint GET /v2/cryptocurrency/info.
 */
class CoinMarketCapGetV2CryptocurrencyInfo extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v2_cryptocurrency_info';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v2/cryptocurrency/info.';
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v2/cryptocurrency/info';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'address' => 'address',
        'skip_invalid' => 'skip_invalid',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
