<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Detail on Sub-account's Futures Account (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/futures/account.
 */
class BinanceGetSapiV1SubAccountFuturesAccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_futures_account';
    protected const DESCRIPTION = 'Detail on Sub-account\'s Futures Account (For Master Account)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/sub-account/futures/account.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
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
    protected const PATH = '/sapi/v1/sub-account/futures/account';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
