<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Summary of Sub-account's Futures Account V2 (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v2/sub-account/futures/accountSummary.
 */
class BinanceGetSapiV2SubAccountFuturesAccountsummary extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v2_sub_account_futures_accountsummary';
    protected const DESCRIPTION = 'Summary of Sub-account\'s Futures Account V2 (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v2/sub-account/futures/accountSummary.';
    protected const PARAMETERS = [
        'futures_type' => [
            'type' => 'integer',
            'required' => true,
            'description' => '* `1` - USDT Margined Futures * `2` - COIN Margined Futures',
        ],
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 10, Max 20',
        ],
        'recv_window' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The value cannot be greater than 60000',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v2/sub-account/futures/accountSummary';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'futuresType' => 'futures_type',
        'page' => 'page',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
