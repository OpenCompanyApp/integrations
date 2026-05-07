<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get K-line candles.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/k-line/candles.
 */
class CoinMarketCapGetV1KLineCandles extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_k_line_candles';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/k-line/candles.';
    protected const PARAMETERS = [
        'platform' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Platform name or id',
        ],
        'address' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Token or pool address',
        ],
        'interval' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Kline interval: 1s/5s/30s/1min/3min/5min/15min/30min/1h/2h/4h/6h/8h/12h/1d/3d/1w/1m',
        ],
        'from' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Start timestamp (UNIX epoch)',
        ],
        'to' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'End timestamp (UNIX epoch)',
        ],
        'unit' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Kline unit: usd, native, quote',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Number of candles to load',
        ],
        'pm' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Kline type: p (price), m (marketcap)',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/k-line/candles';
    protected const QUERY_PARAMS = [
        'platform' => 'platform',
        'address' => 'address',
        'interval' => 'interval',
        'from' => 'from',
        'to' => 'to',
        'unit' => 'unit',
        'limit' => 'limit',
        'pm' => 'pm',
    ];
    protected const BODY_REQUIRED = false;
}
