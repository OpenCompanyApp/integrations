<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Community by ID
 */
class XGetCommunitiesById extends XGeneratedTool
{
    protected const SLUG = 'x_get_communities_by_id';

    protected const DESCRIPTION = 'Get Community by ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Community.',
        ],
        'community.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Community fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getCommunitiesById',
        'method' => 'GET',
        'path' => '/2/communities/{id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'community.fields',
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
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'list.read',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Communities',
        ],
    ];
}
