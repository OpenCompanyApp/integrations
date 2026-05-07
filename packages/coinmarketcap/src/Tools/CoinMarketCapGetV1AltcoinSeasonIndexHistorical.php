<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Altcoin Season Index Historical.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/altcoin-season-index/historical.
 */
class CoinMarketCapGetV1AltcoinSeasonIndexHistorical extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_altcoin_season_index_historical';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/altcoin-season-index/historical.';
    protected const PARAMETERS = [
        'timeframe' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Timeframe for historical data. Valid values are 7d, 30d, and 90d. Default is 7d.',
            'enum' => [
                '7d',
                '30d',
                '90d',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/altcoin-season-index/historical';
    protected const QUERY_PARAMS = [
        'timeframe' => 'timeframe',
    ];
    protected const BODY_REQUIRED = false;
}
