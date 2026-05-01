<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Posts by IDs
 */
class XGetPostsByIds extends XGeneratedTool
{
    protected const SLUG = 'x_get_posts_by_ids';

    protected const DESCRIPTION = 'Get Posts by IDs';

    protected const PARAMETERS = [
        'ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'A comma separated list of Post IDs. Up to 100 are allowed in a single request.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getPostsByIds',
        'method' => 'GET',
        'path' => '/2/tweets',
        'parameters' => [
            [
                'name' => 'ids',
                'in' => 'query',
                'required' => true,
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
