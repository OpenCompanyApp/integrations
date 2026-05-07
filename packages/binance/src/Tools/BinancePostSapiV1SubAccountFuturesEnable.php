<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Enable Futures for Sub-account (For Master Account).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/sub-account/futures/enable.
 */
class BinancePostSapiV1SubAccountFuturesEnable extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_sub_account_futures_enable';
    protected const DESCRIPTION = 'Enable Futures for Sub-account (For Master Account)

Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/sub-account/futures/enable.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Sub-account email',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/sub-account/futures/enable';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
