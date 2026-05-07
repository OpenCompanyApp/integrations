<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Account info (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/account/info.
 */
class BinanceGetSapiV1AccountInfo extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_account_info';
    protected const DESCRIPTION = 'Account info (USER_DATA)

Fetch account info detail. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/account/info.';
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
    protected const PATH = '/sapi/v1/account/info';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
