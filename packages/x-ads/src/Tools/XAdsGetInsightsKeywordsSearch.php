<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Keyword Insights insights/keywords/search.
 */
class XAdsGetInsightsKeywordsSearch extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_insights_keywords_search';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Keyword Insights insights/keywords/search.';

    protected const PARAMETERS = [
        'granularity' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'keywords' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'location' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'negative_keywords' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_insights_keywords_search',
        'method' => 'GET',
        'path' => '/{version}/insights/keywords/search',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'granularity',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'keywords',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'start_time',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'end_time',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'location',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'negative_keywords',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'form',
        'auth_modes' => [
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'ads_api_access',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Audience',
            'Keyword Insights',
        ],
    ];
}
