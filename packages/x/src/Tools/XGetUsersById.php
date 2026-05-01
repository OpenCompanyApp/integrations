<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get User by ID
 */
class XGetUsersById extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_by_id';

    protected const DESCRIPTION = 'Get User by ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the User to lookup.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersById',
        'method' => 'GET',
        'path' => '/2/users/{id}',
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
            'Users',
        ],
    ];
}
