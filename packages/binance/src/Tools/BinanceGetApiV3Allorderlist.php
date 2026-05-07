<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query all OCO (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/allOrderList.
 */
class BinanceGetApiV3Allorderlist extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_allorderlist';
    protected const DESCRIPTION = 'Query all OCO (USER_DATA)

Retrieves all OCO based on provided optional parameters Weight(IP): 20

Official Binance Spot endpoint: GET /api/v3/allOrderList.';
    protected const PARAMETERS = [
        'from_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Trade id to fetch from. Default gets most recent trades.',
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
            'description' => 'Default 500; max 1000.',
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
    protected const PATH = '/api/v3/allOrderList';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
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
