<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Set Locked Auto Subscribe (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/simple-earn/locked/setAutoSubscribe.
 */
class BinancePostSapiV1SimpleEarnLockedSetautosubscribe extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_simple_earn_locked_setautosubscribe';
    protected const DESCRIPTION = 'Set Locked Auto Subscribe (USER_DATA)

Weight(IP): 150

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/locked/setAutoSubscribe.';
    protected const PARAMETERS = [
        'position_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `positionId`.',
        ],
        'auto_subscribe' => [
            'type' => 'boolean',
            'required' => true,
            'description' => 'true or false',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/simple-earn/locked/setAutoSubscribe';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'positionId' => 'position_id',
        'autoSubscribe' => 'auto_subscribe',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
