<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get User by username
 */
class XGetUsersByUsername extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_by_username';

    protected const DESCRIPTION = 'Get User by username';

    protected const PARAMETERS = [
        'username' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A username.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersByUsername',
        'method' => 'GET',
        'path' => '/2/users/by/username/{username}',
        'parameters' => [
            [
                'name' => 'username',
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
            'Users',
        ],
    ];
}
