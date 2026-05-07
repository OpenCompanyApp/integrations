<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get token price.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/token/price.
 */
class CoinMarketCapGetV1DexTokenPrice extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_token_price';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/token/price.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/token/price';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'address' => 'address',
    ];
    protected const BODY_REQUIRED = false;
}
