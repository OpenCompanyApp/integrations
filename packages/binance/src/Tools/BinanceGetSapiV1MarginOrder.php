<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin Account's Order (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/order.
 */
class BinanceGetSapiV1MarginOrder extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_order';
    protected const DESCRIPTION = 'Query Margin Account\'s Order (USER_DATA)

- Either `orderId` or `origClientOrderId` must be sent. - For some historical orders `cummulativeQuoteQty` will be < 0, meaning the data is not available at this time. Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/order.';
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
        'order_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order id',
        ],
        'orig_client_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Order id from client',
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
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/order';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'isIsolated' => 'is_isolated',
        'orderId' => 'order_id',
        'origClientOrderId' => 'orig_client_order_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
