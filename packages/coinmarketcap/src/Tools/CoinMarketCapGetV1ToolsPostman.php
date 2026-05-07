<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Postman Conversion v1.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/tools/postman.
 */
class CoinMarketCapGetV1ToolsPostman extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_tools_postman';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/tools/postman.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/tools/postman';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
