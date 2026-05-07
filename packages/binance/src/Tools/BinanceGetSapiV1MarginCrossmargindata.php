<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Cross Margin Fee Data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/crossMarginData.
 */
class BinanceGetSapiV1MarginCrossmargindata extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_crossmargindata';
    protected const DESCRIPTION = 'Query Cross Margin Fee Data (USER_DATA)

Get cross margin fee data collection with any vip level or user\'s current specific data as https://www.binance.com/en/margin-fee Weight(IP): 1 when coin is specified; 5 when the coin parameter is omitted

Official Binance Spot endpoint: GET /sapi/v1/margin/crossMarginData.';
    protected const PARAMETERS = [
        'vip_level' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Defaults to user\'s vip level',
        ],
        'coin' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Coin name',
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
    protected const PATH = '/sapi/v1/margin/crossMarginData';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'vipLevel' => 'vip_level',
        'coin' => 'coin',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
