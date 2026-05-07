<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Community Trending Tokens.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/community/trending/token.
 */
class CoinMarketCapGetV1CommunityTrendingToken extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_community_trending_token';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/community/trending/token.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally specify the number of results to return.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/community/trending/token';
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
    ];
    protected const BODY_REQUIRED = false;
}
