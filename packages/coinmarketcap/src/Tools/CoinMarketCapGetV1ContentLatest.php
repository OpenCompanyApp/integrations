<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Content Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/content/latest.
 */
class CoinMarketCapGetV1ContentLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_content_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/content/latest.';
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
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally pass a comma-separated list of CoinMarketCap cryptocurrency IDs. Example: "1,1027"',
        ],
        'slug' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally pass a comma-separated list of cryptocurrency slugs. Example: "bitcoin,ethereum"',
        ],
        'symbol' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally pass a comma-separated list of cryptocurrency symbols. Example: "BTC,ETH". Optionally pass "id" *or* "slug" *or* "symbol" is required for this request.',
        ],
        'news_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields: `news`, `community`, or `alexandria` to filter news sources. Pass `all` or leave it blank to include all news types.',
        ],
        'content_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally specify a comma-separated list of supplemental data fields: `news`, `video`, or `audio` to filter news\'s content. Pass `all` or leave it blank to include all content types.',
        ],
        'category' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally pass a comma-separated list of categories. Example: "GameFi,NFT".',
        ],
        'language' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally pass a language code. Example: "en". If not specified the default value is "en".',
            'enum' => [
                'en',
                'zh',
                'zh-tw',
                'de',
                'id',
                'ja',
                'ko',
                'es',
                'th',
                'tr',
                'vi',
                'ru',
                'fr',
                'nl',
                'ar',
                'pt-br',
                'hi',
                'pl',
                'uk',
                'fil-rph',
                'it',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/content/latest';
    protected const QUERY_PARAMS = [
        'start' => 'start',
        'limit' => 'limit',
        'id' => 'id',
        'slug' => 'slug',
        'symbol' => 'symbol',
        'news_type' => 'news_type',
        'content_type' => 'content_type',
        'category' => 'category',
        'language' => 'language',
    ];
    protected const BODY_REQUIRED = false;
}
