<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Search News
 */
class XSearchNews extends XGeneratedTool
{
    protected const SLUG = 'x_search_news';

    protected const DESCRIPTION = 'Search News';

    protected const PARAMETERS = [
        'query' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The search query.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of results to return.',
        ],
        'max_age_hours' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum age of the News story to search for.',
        ],
        'news.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of News fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'searchNews',
        'method' => 'GET',
        'path' => '/2/news/search',
        'parameters' => [
            [
                'name' => 'query',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'max_results',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'max_age_hours',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'news.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
            'oauth2_pkce',
        ],
        'required_scopes' => [
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'News',
        ],
    ];
}
