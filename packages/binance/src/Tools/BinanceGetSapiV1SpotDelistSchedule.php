<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Get symbols delist schedule for spot (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/spot/delist-schedule.
 */
class BinanceGetSapiV1SpotDelistSchedule extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_spot_delist_schedule';
    protected const DESCRIPTION = 'Get symbols delist schedule for spot (MARKET_DATA)

Get symbols delist schedule for spot Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/spot/delist-schedule.';
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
    protected const PATH = '/sapi/v1/spot/delist-schedule';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
