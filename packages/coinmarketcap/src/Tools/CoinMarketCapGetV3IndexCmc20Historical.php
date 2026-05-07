<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * CoinMarketCap 20 Index Historical.
 *
 * Maps to the official CoinMarketCap endpoint GET /v3/index/cmc20-historical.
 */
class CoinMarketCapGetV3IndexCmc20Historical extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v3_index_cmc20_historical';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/index/cmc20-historical.';
    protected const PARAMETERS = [
        'time_start' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to start returning CoinMarketCap 20 Index data for. Optional, if not passed, we\'ll return quotes calculated in reverse from "time_end".',
        ],
        'time_end' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timestamp (Unix or ISO 8601) to stop returning CoinMarketCap 20 Index data for (inclusive). Optional, if not passed, we\'ll default to the current time. If no "time_start" is passed, we return quotes in reverse order starting from this time.',
        ],
        'count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The number of interval periods to return results for. Optional, required if both "time_start" and "time_end" aren\'t supplied. The default is 5 items. If "time_start" and "time_end" are supplied, the query limit is 10 and the count starts from "time_start".',
        ],
        'interval' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally adjust the interval of data returned.Valid values:"5m","15m","daily".',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/index/cmc20-historical';
    protected const QUERY_PARAMS = [
        'time_start' => 'time_start',
        'time_end' => 'time_end',
        'count' => 'count',
        'interval' => 'interval',
    ];
    protected const BODY_REQUIRED = false;
}
