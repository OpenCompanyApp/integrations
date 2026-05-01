<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Unfollow List
 */
class XUnfollowList extends XGeneratedTool
{
    protected const SLUG = 'x_unfollow_list';

    protected const DESCRIPTION = 'Unfollow List';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that will unfollow the List.',
        ],
        'list_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the List to unfollow.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'unfollowList',
        'method' => 'DELETE',
        'path' => '/2/users/{id}/followed_lists/{list_id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'list_id',
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
            'list.write',
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
