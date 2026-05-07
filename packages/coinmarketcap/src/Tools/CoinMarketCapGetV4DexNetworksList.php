<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * CoinMarketCap ID Map.
 *
 * Maps to the official CoinMarketCap endpoint GET /v4/dex/networks/list.
 */
class CoinMarketCapGetV4DexNetworksList extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v4_dex_networks_list';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v4/dex/networks/list.';
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
            'description' => 'Default:`"id"`
Valid values: `"id"` `"name"`
What field to sort the list of networks by.',
        ],
        'sort_dir' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`"desc"`
Valid values: `"desc"` `"asc"`
The direction in which to order networks against the specified sort.',
        ],
        'aux' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Default:`""`
Valid values: `"alternativeName"` `"cryptocurrencyId"` `"cryptocurrenySlug"` `"wrappedTokenId"` `"wrappedTokenSlug"` `"tokenExplorerUrl"` `"poolExplorerUrl"` `"transactionHashUrl"`
Optionally specify a comma-separated list of supplemental data fields to return.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v4/dex/networks/list';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'sort' => 'sort',
        'sort_dir' => 'sort_dir',
        'aux' => 'aux',
    ];
    protected const BODY_REQUIRED = false;
}
