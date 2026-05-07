<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Historical Algo Orders.
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/algo/spot/historicalOrders.
 */
class BinanceGetSapiV1AlgoSpotHistoricalorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_algo_spot_historicalorders';
    protected const DESCRIPTION = 'Query Historical Algo Orders

Get all historical SPOT TWAP orders Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/spot/historicalOrders.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'side' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `side`.',
            'enum' => [
                'SELL',
                'BUY',
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
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 1',
        ],
        'page_size' => [
            'type' => 'string',
            'required' => false,
            'description' => 'MIN 1, MAX 100; Default 100',
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
    protected const PATH = '/sapi/v1/algo/spot/historicalOrders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'side' => 'side',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'page' => 'page',
        'pageSize' => 'page_size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
