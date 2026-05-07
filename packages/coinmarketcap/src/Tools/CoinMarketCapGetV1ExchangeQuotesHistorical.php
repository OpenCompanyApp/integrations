<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Quotes Historical.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/exchange/quotes/historical.
 */
class CoinMarketCapGetV1ExchangeQuotesHistorical extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_exchange_quotes_historical';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/exchange/quotes/historical.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated exchange CoinMarketCap ids. Example: "24,270"',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively, one or more comma-separated exchange names in URL friendly shorthand "slug" format (all lowercase, spaces replaced with hyphens). Example: "binance,kraken". At least one "id" *or* "slug" is required.',
        ],
        'time_start' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to start returning quotes for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
        ],
        'time_end' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to stop returning quotes for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
        ],
        'count' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 10 items. The current query limit is 10000.',
        ],
        'interval' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Interval of time to return data points for. See details in endpoint description.',
            'enum' => [
                'yearly',
                'monthly',
                'weekly',
                'daily',
                'hourly',
                '5m',
                '10m',
                '15m',
                '30m',
                '45m',
                '1h',
                '2h',
                '3h',
                '4h',
                '6h',
                '12h',
                '24h',
                '1d',
                '2d',
                '3d',
                '7d',
                '14d',
                '15d',
                '30d',
                '60d',
                '90d',
                '365d',
            ],
        ],
        'convert' => [
            'type' => 'string',
            'required' => false,
            'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 other fiat currencies or cryptocurrencies.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/exchange/quotes/historical';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'time_start' => 'time_start',
        'time_end' => 'time_end',
        'count' => 'count',
        'interval' => 'interval',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
