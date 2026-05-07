<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Cancel limit order (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/convert/limit/cancelOrder.
 */
class BinancePostSapiV1ConvertLimitCancelorder extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_convert_limit_cancelorder';
    protected const DESCRIPTION = 'Cancel limit order (USER_DATA)

Enable users to cancel a limit order Weight(UID): 200

Official Binance Spot endpoint: POST /sapi/v1/convert/limit/cancelOrder.';
    protected const PARAMETERS = [
        'order_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'query parameter `orderId`.',
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
    protected const PATH = '/sapi/v1/convert/limit/cancelOrder';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'orderId' => 'order_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
