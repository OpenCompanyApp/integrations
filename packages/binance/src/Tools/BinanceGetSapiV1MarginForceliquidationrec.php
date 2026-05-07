<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Force Liquidation Record (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/forceLiquidationRec.
 */
class BinanceGetSapiV1MarginForceliquidationrec extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_forceliquidationrec';
    protected const DESCRIPTION = 'Get Force Liquidation Record (USER_DATA)

- Response in descending order Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/forceLiquidationRec.';
    protected const PARAMETERS = [
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
        'isolated_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Isolated symbol',
        ],
        'current' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Current querying page. Start from 1. Default:1',
        ],
        'size' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default:10 Max:100',
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
    protected const PATH = '/sapi/v1/margin/forceLiquidationRec';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'isolatedSymbol' => 'isolated_symbol',
        'current' => 'current',
        'size' => 'size',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
