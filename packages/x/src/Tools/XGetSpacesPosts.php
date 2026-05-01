<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Space Posts
 */
class XGetSpacesPosts extends XGeneratedTool
{
    protected const SLUG = 'x_get_spaces_posts';

    protected const DESCRIPTION = 'Get Space Posts';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Space to be retrieved.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of Posts to fetch from the provided space. If not provided, the value will default to the maximum of 100.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getSpacesPosts',
        'method' => 'GET',
        'path' => '/2/spaces/{id}/tweets',
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
            'Tweets',
        ],
    ];
}
