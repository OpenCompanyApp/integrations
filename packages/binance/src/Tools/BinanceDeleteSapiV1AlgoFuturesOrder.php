<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Cancel Algo Order(TRADE).
 *
 * Maps to the official Binance Spot endpoint DELETE /sapi/v1/algo/futures/order.
 */
class BinanceDeleteSapiV1AlgoFuturesOrder extends AbstractBinanceTool
{
    protected const NAME = 'binance_delete_sapi_v1_algo_futures_order';
    protected const DESCRIPTION = 'Cancel Algo Order(TRADE)

Cancel an active order. - You need to enable Futures Trading Permission for the api key which requests this endpoint. - Base URL: https://api.binance.com Weight(IP): 1

Official Binance Spot endpoint: DELETE /sapi/v1/algo/futures/order.';
    protected const PARAMETERS = [
        'algo_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'Eg. 14511',
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
    protected const METHOD = 'DELETE';
    protected const PATH = '/sapi/v1/algo/futures/order';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'algoId' => 'algo_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
