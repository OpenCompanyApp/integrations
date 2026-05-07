<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Margin Account New OCO (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/margin/order/oco.
 */
class BinancePostSapiV1MarginOrderOco extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_margin_order_oco';
    protected const DESCRIPTION = 'Margin Account New OCO (TRADE)

Send in a new OCO for a margin account - Price Restrictions: - SELL: Limit Price > Last Price > Stop Price - BUY: Limit Price < Last Price < Stop Price - Quantity Restrictions: - Both legs must have the same quantity - ICEBERG quantities however do not have to be the same. - Order Rate Limit - OCO counts as 2 orders against the order rate limit. Weight(UID): 6

Official Binance Spot endpoint: POST /sapi/v1/margin/order/oco.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'is_isolated' => [
            'type' => 'string',
            'required' => false,
            'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
            'enum' => [
                'TRUE',
                'FALSE',
            ],
        ],
        'list_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A unique Id for the entire orderList',
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
        'limit_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A unique Id for the limit order',
        ],
        'price' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Order price',
        ],
        'limit_iceberg_qty' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `limitIcebergQty`.',
        ],
        'stop_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A unique Id for the stop loss/stop loss limit leg',
        ],
        'stop_price' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `stopPrice`.',
        ],
        'stop_limit_price' => [
            'type' => 'number',
            'required' => false,
            'description' => 'If provided, stopLimitTimeInForce is required.',
        ],
        'stop_iceberg_qty' => [
            'type' => 'number',
            'required' => false,
            'description' => 'query parameter `stopIcebergQty`.',
        ],
        'stop_limit_time_in_force' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `stopLimitTimeInForce`.',
            'enum' => [
                'GTC',
                'FOK',
                'IOC',
            ],
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
        'side_effect_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default `NO_SIDE_EFFECT`',
            'enum' => [
                'NO_SIDE_EFFECT',
                'MARGIN_BUY',
                'AUTO_REPAY',
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
    protected const PATH = '/sapi/v1/margin/order/oco';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'isIsolated' => 'is_isolated',
        'listClientOrderId' => 'list_client_order_id',
        'side' => 'side',
        'quantity' => 'quantity',
        'limitClientOrderId' => 'limit_client_order_id',
        'price' => 'price',
        'limitIcebergQty' => 'limit_iceberg_qty',
        'stopClientOrderId' => 'stop_client_order_id',
        'stopPrice' => 'stop_price',
        'stopLimitPrice' => 'stop_limit_price',
        'stopIcebergQty' => 'stop_iceberg_qty',
        'stopLimitTimeInForce' => 'stop_limit_time_in_force',
        'newOrderRespType' => 'new_order_resp_type',
        'sideEffectType' => 'side_effect_type',
        'selfTradePreventionMode' => 'self_trade_prevention_mode',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
