<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Airdrops.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/cryptocurrency/airdrops.
 */
class CoinMarketCapGetV1CryptocurrencyAirdrops extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_cryptocurrency_airdrops';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/cryptocurrency/airdrops.';
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
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'What status of airdrops.',
            'enum' => [
                'ENDED',
                'ONGOING',
                'UPCOMING',
            ],
        ],
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filtered airdrops by one cryptocurrency CoinMarketCap IDs. Example: 1',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively filter airdrops by a cryptocurrency slug. Example: "bitcoin"',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively filter airdrops one cryptocurrency symbol. Example: "BTC".',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/cryptocurrency/airdrops';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'status' => 'status',
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
    ];
    protected const BODY_REQUIRED = false;
}
