<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query limit open orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/convert/limit/queryOpenOrders.
 */
class BinanceGetSapiV1ConvertLimitQueryopenorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_convert_limit_queryopenorders';
    protected const DESCRIPTION = 'Query limit open orders (USER_DATA)

Enable users to query for all existing limit orders Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/convert/limit/queryOpenOrders.';
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
    protected const PATH = '/sapi/v1/convert/limit/queryOpenOrders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
