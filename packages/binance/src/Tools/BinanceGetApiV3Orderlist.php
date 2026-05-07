<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query OCO (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/orderList.
 */
class BinanceGetApiV3Orderlist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_orderlist';
    protected const DESCRIPTION = 'Query OCO (USER_DATA)

Retrieves a specific OCO based on provided optional parameters Weight(IP): 4

Official Binance Spot endpoint: GET /api/v3/orderList.';
    protected const PARAMETERS = [
        'order_list_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Order list id',
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
    protected const PATH = '/api/v3/orderList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderListId' => 'order_list_id',
        'origClientOrderId' => 'orig_client_order_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
