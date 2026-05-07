<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Simple Price.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/simple/price.
 */
class CoinMarketCapGetV1SimplePrice extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_simple_price';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/simple/price.';
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/simple/price';
    protected const QUERY_PARAMS = [
        'ids' => 'ids',
        'include_market_cap' => 'include_market_cap',
        'include_volume_24h' => 'include_volume_24h',
        'include_percent_change_24h' => 'include_percent_change_24h',
        'include_last_updated' => 'include_last_updated',
    ];
    protected const BODY_REQUIRED = false;
}
