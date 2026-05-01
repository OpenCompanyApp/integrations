<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Mute User
 */
class XMuteUser extends XGeneratedTool
{
    protected const SLUG = 'x_mute_user';

    protected const DESCRIPTION = 'Mute User';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that is requesting to mute the target User.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'muteUser',
        'method' => 'POST',
        'path' => '/2/users/{id}/muting',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'mute.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
        ],
    ];
}
