<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Post analytics
 */
class XGetPostsAnalytics extends XGeneratedTool
{
    protected const SLUG = 'x_get_posts_analytics';

    protected const DESCRIPTION = 'Get Post analytics';

    protected const PARAMETERS = [
        'ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'A comma separated list of Post IDs. Up to 100 are allowed in a single request.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'end_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the end of the time range.',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the start of the time range.',
        ],
        'granularity' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The granularity for the search counts results.',
            'enum' => [
                'hourly',
                'daily',
                'weekly',
                'total',
            ],
        ],
        'analytics.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Analytics fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getPostsAnalytics',
        'method' => 'GET',
        'path' => '/2/tweets/analytics',
        'parameters' => [
            [
                'name' => 'ids',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'end_time',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'start_time',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'granularity',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'analytics.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
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
