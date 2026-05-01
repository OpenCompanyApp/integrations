<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete List
 */
class XDeleteLists extends XGeneratedTool
{
    protected const SLUG = 'x_delete_lists';

    protected const DESCRIPTION = 'Delete List';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the List to delete.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteLists',
        'method' => 'DELETE',
        'path' => '/2/lists/{id}',
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
            'list.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Lists',
        ],
    ];
}
