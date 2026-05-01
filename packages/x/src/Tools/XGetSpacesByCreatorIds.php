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
        'space.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Space fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'expansions' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of fields to expand.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'user.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of User fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'topic.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Topic fields to display.',
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
            [
                'name' => 'space.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'expansions',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'user.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'topic.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
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
