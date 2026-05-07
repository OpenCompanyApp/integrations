<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Future TickLevel Orderbook Historical Data Download Link (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/futures/histDataLink.
 */
class BinanceGetSapiV1FuturesHistdatalink extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_futures_histdatalink';
    protected const DESCRIPTION = 'Get Future TickLevel Orderbook Historical Data Download Link (USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/futures/histDataLink.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `symbol`.',
        ],
        'data_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `dataType`.',
            'enum' => [
                'T_DEPTH',
                'S_DEPTH',
            ],
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
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
    protected const PATH = '/sapi/v1/futures/histDataLink';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'dataType' => 'data_type',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
