<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Content Top Posts.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/content/posts/top.
 */
class CoinMarketCapGetV1ContentPostsTop extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_content_posts_top';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/posts/top.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional one cryptocurrency CoinMarketCap ID. Example: 1027',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass one cryptocurrency slug. Example: "ethereum"',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Alternatively pass one cryptocurrency symbols. Example: "ETH"',
        ],
        'last_score' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional. The score is given in the response for finding next batch of related posts. Example: 38507.8865',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/content/posts/top';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'last_score' => 'last_score',
    ];
    protected const BODY_REQUIRED = false;
}
