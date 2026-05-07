<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Isolated Margin Tier Data (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/isolatedMarginTier.
 */
class BinanceGetSapiV1MarginIsolatedmargintier extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_isolatedmargintier';
    protected const DESCRIPTION = 'Query Isolated Margin Tier Data (USER_DATA)

Get isolated margin tier data collection with any tier as https://www.binance.com/en/margin-data Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/isolatedMarginTier.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'tier' => [
            'type' => 'string',
            'required' => false,
            'description' => 'All margin tier data will be returned if tier is omitted',
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
    protected const PATH = '/sapi/v1/margin/isolatedMarginTier';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'tier' => 'tier',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
