<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * DEX Metadata.
 *
 * Maps to the official CoinMarketCap endpoint GET /v4/dex/listings/info.
 */
class CoinMarketCapGetV4DexListingsInfo extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v4_dex_listings_info';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/listings/info.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency exchange ids.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`""`
Valid values: `"urls"` `"logo"` `"description"` `"date_launched"` `"notice"`
Optionally specify a comma-separated list of supplemental data fields to return.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v4/dex/listings/info';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
