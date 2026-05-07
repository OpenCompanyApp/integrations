<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Cross Margin Account Details (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/account.
 */
class BinanceGetSapiV1MarginAccount extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_account';
    protected const DESCRIPTION = 'Query Cross Margin Account Details (USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/account.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/margin/account';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
