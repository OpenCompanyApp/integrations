<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Search recent Posts
 */
class XSearchPostsRecent extends XGeneratedTool
{
    protected const SLUG = 'x_search_posts_recent';

    protected const DESCRIPTION = 'Search recent Posts';

    protected const PARAMETERS = [
        'query' => [
            'type' => 'string',
            'required' => true,
            'description' => 'One query/rule/filter for matching Posts. Refer to https://t.co/rulelength to identify the max query length.',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The oldest UTC timestamp from which the Posts will be provided. Timestamp is in second granularity and is inclusive (i.e. 12:00:01 includes the first second of the minute).',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The newest, most recent UTC timestamp to which the Posts will be provided. Timestamp is in second granularity and is exclusive (i.e. 12:00:01 excludes the first second of the minute).',
        ],
        'since_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Returns results with a Post ID greater than (that is, more recent than) the specified ID.',
        ],
        'until_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Returns results with a Post ID less than (that is, older than) the specified ID.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of search results to be returned by a request.',
        ],
        'next_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
        ],
        'sort_order' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This order in which to return results.',
            'enum' => [
                'recency',
                'relevancy',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'searchPostsRecent',
        'method' => 'GET',
        'path' => '/2/tweets/search/recent',
        'parameters' => [
            [
                'name' => 'query',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'start_time',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'end_time',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'since_id',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'until_id',
                'in' => 'query',
                'required' => false,
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
                'name' => 'next_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'sort_order',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Tweets',
        ],
    ];
}
