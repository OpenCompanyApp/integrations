<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Set Locked Product Redeem Option(USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/simple-earn/locked/setRedeemOption.
 */
class BinanceGetSapiV1SimpleEarnLockedSetredeemoption extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_simple_earn_locked_setredeemoption';
    protected const DESCRIPTION = 'Set Locked Product Redeem Option(USER_DATA)

Set redeem option for Locked product Weight(IP): 50

Official Binance Spot endpoint: GET /sapi/v1/simple-earn/locked/setRedeemOption.';
    protected const PARAMETERS = [
        'position_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `positionId`.',
        ],
        'redeem_to' => [
            'type' => 'string',
            'required' => false,
            'description' => 'SPOT,FLEXIBLE, default FLEXIBLE',
            'enum' => [
                'SPOT',
                'FLEXIBLE',
            ],
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
    protected const PATH = '/sapi/v1/simple-earn/locked/setRedeemOption';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'positionId' => 'position_id',
        'redeemTo' => 'redeem_to',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
