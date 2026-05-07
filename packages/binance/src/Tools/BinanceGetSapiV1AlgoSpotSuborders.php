<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Sub Orders.
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/algo/spot/subOrders.
 */
class BinanceGetSapiV1AlgoSpotSuborders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_algo_spot_suborders';
    protected const DESCRIPTION = 'Query Sub Orders

Get respective sub orders for a specified algoId Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/spot/subOrders.';
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
    protected const PATH = '/sapi/v1/algo/spot/subOrders';
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
