<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get platform list.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/dex/platform/list.
 */
class CoinMarketCapGetV1DexPlatformList extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_dex_platform_list';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/dex/platform/list.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/dex/platform/list';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
