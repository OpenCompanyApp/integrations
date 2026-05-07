<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query User Universal Transfer History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/transfer.
 */
class BinanceGetSapiV1AssetTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_transfer';
    protected const DESCRIPTION = 'Query User Universal Transfer History (USER_DATA)

- `fromSymbol` must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN - `toSymbol` must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN - Support query within the last 6 months only - If `startTime` and `endTime` not sent, return records of the last 7 days by default Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/transfer.';
    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Universal transfer type',
            'enum' => [
                'MAIN_C2C',
                'MAIN_UMFUTURE',
                'MAIN_CMFUTURE',
                'MAIN_MARGIN',
                'MAIN_MINING',
                'C2C_MAIN',
                'C2C_UMFUTURE',
                'C2C_MINING',
                'C2C_MARGIN',
                'UMFUTURE_MAIN',
                'UMFUTURE_C2C',
                'UMFUTURE_MARGIN',
                'CMFUTURE_MAIN',
                'CMFUTURE_MARGIN',
                'MARGIN_MAIN',
                'MARGIN_UMFUTURE',
                'MARGIN_CMFUTURE',
                'MARGIN_MINING',
                'MARGIN_C2C',
                'MINING_MAIN',
                'MINING_UMFUTURE',
                'MINING_C2C',
                'MINING_MARGIN',
                'MAIN_PAY',
                'PAY_MAIN',
                'ISOLATEDMARGIN_MARGIN',
                'MARGIN_ISOLATEDMARGIN',
                'ISOLATEDMARGIN_ISOLATEDMARGIN',
            ],
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
        'from_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Must be sent when type are ISOLATEDMARGIN_MARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
        ],
        'to_symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Must be sent when type are MARGIN_ISOLATEDMARGIN and ISOLATEDMARGIN_ISOLATEDMARGIN',
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
    protected const PATH = '/sapi/v1/asset/transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'type' => 'type',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'current' => 'current',
        'size' => 'size',
        'fromSymbol' => 'from_symbol',
        'toSymbol' => 'to_symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
