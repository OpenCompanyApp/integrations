<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Fetch withdraw address list (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/capital/withdraw/address/list.
 */
class BinanceGetSapiV1CapitalWithdrawAddressList extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_capital_withdraw_address_list';
    protected const DESCRIPTION = 'Fetch withdraw address list (USER_DATA)

Fetch withdraw address list Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/capital/withdraw/address/list.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/capital/withdraw/address/list';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
