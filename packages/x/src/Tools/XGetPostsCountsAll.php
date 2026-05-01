<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get count of all Posts
 */
class XGetPostsCountsAll extends XGeneratedTool
{
    protected const SLUG = 'x_get_posts_counts_all';

    protected const DESCRIPTION = 'Get count of all Posts';

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
        'granularity' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The granularity for the search counts results.',
            'enum' => [
                'minute',
                'hour',
                'day',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getPostsCountsAll',
        'method' => 'GET',
        'path' => '/2/tweets/counts/all',
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
                'name' => 'granularity',
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
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Tweets',
        ],
    ];
}
