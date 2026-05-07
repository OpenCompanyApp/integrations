<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Time-Weighted Average Price (Twap) New Order.
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/algo/spot/newOrderTwap.
 */
class BinancePostSapiV1AlgoSpotNewordertwap extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_algo_spot_newordertwap';
    protected const DESCRIPTION = 'Time-Weighted Average Price (Twap) New Order

Place a new spot TWAP order with Algo service. Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/algo/spot/newOrderTwap.';
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
        'quantity' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `quantity`.',
        ],
        'duration' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `duration`.',
        ],
        'client_algo_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `clientAlgoId`.',
        ],
        'limit_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `limitPrice`.',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/algo/spot/newOrderTwap';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'side' => 'side',
        'quantity' => 'quantity',
        'duration' => 'duration',
        'clientAlgoId' => 'client_algo_id',
        'limitPrice' => 'limit_price',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
