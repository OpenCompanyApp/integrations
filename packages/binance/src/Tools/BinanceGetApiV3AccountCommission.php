<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Commission Rates (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/account/commission.
 */
class BinanceGetApiV3AccountCommission extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_account_commission';
    protected const DESCRIPTION = 'Query Commission Rates (USER_DATA)

Get current account commission rates. Weight: 20

Official Binance Spot endpoint: GET /api/v3/account/commission.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/account/commission';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
