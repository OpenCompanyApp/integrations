<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Old Trade Lookup.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/historicalTrades.
 */
class BinanceGetApiV3Historicaltrades extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_historicaltrades';
    protected const DESCRIPTION = 'Old Trade Lookup

Get older market trades. Weight(IP): 10

Official Binance Spot endpoint: GET /api/v3/historicalTrades.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
        ],
        'from_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Trade id to fetch from. Default gets most recent trades.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/historicalTrades';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'limit' => 'limit',
        'fromId' => 'from_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
