<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get API Key Permission (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/account/apiRestrictions.
 */
class BinanceGetSapiV1AccountApirestrictions extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_account_apirestrictions';
    protected const DESCRIPTION = 'Get API Key Permission (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/account/apiRestrictions.';
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
    protected const PATH = '/sapi/v1/account/apiRestrictions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
