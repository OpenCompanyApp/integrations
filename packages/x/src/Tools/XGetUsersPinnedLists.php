<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get pinned Lists
 */
class XGetUsersPinnedLists extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_pinned_lists';

    protected const DESCRIPTION = 'Get pinned Lists';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User for whom to return results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersPinnedLists',
        'method' => 'GET',
        'path' => '/2/users/{id}/pinned_lists',
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
            'list.read',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
            'Lists',
        ],
    ];
}
