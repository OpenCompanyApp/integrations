<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get security detail.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/security/detail.
 */
class CoinMarketCapGetV1DexSecurityDetail extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_security_detail';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/security/detail.';
    protected const PARAMETERS = [
        'platformname' => [
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
    protected const PATH = '/v1/dex/security/detail';
    protected const QUERY_PARAMS = [
        'platformName' => 'platformname',
        'address' => 'address',
    ];
    protected const BODY_REQUIRED = false;
}
