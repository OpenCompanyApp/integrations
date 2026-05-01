<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Post by ID
 */
class XGetPostsById extends XGeneratedTool
{
    protected const SLUG = 'x_get_posts_by_id';

    protected const DESCRIPTION = 'Get Post by ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A single Post ID.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getPostsById',
        'method' => 'GET',
        'path' => '/2/tweets/{id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
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
