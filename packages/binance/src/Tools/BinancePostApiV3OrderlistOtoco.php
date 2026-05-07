<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * New Order List - OTOCO (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /api/v3/orderList/otoco.
 */
class BinancePostApiV3OrderlistOtoco extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_api_v3_orderlist_otoco';
    protected const DESCRIPTION = 'New Order List - OTOCO (TRADE)

Place an `OTOCO`. - An `OTOCO` (One-Triggers-One-Cancels-the-Other) is an order list comprised of 3 orders. - The first order is called the working order and must be `LIMIT` or `LIMIT_MAKER`. Initially, only the working order goes on the order book. - The behavior of the working order is the same as the `OTO`. - `OTOCO` has 2 pending orders (pending above and pending below), forming an `OCO` pair. The pending orders are only placed on the order book when the working order gets fully filled. - The rules of the pending above and pending below follow the same rules as the Order List `OCO`. - OTOCOs add 3 orders against the unfilled order count, `EXCHANGE_MAX_NUM_ORDERS` filter, and `MAX_NUM_ORDERS` filter. Weight: 1

Official Binance Spot endpoint: POST /api/v3/orderList/otoco.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'list_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open order lists. Automatically generated if not sent. A new order list with the same `listClientOrderId` is accepted only when the previous one is filled or completely expired. `listClientOrderId` is distinct from the `workingClientOrderId` and the `pendingClientOrderId`.',
        ],
        'new_order_resp_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Set the response JSON.',
            'enum' => [
                'ACK',
                'RESULT',
                'FULL',
            ],
        ],
        'self_trade_prevention_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The allowed enums is dependent on what is configured on the symbol. The possible supported values are EXPIRE_TAKER, EXPIRE_MAKER, EXPIRE_BOTH, NONE.',
            'enum' => [
                'EXPIRE_TAKER',
                'EXPIRE_MAKER',
                'EXPIRE_BOTH',
                'NONE',
            ],
        ],
        'working_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Supported values: LIMIT,LIMIT_MAKER',
            'enum' => [
                'LIMIT',
                'LIMIT_MAKER',
            ],
        ],
        'working_side' => [
            'type' => 'string',
            'required' => true,
            'description' => 'BUY,SELL',
            'enum' => [
                'BUY',
                'SELL',
            ],
        ],
        'working_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open orders for the working order. Automatically generated if not sent.',
        ],
        'working_price' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `workingPrice`.',
        ],
        'working_quantity' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Sets the quantity for the working order.',
        ],
        'working_iceberg_qty' => [
            'type' => 'number',
            'required' => true,
            'description' => 'This can only be used if workingTimeInForce is GTC.',
        ],
        'working_time_in_force' => [
            'type' => 'string',
            'required' => false,
            'description' => 'GTC, IOC, FOK',
            'enum' => [
                'GTC',
                'IOC',
                'FOK',
            ],
        ],
        'working_strategy_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the working order within an order strategy.',
        ],
        'working_strategy_type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the working order strategy. Values smaller than 1000000 are reserved and cannot be used.',
        ],
        'pending_side' => [
            'type' => 'string',
            'required' => true,
            'description' => 'BUY,SELL',
            'enum' => [
                'BUY',
                'SELL',
            ],
        ],
        'pending_quantity' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Sets the quantity for the pending order.',
        ],
        'pending_above_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Supported values: LIMIT_MAKER, STOP_LOSS, and STOP_LOSS_LIMIT',
            'enum' => [
                'LIMIT_MAKER',
                'STOP_LOSS',
                'STOP_LOSS_LIMIT',
            ],
        ],
        'pending_above_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open orders for the pending above order. Automatically generated if not sent.',
        ],
        'pending_above_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingAbovePrice`.',
        ],
        'pending_above_stop_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingAboveStopPrice`.',
        ],
        'pending_above_trailing_delta' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingAboveTrailingDelta`.',
        ],
        'pending_above_iceberg_qty' => [
            'type' => 'number',
            'required' => false,
            'description' => 'This can only be used if pendingAboveTimeInForce is GTC.',
        ],
        'pending_above_time_in_force' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `pendingAboveTimeInForce`.',
            'enum' => [
                'GTC',
                'IOC',
                'FOK',
            ],
        ],
        'pending_above_strategy_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the pending above order within an order strategy.',
        ],
        'pending_above_strategy_type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the pending above order strategy. Values smaller than 1000000 are reserved and cannot be used.',
        ],
        'pending_below_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Supported values: LIMIT_MAKER, STOP_LOSS, and STOP_LOSS_LIMIT',
            'enum' => [
                'LIMIT_MAKER',
                'STOP_LOSS',
                'STOP_LOSS_LIMIT',
            ],
        ],
        'pending_below_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open orders for the pending below order. Automatically generated if not sent.',
        ],
        'pending_below_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingBelowPrice`.',
        ],
        'pending_below_stop_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingBelowStopPrice`.',
        ],
        'pending_below_trailing_delta' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingBelowTrailingDelta`.',
        ],
        'pending_below_iceberg_qty' => [
            'type' => 'number',
            'required' => false,
            'description' => 'This can only be used if pendingBelowTimeInForce is GTC.',
        ],
        'pending_below_time_in_force' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `pendingBelowTimeInForce`.',
            'enum' => [
                'GTC',
                'IOC',
                'FOK',
            ],
        ],
        'pending_below_strategy_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the pending below order within an order strategy.',
        ],
        'pending_below_strategy_type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the pending below order strategy. Values smaller than 1000000 are reserved and cannot be used.',
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
    protected const PATH = '/api/v3/orderList/otoco';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'listClientOrderId' => 'list_client_order_id',
        'newOrderRespType' => 'new_order_resp_type',
        'selfTradePreventionMode' => 'self_trade_prevention_mode',
        'workingType' => 'working_type',
        'workingSide' => 'working_side',
        'workingClientOrderId' => 'working_client_order_id',
        'workingPrice' => 'working_price',
        'workingQuantity' => 'working_quantity',
        'workingIcebergQty' => 'working_iceberg_qty',
        'workingTimeInForce' => 'working_time_in_force',
        'workingStrategyId' => 'working_strategy_id',
        'workingStrategyType' => 'working_strategy_type',
        'pendingSide' => 'pending_side',
        'pendingQuantity' => 'pending_quantity',
        'pendingAboveType' => 'pending_above_type',
        'pendingAboveClientOrderId' => 'pending_above_client_order_id',
        'pendingAbovePrice' => 'pending_above_price',
        'pendingAboveStopPrice' => 'pending_above_stop_price',
        'pendingAboveTrailingDelta' => 'pending_above_trailing_delta',
        'pendingAboveIcebergQty' => 'pending_above_iceberg_qty',
        'pendingAboveTimeInForce' => 'pending_above_time_in_force',
        'pendingAboveStrategyId' => 'pending_above_strategy_id',
        'pendingAboveStrategyType' => 'pending_above_strategy_type',
        'pendingBelowType' => 'pending_below_type',
        'pendingBelowClientOrderId' => 'pending_below_client_order_id',
        'pendingBelowPrice' => 'pending_below_price',
        'pendingBelowStopPrice' => 'pending_below_stop_price',
        'pendingBelowTrailingDelta' => 'pending_below_trailing_delta',
        'pendingBelowIcebergQty' => 'pending_below_iceberg_qty',
        'pendingBelowTimeInForce' => 'pending_below_time_in_force',
        'pendingBelowStrategyId' => 'pending_below_strategy_id',
        'pendingBelowStrategyType' => 'pending_below_strategy_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
