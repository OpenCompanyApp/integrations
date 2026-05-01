<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Unmute User
 */
class XUnmuteUser extends XGeneratedTool
{
    protected const SLUG = 'x_unmute_user';

    protected const DESCRIPTION = 'Unmute User';

    protected const PARAMETERS = [
        'source_user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that is requesting to unmute the target User.',
        ],
        'target_user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the User that the source User is requesting to unmute.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'unmuteUser',
        'method' => 'DELETE',
        'path' => '/2/users/{source_user_id}/muting/{target_user_id}',
        'parameters' => [
            [
                'name' => 'source_user_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'target_user_id',
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
