<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Order status (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/convert/orderStatus.
 */
class BinanceGetSapiV1ConvertOrderstatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_convert_orderstatus';
    protected const DESCRIPTION = 'Order status (USER_DATA)

Query order status by order ID. Weight(UID): 100

Official Binance Spot endpoint: GET /sapi/v1/convert/orderStatus.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `orderId`.',
        ],
        'quote_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `quoteId`.',
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
    protected const PATH = '/sapi/v1/convert/orderStatus';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'quoteId' => 'quote_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
