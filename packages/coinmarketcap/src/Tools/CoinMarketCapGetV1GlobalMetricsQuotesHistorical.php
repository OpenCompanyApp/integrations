<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Quotes Historical.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/global-metrics/quotes/historical.
 */
class CoinMarketCapGetV1GlobalMetricsQuotesHistorical extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_global_metrics_quotes_historical';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/global-metrics/quotes/historical.';
    protected const PARAMETERS = [
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
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields to return. Pass `btc_dominance,eth_dominance,active_cryptocurrencies,active_exchanges,active_market_pairs,total_volume_24h,total_volume_24h_reported,altcoin_market_cap,altcoin_volume_24h,altcoin_volume_24h_reported,search_interval` to include all auxiliary fields.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/global-metrics/quotes/historical';
    protected const QUERY_PARAMS = [
        'time_start' => 'time_start',
        'time_end' => 'time_end',
        'count' => 'count',
        'interval' => 'interval',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
