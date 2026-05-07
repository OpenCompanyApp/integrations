<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Quotes Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/global-metrics/quotes/latest.
 */
class CoinMarketCapGetV1GlobalMetricsQuotesLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_global_metrics_quotes_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/global-metrics/quotes/latest.';
    protected const PARAMETERS = [
        'convert' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes in up to 120 currencies at once by passing a comma-separated list of cryptocurrency or fiat currency symbols. Each additional convert option beyond the first requires an additional call credit. A list of supported fiat options can be found [here](/guides/standards-and-conventions). Each conversion is returned in its own "quote" object.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes by CoinMarketCap ID instead of symbol. This option is identical to `convert` outside of ID format. Ex: convert_id=1,2781 would replace convert=BTC,USD in your query. This parameter cannot be used when `convert` is used.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/global-metrics/quotes/latest';
    protected const QUERY_PARAMS = [
        'convert' => 'convert',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
