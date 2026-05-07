<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Community Trending Topics.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/community/trending/topic.
 */
class CoinMarketCapGetV1CommunityTrendingTopic extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_community_trending_topic';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/community/trending/topic.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Optionally specify the number of results to return.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/community/trending/topic';
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
    ];
    protected const BODY_REQUIRED = false;
}
