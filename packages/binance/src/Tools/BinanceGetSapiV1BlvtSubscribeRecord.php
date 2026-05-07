<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Subscription Record (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/blvt/subscribe/record.
 */
class BinanceGetSapiV1BlvtSubscribeRecord extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_blvt_subscribe_record';
    protected const DESCRIPTION = 'Query Subscription Record (USER_DATA)

- Only the data of the latest 90 days is available Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/blvt/subscribe/record.';
    protected const PARAMETERS = [
        'token_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'BTCDOWN, BTCUP',
        ],
        'id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `id`.',
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
    protected const PATH = '/sapi/v1/blvt/subscribe/record';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'tokenName' => 'token_name',
        'id' => 'id',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
