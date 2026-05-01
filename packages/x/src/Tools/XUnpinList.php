<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Unpin List
 */
class XUnpinList extends XGeneratedTool
{
    protected const SLUG = 'x_unpin_list';

    protected const DESCRIPTION = 'Unpin List';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User for whom to return results.',
        ],
        'list_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the List to unpin.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'unpinList',
        'method' => 'DELETE',
        'path' => '/2/users/{id}/pinned_lists/{list_id}',
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
