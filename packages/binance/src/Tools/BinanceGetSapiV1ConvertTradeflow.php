<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Convert Trade History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/convert/tradeFlow.
 */
class BinanceGetSapiV1ConvertTradeflow extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_convert_tradeflow';
    protected const DESCRIPTION = 'Get Convert Trade History (USER_DATA)

- The max interval between startTime and endTime is 30 days. Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/convert/tradeFlow.';
    protected const PARAMETERS = [
        'start_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'UTC timestamp in ms',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'default 100, max 1000',
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
    protected const PATH = '/sapi/v1/convert/tradeFlow';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
