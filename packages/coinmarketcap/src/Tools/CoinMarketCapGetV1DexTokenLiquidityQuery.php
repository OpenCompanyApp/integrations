<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Query token liquidity.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/token-liquidity/query.
 */
class CoinMarketCapGetV1DexTokenLiquidityQuery extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_token_liquidity_query';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/token-liquidity/query.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/token-liquidity/query';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'address' => 'address',
        'interval' => 'interval',
        'limit' => 'limit',
        'to' => 'to',
        'needLatest' => 'needlatest',
    ];
    protected const BODY_REQUIRED = false;
}
