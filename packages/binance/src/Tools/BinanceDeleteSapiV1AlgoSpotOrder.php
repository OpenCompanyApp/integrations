<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Cancel Algo Order.
 *
 * Maps to the official Binance Spot endpoint DELETE /sapi/v1/algo/spot/order.
 */
class BinanceDeleteSapiV1AlgoSpotOrder extends AbstractBinanceTool
{
    protected const NAME = 'binance_delete_sapi_v1_algo_spot_order';
    protected const DESCRIPTION = 'Cancel Algo Order

Cancel an open TWAP order Weight(IP): 1

Official Binance Spot endpoint: DELETE /sapi/v1/algo/spot/order.';
    protected const PARAMETERS = [
        'algo_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `algoId`.',
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
    protected const PATH = '/sapi/v1/algo/spot/order';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'algoId' => 'algo_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
