<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get space by ID
 */
class XGetSpacesById extends XGeneratedTool
{
    protected const SLUG = 'x_get_spaces_by_id';

    protected const DESCRIPTION = 'Get space by ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Space to be retrieved.',
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
        'id' => 'getSpacesById',
        'method' => 'GET',
        'path' => '/2/spaces/{id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
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
