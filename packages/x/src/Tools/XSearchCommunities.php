<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Search Communities
 */
class XSearchCommunities extends XGeneratedTool
{
    protected const SLUG = 'x_search_communities';

    protected const DESCRIPTION = 'Search Communities';

    protected const PARAMETERS = [
        'query' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Query to search communities.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of search results to be returned by a request.',
        ],
        'next_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'searchCommunities',
        'method' => 'GET',
        'path' => '/2/communities/search',
        'parameters' => [
            [
                'name' => 'query',
                'in' => 'query',
                'required' => true,
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
            [
                'name' => 'next_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
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
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Communities',
        ],
    ];
}
