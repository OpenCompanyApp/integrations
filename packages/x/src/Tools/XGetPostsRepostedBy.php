<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Reposted by
 */
class XGetPostsRepostedBy extends XGeneratedTool
{
    protected const SLUG = 'x_get_posts_reposted_by';

    protected const DESCRIPTION = 'Get Reposted by';

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
        'id' => 'getPostsRepostedBy',
        'method' => 'GET',
        'path' => '/2/tweets/{id}/retweeted_by',
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
            'Users',
        ],
    ];
}
