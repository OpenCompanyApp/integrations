<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get Spot Rebate History Records (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/rebate/taxQuery.
 */
class BinanceGetSapiV1RebateTaxquery extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_rebate_taxquery';
    protected const DESCRIPTION = 'Get Spot Rebate History Records (USER_DATA)

- The max interval between startTime and endTime is 90 days. - If startTime and endTime are not sent, the recent 7 days\' data will be returned. - The earliest startTime is supported on June 10, 2020 Weight(UID): 3000

Official Binance Spot endpoint: GET /sapi/v1/rebate/taxQuery.';
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
        'page' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'default 1',
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
    protected const PATH = '/sapi/v1/rebate/taxQuery';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'page' => 'page',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
