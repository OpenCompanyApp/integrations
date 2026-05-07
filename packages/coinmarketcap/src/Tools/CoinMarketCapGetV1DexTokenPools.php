<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get token pools.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/token/pools.
 */
class CoinMarketCapGetV1DexTokenPools extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_token_pools';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/token/pools.';
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/token/pools';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'address' => 'address',
        'size' => 'size',
    ];
    protected const BODY_REQUIRED = false;
}
