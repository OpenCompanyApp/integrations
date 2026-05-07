<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin Account's OCO (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/orderList.
 */
class BinanceGetSapiV1MarginOrderlist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_orderlist';
    protected const DESCRIPTION = 'Query Margin Account\'s OCO (USER_DATA)

Retrieves a specific OCO based on provided optional parameters - Either `orderListId` or `origClientOrderId` must be provided Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/orderList.';
    protected const PARAMETERS = [
        'is_isolated' => [
            'type' => 'string',
            'required' => false,
            'description' => '* `TRUE` - For isolated margin * `FALSE` - Default, not for isolated margin',
            'enum' => [
                'TRUE',
                'FALSE',
            ],
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Mandatory for isolated margin, not supported for cross margin',
        ],
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
    protected const PATH = '/sapi/v1/margin/orderList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'isIsolated' => 'is_isolated',
        'symbol' => 'symbol',
        'orderListId' => 'order_list_id',
        'origClientOrderId' => 'orig_client_order_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
