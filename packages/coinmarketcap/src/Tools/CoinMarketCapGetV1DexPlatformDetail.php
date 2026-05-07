<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get platform detail.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/platform/detail.
 */
class CoinMarketCapGetV1DexPlatformDetail extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_platform_detail';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/platform/detail.';
    protected const PARAMETERS = [
        'platformname' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Platform name',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/platform/detail';
    protected const QUERY_PARAMS = [
        'platformName' => 'platformname',
    ];
    protected const BODY_REQUIRED = false;
}
