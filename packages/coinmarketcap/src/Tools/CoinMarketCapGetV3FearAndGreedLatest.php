<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * CMC Crypto Fear and Greed Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v3/fear-and-greed/latest.
 */
class CoinMarketCapGetV3FearAndGreedLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v3_fear_and_greed_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/fear-and-greed/latest.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/fear-and-greed/latest';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
