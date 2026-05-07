<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Content Latest Posts.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/content/posts/latest.
 */
class CoinMarketCapGetV1ContentPostsLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_content_posts_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/posts/latest.';
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
            'description' => 'Optional. The score is given in the response for finding next batch posts. Example: 1662903634322',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/content/posts/latest';
    protected const QUERY_PARAMS = [
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'last_score' => 'last_score',
    ];
    protected const BODY_REQUIRED = false;
}
