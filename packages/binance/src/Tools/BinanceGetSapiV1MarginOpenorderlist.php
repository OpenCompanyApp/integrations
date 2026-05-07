<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Margin Account's Open OCO (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/openOrderList.
 */
class BinanceGetSapiV1MarginOpenorderlist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_openorderlist';
    protected const DESCRIPTION = 'Query Margin Account\'s Open OCO (USER_DATA)

Weight(IP): 10

Official Binance Spot endpoint: GET /sapi/v1/margin/openOrderList.';
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
    protected const PATH = '/sapi/v1/margin/openOrderList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'isIsolated' => 'is_isolated',
        'symbol' => 'symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
