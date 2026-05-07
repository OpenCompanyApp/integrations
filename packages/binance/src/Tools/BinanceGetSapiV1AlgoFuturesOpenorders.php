<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Current Algo Open Orders (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/algo/futures/openOrders.
 */
class BinanceGetSapiV1AlgoFuturesOpenorders extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_algo_futures_openorders';
    protected const DESCRIPTION = 'Query Current Algo Open Orders (USER_DATA)

- You need to enable Futures Trading Permission for the api key which requests this endpoint. - Base URL: https://api.binance.com Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/algo/futures/openOrders.';
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
    protected const PATH = '/sapi/v1/algo/futures/openOrders';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
