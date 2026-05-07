<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query auto-converting stable coins (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/contract/convertible-coins.
 */
class BinanceGetSapiV1CapitalContractConvertibleCoins extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_contract_convertible_coins';
    protected const DESCRIPTION = 'Query auto-converting stable coins (USER_DATA)

Get a user\'s auto-conversion settings in deposit/withdrawal Weight(UID): 600\'

Official Binance Spot endpoint: GET /sapi/v1/capital/contract/convertible-coins.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/capital/contract/convertible-coins';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
