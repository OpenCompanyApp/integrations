<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Users by usernames
 */
class XGetUsersByUsernames extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_by_usernames';

    protected const DESCRIPTION = 'Get Users by usernames';

    protected const PARAMETERS = [
        'usernames' => [
            'type' => 'array',
            'required' => true,
            'description' => 'A list of usernames, comma-separated.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersByUsernames',
        'method' => 'GET',
        'path' => '/2/users/by',
        'parameters' => [
            [
                'name' => 'usernames',
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
            'Users',
        ],
    ];
}
