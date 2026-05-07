<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * New Order List - OTO (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /api/v3/orderList/oto.
 */
class BinancePostApiV3OrderlistOto extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_api_v3_orderlist_oto';
    protected const DESCRIPTION = 'New Order List - OTO (TRADE)

Places an `OTO`. - An `OTO` (One-Triggers-the-Other) is an order list comprised of 2 orders. - The first order is called the working order and must be `LIMIT` or `LIMIT_MAKER`. Initially, only the working order goes on the order book. - The second order is called the pending order. It can be any order type except for `MARKET` orders using parameter `quoteOrderQty`. The pending order is only placed on the order book when the working order gets fully filled. - If either the working order or the pending order is cancelled individually, the other order in the order list will also be canceled or expired. - When the order list is placed, if the working order gets immediately fully filled, the placement response will show the working order as `FILLED` but the pending order will still appear as `PENDING_NEW`. You need to query the status of the pending order again to see its updated status. - OTOs add 2 orders to the unfilled order count, `EXCHANGE_MAX_NUM_ORDERS` filter and `MAX_NUM_ORDERS` f

Official Binance Spot endpoint: POST /api/v3/orderList/oto.';
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
        'pending_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Supported values: Order Types Note that MARKET orders using quoteOrderQty are not supported.',
            'enum' => [
                'LIMIT',
                'MARKET',
                'STOP_LOSS',
                'STOP_LOSS_LIMIT',
                'TAKE_PROFIT',
                'TAKE_PROFIT_LIMIT',
                'LIMIT_MAKER',
            ],
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
        'pending_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open orders for the pending order. Automatically generated if not sent.',
        ],
        'pending_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingPrice`.',
        ],
        'pending_stop_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingStopPrice`.',
        ],
        'pending_trailing_delta' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `pendingTrailingDelta`.',
        ],
        'pending_quantity' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Sets the quantity for the pending order.',
        ],
        'pending_iceberg_qty' => [
            'type' => 'number',
            'required' => false,
            'description' => 'This can only be used if pendingTimeInForce is GTC.',
        ],
        'pending_time_in_force' => [
            'type' => 'string',
            'required' => false,
            'description' => 'GTC, IOC, FOK',
            'enum' => [
                'GTC',
                'IOC',
                'FOK',
            ],
        ],
        'pending_strategy_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the pending order within an order strategy.',
        ],
        'pending_strategy_type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the pending order strategy. Values smaller than 1000000 are reserved and cannot be used.',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/orderList/oto';
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
        'pendingType' => 'pending_type',
        'pendingSide' => 'pending_side',
        'pendingClientOrderId' => 'pending_client_order_id',
        'pendingPrice' => 'pending_price',
        'pendingStopPrice' => 'pending_stop_price',
        'pendingTrailingDelta' => 'pending_trailing_delta',
        'pendingQuantity' => 'pending_quantity',
        'pendingIcebergQty' => 'pending_iceberg_qty',
        'pendingTimeInForce' => 'pending_time_in_force',
        'pendingStrategyId' => 'pending_strategy_id',
        'pendingStrategyType' => 'pending_strategy_type',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
