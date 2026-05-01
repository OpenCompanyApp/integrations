<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get public keys for multiple users
 */
class XGetUsersPublicKeys extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_public_keys';

    protected const DESCRIPTION = 'Get public keys for multiple users';

    protected const PARAMETERS = [
        'ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'A list of User IDs, comma-separated. You can specify up to 100 IDs.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersPublicKeys',
        'method' => 'GET',
        'path' => '/2/users/public_keys',
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
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'dm.read',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
            'Chat',
        ],
    ];
}
