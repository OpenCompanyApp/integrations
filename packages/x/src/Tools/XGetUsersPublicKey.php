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
        'public_key.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of PublicKey fields to display.',
            'items' => [
                'type' => 'string',
            ],
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
            [
                'name' => 'public_key.fields',
                'in' => 'query',
                'required' => false,
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
