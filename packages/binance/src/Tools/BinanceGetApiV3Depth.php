<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Order Book.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/depth.
 */
class BinanceGetApiV3Depth extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_depth';
    protected const DESCRIPTION = 'Order Book

| Limit | Weight(IP) | |---------------------|-------------| | 1-100 | 5 | | 101-500 | 25 | | 501-1000 | 50 | | 1001-5000 | 250 |

Official Binance Spot endpoint: GET /api/v3/depth.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'If limit > 5000, then the response will truncate to 5000',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/depth';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'limit' => 'limit',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
