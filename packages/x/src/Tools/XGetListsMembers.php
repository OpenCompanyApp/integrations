<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get List members
 */
class XGetListsMembers extends XGeneratedTool
{
    protected const SLUG = 'x_get_lists_members';

    protected const DESCRIPTION = 'Get List members';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the List.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get a specified \'page\' of results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getListsMembers',
        'method' => 'GET',
        'path' => '/2/lists/{id}/members',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'max_results',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
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
            'Lists',
            'Users',
        ],
    ];
}
