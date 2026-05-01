<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Pin List
 */
class XPinList extends XGeneratedTool
{
    protected const SLUG = 'x_pin_list';

    protected const DESCRIPTION = 'Pin List';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that will pin the List.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'list_id' => [
                    'type' => 'string',
                    'description' => 'The unique identifier of this List.',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'pinList',
        'method' => 'POST',
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
        'has_body' => true,
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
