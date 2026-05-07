<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Sub Orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/algo/futures/subOrders.
 */
class BinanceGetSapiV1AlgoFuturesSuborders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_algo_futures_suborders';
    protected const DESCRIPTION = 'Query Sub Orders (USER_DATA)

- You need to enable Futures Trading Permission for the api key which requests this endpoint. - Base URL: https://api.binance.com Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/futures/subOrders.';
    protected const PARAMETERS = [
        'algo_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `algoId`.',
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
    protected const PATH = '/sapi/v1/algo/futures/subOrders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'algoId' => 'algo_id',
        'page' => 'page',
        'pageSize' => 'page_size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
