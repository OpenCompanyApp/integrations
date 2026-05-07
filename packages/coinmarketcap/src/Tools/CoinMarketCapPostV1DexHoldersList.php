<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Get holders list.
 *
 * Maps to the official CoinMarketCap endpoint POST /v1/dex/holders/list.
 */
class CoinMarketCapPostV1DexHoldersList extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_post_v1_dex_holders_list';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/holders/list.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dex/holders/list';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
}
