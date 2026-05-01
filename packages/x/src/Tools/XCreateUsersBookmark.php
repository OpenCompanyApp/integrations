<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create Bookmark
 */
class XCreateUsersBookmark extends XGeneratedTool
{
    protected const SLUG = 'x_create_users_bookmark';

    protected const DESCRIPTION = 'Create Bookmark';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User for whom to add bookmarks.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createUsersBookmark',
        'method' => 'POST',
        'path' => '/2/users/{id}/bookmarks',
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
        ],
        'required_scopes' => [
            'bookmark.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
            'Bookmarks',
        ],
    ];
}
