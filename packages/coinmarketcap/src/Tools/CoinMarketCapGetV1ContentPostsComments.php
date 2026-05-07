<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Content Post Comments.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/content/posts/comments.
 */
class CoinMarketCapGetV1ContentPostsComments extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_content_posts_comments';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/posts/comments.';
    protected const PARAMETERS = [
        'post_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Required post ID. Example: 325670123',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/content/posts/comments';
    protected const QUERY_PARAMS = [
        'post_id' => 'post_id',
    ];
    protected const BODY_REQUIRED = false;
}
