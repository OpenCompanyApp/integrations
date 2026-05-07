<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get holder count.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/holders/count.
 */
class CoinMarketCapGetV1DexHoldersCount extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_holders_count';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/holders/count.';
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/holders/count';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'tokenAddress' => 'tokenaddress',
    ];
    protected const BODY_REQUIRED = false;
}
