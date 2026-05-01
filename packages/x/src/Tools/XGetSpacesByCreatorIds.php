<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Spaces by creator IDs
 */
class XGetSpacesByCreatorIds extends XGeneratedTool
{
    protected const SLUG = 'x_get_spaces_by_creator_ids';

    protected const DESCRIPTION = 'Get Spaces by creator IDs';

    protected const PARAMETERS = [
        'user_ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'The IDs of Users to search through.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getSpacesByCreatorIds',
        'method' => 'GET',
        'path' => '/2/spaces/by/creator_ids',
        'parameters' => [
            [
                'name' => 'user_ids',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
            'oauth2_pkce',
        ],
        'required_scopes' => [
            'space.read',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Spaces',
        ],
    ];
}
