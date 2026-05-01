<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Bookmarks by folder ID
 */
class XGetUsersBookmarksByFolderId extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_bookmarks_by_folder_id';

    protected const DESCRIPTION = 'Get Bookmarks by folder ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User for whom to return results.',
        ],
        'folder_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Bookmark Folder that the authenticated User is trying to fetch Posts for.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersBookmarksByFolderId',
        'method' => 'GET',
        'path' => '/2/users/{id}/bookmarks/folders/{folder_id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'folder_id',
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
            'bookmark.read',
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
