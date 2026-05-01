<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get my User
 */
class XGetUsersMe extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_me';

    protected const DESCRIPTION = 'Get my User';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'getUsersMe',
        'method' => 'GET',
        'path' => '/2/users/me',
        'parameters' => [
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
            'Users',
        ],
    ];
}
