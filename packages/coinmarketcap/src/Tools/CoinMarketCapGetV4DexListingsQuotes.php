<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * DEX Listings Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v4/dex/listings/quotes.
 */
class CoinMarketCapGetV4DexListingsQuotes extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v4_dex_listings_quotes';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/listings/quotes.';
    protected const PARAMETERS = [
        'start' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally offset the start (1-based index) of the paginated list of items to return.',
        ],
        'limit' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify the number of results to return. Use this parameter and the
"start" parameter to determine your own pagination size.',
        ],
        'sort' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"volume_24h"`
Valid values: `"name"` `"volume_24h"` `"market_share"` `"num_markets"`
What field to sort the list of exchanges by.',
        ],
        'sort_dir' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"desc"`
Valid values: `"desc"` `"asc"`
The direction in which to order exchanges against the specified sort.',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"all"`
Valid values: `"all"` `"orderbook"` `"swap"` `"aggregator"`
The category for this exchange.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`""`
Valid values: `"date_launched"`
Optionally specify a comma-separated list of supplemental data fields to return.',
        ],
        'convert_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally calculate market quotes in up to 30 currencies at once by passing a comma-separated list of cryptocurrency
or fiat currency IDs. Each additional convert option beyond the first requires an additional call credit. A list of
supported fiat options can be found in our API document. Each conversion is returned in its own "quote" object.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v4/dex/listings/quotes';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'sort' => 'sort',
        'sort_dir' => 'sort_dir',
        'type' => 'type',
        'aux' => 'aux',
        'convert_id' => 'convert_id',
    ];
    protected const BODY_REQUIRED = false;
}
