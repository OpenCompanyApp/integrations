<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * DustLog(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/asset/dribblet.
 */
class BinanceGetSapiV1AssetDribblet extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_asset_dribblet';
    protected const DESCRIPTION = 'DustLog(USER_DATA)

Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/asset/dribblet.';
    protected const PARAMETERS = [
        'account_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT or MARGIN, default SPOT',
            'enum' => [
                'SPOT',
                'MARGIN',
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
    protected const PATH = '/sapi/v1/asset/dribblet';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'accountType' => 'account_type',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
