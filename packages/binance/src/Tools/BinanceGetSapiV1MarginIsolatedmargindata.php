<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Isolated Margin Fee Data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/isolatedMarginData.
 */
class BinanceGetSapiV1MarginIsolatedmargindata extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_isolatedmargindata';
    protected const DESCRIPTION = 'Query Isolated Margin Fee Data (USER_DATA)

Get isolated margin fee data collection with any vip level or user\'s current specific data as https://www.binance.com/en/margin-fee Weight(IP): 1 when a single is specified; 10 when the symbol parameter is omitted

Official Binance Spot endpoint: GET /sapi/v1/margin/isolatedMarginData.';
    protected const PARAMETERS = [
        'vip_level' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Defaults to user\'s vip level',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Trading symbol, e.g. BNBUSDT',
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
    protected const PATH = '/sapi/v1/margin/isolatedMarginData';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'vipLevel' => 'vip_level',
        'symbol' => 'symbol',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
