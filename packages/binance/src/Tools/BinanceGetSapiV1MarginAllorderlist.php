<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin Account's all OCO (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/allOrderList.
 */
class BinanceGetSapiV1MarginAllorderlist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_allorderlist';
    protected const DESCRIPTION = 'Query Margin Account\'s all OCO (USER_DATA)

Retrieves all OCO for a specific margin account based on provided optional parameters Weight(IP): 200

Official Binance Spot endpoint: GET /sapi/v1/margin/allOrderList.';
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
        'from_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'If supplied, neither `startTime` or `endTime` can be provided',
        ],
        'start_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'end_time' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default Value: 500; Max Value: 1000',
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
    protected const PATH = '/sapi/v1/margin/allOrderList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'isIsolated' => 'is_isolated',
        'symbol' => 'symbol',
        'fromId' => 'from_id',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
