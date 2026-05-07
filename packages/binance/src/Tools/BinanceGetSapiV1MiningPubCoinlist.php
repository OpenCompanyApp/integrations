<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Acquiring CoinName (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/mining/pub/coinList.
 */
class BinanceGetSapiV1MiningPubCoinlist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_mining_pub_coinlist';
    protected const DESCRIPTION = 'Acquiring CoinName (MARKET_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/mining/pub/coinList.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/mining/pub/coinList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
