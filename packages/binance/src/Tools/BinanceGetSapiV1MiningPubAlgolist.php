<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Acquiring Algorithm (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/mining/pub/algoList.
 */
class BinanceGetSapiV1MiningPubAlgolist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_mining_pub_algolist';
    protected const DESCRIPTION = 'Acquiring Algorithm (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/mining/pub/algoList.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/mining/pub/algoList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
