<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Categories.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/categories.
 */
class CoinMarketCapGetV1CryptocurrencyCategories extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_categories';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/categories.';
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/cryptocurrency/categories';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
    ];
    protected const BODY_REQUIRED = false;
}
