<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Current Algo Open Orders.
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/algo/spot/openOrders.
 */
class BinanceGetSapiV1AlgoSpotOpenorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_algo_spot_openorders';
    protected const DESCRIPTION = 'Query Current Algo Open Orders

Get all open SPOT TWAP orders Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/spot/openOrders.';
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
    protected const PATH = '/sapi/v1/algo/spot/openOrders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
