<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Margin Interest Rate History (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/interestRateHistory.
 */
class BinanceGetSapiV1MarginInterestratehistory extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_interestratehistory';
    protected const DESCRIPTION = 'Margin Interest Rate History (USER_DATA)

The max interval between startTime and endTime is 30 days. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/interestRateHistory.';
    protected const PARAMETERS = [
        'asset' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `asset`.',
        ],
        'vip_level' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Defaults to user\'s vip level',
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
    protected const PATH = '/sapi/v1/margin/interestRateHistory';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'asset' => 'asset',
        'vipLevel' => 'vip_level',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
