<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Order (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/order.
 */
class BinanceGetApiV3Order extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_order';
    protected const DESCRIPTION = 'Query Order (USER_DATA)

Check an order\'s status. - Either `orderId` or `origClientOrderId` must be sent. - For some historical orders `cummulativeQuoteQty` will be < 0, meaning the data is not available at this time. Weight(IP): 4

Official Binance Spot endpoint: GET /api/v3/order.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
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
    protected const PATH = '/api/v3/order';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'orderId' => 'order_id',
        'origClientOrderId' => 'orig_client_order_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
