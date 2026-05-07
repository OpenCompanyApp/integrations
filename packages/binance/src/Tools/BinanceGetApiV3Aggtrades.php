<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Compressed/Aggregate Trades List.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/aggTrades.
 */
class BinanceGetApiV3Aggtrades extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_aggtrades';
    protected const DESCRIPTION = 'Compressed/Aggregate Trades List

Get compressed, aggregate trades. Trades that fill at the time, from the same order, with the same price will have the quantity aggregated. - If `fromId`, `startTime`, and `endTime` are not sent, the most recent aggregate trades will be returned. - Note that if a trade has the following values, this was a duplicate aggregate trade and marked as invalid: p = \'0\' // price q = \'0\' // qty f = -1 // ﬁrst_trade_id l = -1 // last_trade_id Weight(IP): 2

Official Binance Spot endpoint: GET /api/v3/aggTrades.';
    protected const PARAMETERS = [
        'symbol' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Trading symbol, e.g. BNBUSDT',
        ],
        'from_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Trade id to fetch from. Default gets most recent trades.',
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
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Default 500; max 1000.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/aggTrades';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'symbol' => 'symbol',
        'fromId' => 'from_id',
        'startTime' => 'start_time',
        'endTime' => 'end_time',
        'limit' => 'limit',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
