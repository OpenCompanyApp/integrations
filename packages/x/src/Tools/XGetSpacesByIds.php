<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Spaces by IDs
 */
class XGetSpacesByIds extends XGeneratedTool
{
    protected const SLUG = 'x_get_spaces_by_ids';

    protected const DESCRIPTION = 'Get Spaces by IDs';

    protected const PARAMETERS = [
        'ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'The list of Space IDs to return.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getSpacesByIds',
        'method' => 'GET',
        'path' => '/2/spaces',
        'parameters' => [
            [
                'name' => 'ids',
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
