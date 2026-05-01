<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Unblock DMs
 */
class XUnblockUsersDms extends XGeneratedTool
{
    protected const SLUG = 'x_unblock_users_dms';

    protected const DESCRIPTION = 'Unblock DMs';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the target User that the authenticated user requesting to unblock dms for.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'unblockUsersDms',
        'method' => 'POST',
        'path' => '/2/users/{id}/dm/unblock',
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
            'dm.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
        ],
    ];
}
