<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * OHLCV Historical v1 (deprecated).
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/ohlcv/historical.
 */
class CoinMarketCapGetV1CryptocurrencyOhlcvHistorical extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_ohlcv_historical';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/ohlcv/historical.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated CoinMarketCap cryptocurrency IDs. Example: "1,1027"',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass one or more comma-separated cryptocurrency symbols. Example: "BTC,ETH". At least one "id" *or* "slug" *or* "symbol" is required for this request.',
        ],
        'time_period' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Time period to return OHLCV data for. The default is "daily". If hourly, the open will be 01:00 and the close will be 01:59. If daily, the open will be 00:00:00 for the day and close will be 23:59:99 for the same day. See the main endpoint description for details.',
            'enum' => [
                'daily',
                'hourly',
            ],
        ],
        'time_start' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to start returning OHLCV time periods for. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
        ],
        'time_end' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to stop returning OHLCV time periods for (inclusive). Optional, if not passed we\'ll default to the current time. Only the date portion of the timestamp is used for daily OHLCV so it\'s recommended to send an ISO date format like "2018-09-19" without time.',
        ],
        'count' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Optionally limit the number of time periods to return results for. The default is 10 items. The current query limit is 10000 items.',
        ],
        'interval' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally adjust the interval that "time_period" is sampled. For example with interval=monthly&time_period=daily you will see a daily OHLCV record for January, February, March and so on. See main endpoint description for available options.',
            'enum' => [
                'hourly',
                'daily',
                'weekly',
                'monthly',
                'yearly',
                '1h',
                '2h',
                '3h',
                '4h',
                '6h',
                '12h',
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
            'description' => 'By default market quotes are returned in USD. Optionally calculate market quotes in up to 3 fiat currencies or cryptocurrencies.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
        ],
        'skip_invalid' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Pass `true` to relax request validation rules. When requesting records on multiple cryptocurrencies an error is returned if any invalid cryptocurrencies are requested or a cryptocurrency does not have matching records in the requested timeframe. If set to true, invalid lookups will be skipped allowing valid cryptocurrencies to still be returned.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/cryptocurrency/ohlcv/historical';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'time_period' => 'time_period',
        'time_start' => 'time_start',
        'time_end' => 'time_end',
        'count' => 'count',
        'interval' => 'interval',
        'convert' => 'convert',
        'convert_id' => 'convert_id',
        'skip_invalid' => 'skip_invalid',
    ];
    protected const BODY_REQUIRED = false;
}
