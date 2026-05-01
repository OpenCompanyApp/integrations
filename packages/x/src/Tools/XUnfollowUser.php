<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Unfollow User
 */
class XUnfollowUser extends XGeneratedTool
{
    protected const SLUG = 'x_unfollow_user';

    protected const DESCRIPTION = 'Unfollow User';

    protected const PARAMETERS = [
        'source_user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that is requesting to unfollow the target User.',
        ],
        'target_user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the User that the source User is requesting to unfollow.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'unfollowUser',
        'method' => 'DELETE',
        'path' => '/2/users/{source_user_id}/following/{target_user_id}',
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
            'follows.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
        ],
    ];
}
