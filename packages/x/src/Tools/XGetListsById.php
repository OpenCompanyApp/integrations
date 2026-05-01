<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get List by ID
 */
class XGetListsById extends XGeneratedTool
{
    protected const SLUG = 'x_get_lists_by_id';

    protected const DESCRIPTION = 'Get List by ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the List.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getListsById',
        'method' => 'GET',
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
        ],
    ];
}
