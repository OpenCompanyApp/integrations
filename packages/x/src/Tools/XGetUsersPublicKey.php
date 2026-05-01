<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get user public keys
 */
class XGetUsersPublicKey extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_public_key';

    protected const DESCRIPTION = 'Get user public keys';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the User to lookup.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersPublicKey',
        'method' => 'GET',
        'path' => '/2/users/{id}/public_keys',
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
