<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete Bookmark
 */
class XDeleteUsersBookmark extends XGeneratedTool
{
    protected const SLUG = 'x_delete_users_bookmark';

    protected const DESCRIPTION = 'Delete Bookmark';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User whose bookmark is to be removed.',
        ],
        'tweet_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Post that the source User is removing from bookmarks.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteUsersBookmark',
        'method' => 'DELETE',
        'path' => '/2/users/{id}/bookmarks/{tweet_id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'tweet_id',
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
