<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Redeem Locked Product (TRADE).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/simple-earn/locked/redeem.
 */
class BinancePostSapiV1SimpleEarnLockedRedeem extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_simple_earn_locked_redeem';
    protected const DESCRIPTION = 'Redeem Locked Product (TRADE)

Weight(IP): 1 Rate Limit: 1/3s per account

Official Binance Spot endpoint: POST /sapi/v1/simple-earn/locked/redeem.';
    protected const PARAMETERS = [
        'position_id' => [
            'type' => 'string',
            'required' => true,
            'description' => '1234',
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
    protected const PATH = '/sapi/v1/simple-earn/locked/redeem';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'positionId' => 'position_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
