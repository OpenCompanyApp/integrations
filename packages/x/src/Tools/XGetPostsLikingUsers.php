<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Liking Users
 */
class XGetPostsLikingUsers extends XGeneratedTool
{
    protected const SLUG = 'x_get_posts_liking_users';

    protected const DESCRIPTION = 'Get Liking Users';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A single Post ID.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getPostsLikingUsers',
        'method' => 'GET',
        'path' => '/2/tweets/{id}/liking_users',
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
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'like.read',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Tweets',
            'Users',
        ],
    ];
}
