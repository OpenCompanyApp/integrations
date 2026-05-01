<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Users by IDs
 */
class XGetUsersByIds extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_by_ids';

    protected const DESCRIPTION = 'Get Users by IDs';

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
        'id' => 'getUsersByIds',
        'method' => 'GET',
        'path' => '/2/users',
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
            'Users',
        ],
    ];
}
