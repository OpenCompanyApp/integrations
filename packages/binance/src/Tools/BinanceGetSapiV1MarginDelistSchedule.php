<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get tokens or symbols delist schedule for cross margin and isolated margin (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/delist-schedule.
 */
class BinanceGetSapiV1MarginDelistSchedule extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_delist_schedule';
    protected const DESCRIPTION = 'Get tokens or symbols delist schedule for cross margin and isolated margin (MARKET_DATA)

Get tokens or symbols delist schedule for cross margin and isolated margin Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/delist-schedule.';
    protected const PARAMETERS = [
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
    protected const PATH = '/sapi/v1/margin/delist-schedule';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
