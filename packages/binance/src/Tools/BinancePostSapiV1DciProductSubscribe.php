<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Subscribe Dual Investment products(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/dci/product/subscribe.
 */
class BinancePostSapiV1DciProductSubscribe extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_dci_product_subscribe';
    protected const DESCRIPTION = 'Subscribe Dual Investment products(USER_DATA)

Subscribe Dual Investment products - `Products are not available.` means that the APR changes to lower value, or the orders are not available. - `Failed` is a system or network errors. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/dci/product/subscribe.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'get id from /sapi/v1/dci/product/list',
        ],
        'order_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'get orderId from /sapi/v1/dci/product/list',
        ],
        'deposit_amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `depositAmount`.',
        ],
        'auto_compound_plan' => [
            'type' => 'string',
            'required' => true,
            'description' => 'NONE: switch off the plan, STANDARD: standard plan, ADVANCED: advanced plan;',
            'enum' => [
                'NONE',
                'STANDARD',
                'ADVANCE',
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
    protected const PATH = '/sapi/v1/dci/product/subscribe';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'orderId' => 'order_id',
        'depositAmount' => 'deposit_amount',
        'autoCompoundPlan' => 'auto_compound_plan',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
