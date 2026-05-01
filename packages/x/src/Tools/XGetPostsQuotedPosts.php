<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Quoted Posts
 */
class XGetPostsQuotedPosts extends XGeneratedTool
{
    protected const SLUG = 'x_get_posts_quoted_posts';

    protected const DESCRIPTION = 'Get Quoted Posts';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A single Post ID.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results to be returned.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get a specified \'page\' of results.',
        ],
        'exclude' => [
            'type' => 'array',
            'required' => false,
            'description' => 'The set of entities to exclude (e.g. \'replies\' or \'retweets\').',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getPostsQuotedPosts',
        'method' => 'GET',
        'path' => '/2/tweets/{id}/quote_tweets',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
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
                'name' => 'pagination_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'exclude',
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
