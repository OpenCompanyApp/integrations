<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * CMC Crypto Fear and Greed Historical.
 *
 * Maps to the official CoinMarketCap endpoint GET /v3/fear-and-greed/historical.
 */
class CoinMarketCapGetV3FearAndGreedHistorical extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v3_fear_and_greed_historical';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/fear-and-greed/historical.';
    protected const PARAMETERS = [
        'start' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
        ],
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally specify the number of results to return. Use this parameter and the "start" parameter to determine your own pagination size.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/fear-and-greed/historical';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
    ];
    protected const BODY_REQUIRED = false;
}
