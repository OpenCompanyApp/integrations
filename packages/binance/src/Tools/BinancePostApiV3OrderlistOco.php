<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * New Order list - OCO (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /api/v3/orderList/oco.
 */
class BinancePostApiV3OrderlistOco extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_api_v3_orderlist_oco';
    protected const DESCRIPTION = 'New Order list - OCO (TRADE)

Send in an one-cancels-the-other (OCO) pair, where activation of one order immediately cancels the other. - An `OCO` has 2 orders called the above order and below order. - One of the orders must be a `LIMIT_MAKER` order and the other must be `STOP_LOSS` or`STOP_LOSS_LIMIT` order. - Price restrictions: - If the `OCO` is on the `SELL` side: `LIMIT_MAKER` price > Last Traded Price > stopPrice - If the `OCO` is on the `BUY` side: `LIMIT_MAKER` price < Last Traded Price < stopPrice - OCOs add 2 orders to the unfilled order count, `EXCHANGE_MAX_ORDERS` filter, and the `MAX_NUM_ORDERS` filter. Weight(IP): 1

Official Binance Spot endpoint: POST /api/v3/orderList/oco.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'list_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open order lists. Automatically generated if not sent. A new order list with the same `listClientOrderId` is accepted only when the previous one is filled or completely expired. `listClientOrderId` is distinct from the `aboveClientOrderId` and the `belowCLientOrderId`.',
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
        'above_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Supported values : `STOP_LOSS_LIMIT`, `STOP_LOSS`, `LIMIT_MAKER`',
        ],
        'above_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open orders for the above order. Automatically generated if not sent',
        ],
        'above_iceberg_qty' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Note that this can only be used if `aboveTimeInForce` is `GTC`.',
        ],
        'above_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `abovePrice`.',
        ],
        'above_stop_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Can be used if `aboveType` is `STOP_LOSS` or `STOP_LOSS_LIMIT`. Either `aboveStopPrice` or `aboveTrailingDelta` or both, must be specified.',
        ],
        'above_trailing_delta' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `aboveTrailingDelta`.',
        ],
        'above_time_in_force' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Required if the `aboveType` is `STOP_LOSS_LIMIT`.',
            'enum' => [
                'GTC',
                'IOC',
                'FOK',
            ],
        ],
        'above_strategy_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the above order within an order strategy.',
        ],
        'above_strategy_type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the above order strategy. Values smaller than 1000000 are reserved and cannot be used.',
        ],
        'below_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Supported values : `STOP_LOSS_LIMIT`, `STOP_LOSS`, `LIMIT_MAKER`',
        ],
        'below_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Arbitrary unique ID among open orders for the below order. Automatically generated if not sent',
        ],
        'below_iceberg_qty' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Note that this can only be used if `belowTimeInForce` is `GTC`.',
        ],
        'below_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Can be used if `belowType` is `STOP_LOSS_LIMIT` or `LIMIT_MAKER` to specify the limit price.',
        ],
        'below_stop_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Can be used if `belowType` is `STOP_LOSS` or `STOP_LOSS_LIMIT`. Either `belowStopPrice` or `belowTrailingDelta` or both, must be specified.',
        ],
        'below_trailing_delta' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `belowTrailingDelta`.',
        ],
        'below_time_in_force' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Required if the `belowType` is `STOP_LOSS_LIMIT`.',
            'enum' => [
                'GTC',
                'IOC',
                'FOK',
            ],
        ],
        'below_strategy_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the below order within an order strategy.',
        ],
        'below_strategy_type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Arbitrary numeric value identifying the below order strategy. Values smaller than 1000000 are reserved and cannot be used.',
        ],
        'new_order_resp_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Set the response JSON. MARKET and LIMIT order types default to FULL, all other orders default to ACK.',
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
    protected const PATH = '/api/v3/orderList/oco';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'listClientOrderId' => 'list_client_order_id',
        'side' => 'side',
        'quantity' => 'quantity',
        'aboveType' => 'above_type',
        'aboveClientOrderId' => 'above_client_order_id',
        'aboveIcebergQty' => 'above_iceberg_qty',
        'abovePrice' => 'above_price',
        'aboveStopPrice' => 'above_stop_price',
        'aboveTrailingDelta' => 'above_trailing_delta',
        'aboveTimeInForce' => 'above_time_in_force',
        'aboveStrategyId' => 'above_strategy_id',
        'aboveStrategyType' => 'above_strategy_type',
        'belowType' => 'below_type',
        'belowClientOrderId' => 'below_client_order_id',
        'belowIcebergQty' => 'below_iceberg_qty',
        'belowPrice' => 'below_price',
        'belowStopPrice' => 'below_stop_price',
        'belowTrailingDelta' => 'below_trailing_delta',
        'belowTimeInForce' => 'below_time_in_force',
        'belowStrategyId' => 'below_strategy_id',
        'belowStrategyType' => 'below_strategy_type',
        'newOrderRespType' => 'new_order_resp_type',
        'selfTradePreventionMode' => 'self_trade_prevention_mode',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
