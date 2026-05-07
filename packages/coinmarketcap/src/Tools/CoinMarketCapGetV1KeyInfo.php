<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Key Info.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/key/info.
 */
class CoinMarketCapGetV1KeyInfo extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_key_info';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/key/info.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/key/info';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
