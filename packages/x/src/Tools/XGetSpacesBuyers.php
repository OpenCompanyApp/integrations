<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Space ticket buyers
 */
class XGetSpacesBuyers extends XGeneratedTool
{
    protected const SLUG = 'x_get_spaces_buyers';

    protected const DESCRIPTION = 'Get Space ticket buyers';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Space to be retrieved.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get a specified \'page\' of results.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getSpacesBuyers',
        'method' => 'GET',
        'path' => '/2/spaces/{id}/buyers',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
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
            'Tweets',
        ],
    ];
}
