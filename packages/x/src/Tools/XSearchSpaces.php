<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Search Spaces
 */
class XSearchSpaces extends XGeneratedTool
{
    protected const SLUG = 'x_search_spaces';

    protected const DESCRIPTION = 'Search Spaces';

    protected const PARAMETERS = [
        'query' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The search query.',
        ],
        'state' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The state of Spaces to search for.',
            'enum' => [
                'live',
                'scheduled',
                'all',
            ],
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of results to return.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'searchSpaces',
        'method' => 'GET',
        'path' => '/2/spaces/search',
        'parameters' => [
            [
                'name' => 'query',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'state',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'max_results',
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
