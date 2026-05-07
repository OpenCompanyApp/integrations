<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Volume Participation(VP) New Order (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/algo/futures/newOrderVp.
 */
class BinancePostSapiV1AlgoFuturesNewordervp extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_algo_futures_newordervp';
    protected const DESCRIPTION = 'Volume Participation(VP) New Order (TRADE)

Send in a VP new order. Only support on USDⓈ-M Contracts. - You need to enable `Futures Trading Permission` for the api key which requests this endpoint. - Base URL: https://api.binance.com - Total Algo open orders max allowed: 10 orders. - Leverage of symbols and position mode will be the same as your futures account settings. You can set up through the trading page or fapi. - Receiving "success": true does not mean that your order will be executed. Please use the query order endpoints(GET sapi/v1/algo/futures/openOrders or GET sapi/v1/algo/futures/historicalOrders) to check the order status. For example: Your futures balance is insufficient, or open position with reduce only or position side is inconsistent with your own setting. In these cases you will receive "success": true, but the order status will be expired after we check it. Weight(UID): 3000

Official Binance Spot endpoint: POST /sapi/v1/algo/futures/newOrderVp.';
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
        'position_side' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default BOTH for One-way Mode ; LONG or SHORT for Hedge Mode. It must be sent in Hedge Mode.',
            'enum' => [
                'BOTH',
                'LONG',
                'SHORT',
            ],
        ],
        'quantity' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Quantity of base asset; The notional (quantity * mark price(base asset)) must be more than the equivalent of 10,000 USDT and less than the equivalent of 1,000,000 USDT',
        ],
        'urgency' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Represent the relative speed of the current execution; ENUM: LOW, MEDIUM, HIGH',
            'enum' => [
                'LOW',
                'MEDIUM',
                'HIGH',
            ],
        ],
        'client_algo_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A unique id among Algo orders (length should be 32 characters)， If it is not sent, we will give default value',
        ],
        'reduce_only' => [
            'type' => 'boolean',
            'required' => false,
            'description' => '\'true\' or \'false\'. Default \'false\'; Cannot be sent in Hedge Mode; Cannot be sent when you open a position',
        ],
        'limit_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Limit price of the order; If it is not sent, will place order by market price by default',
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
    protected const PATH = '/sapi/v1/algo/futures/newOrderVp';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'side' => 'side',
        'positionSide' => 'position_side',
        'quantity' => 'quantity',
        'urgency' => 'urgency',
        'clientAlgoId' => 'client_algo_id',
        'reduceOnly' => 'reduce_only',
        'limitPrice' => 'limit_price',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
