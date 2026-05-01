<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Reposts of me
 */
class XGetUsersRepostsOfMe extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_reposts_of_me';

    protected const DESCRIPTION = 'Get Reposts of me';

    protected const PARAMETERS = [
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results.',
        ],
        'tweet.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Tweet fields to display.',
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
        'media.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Media fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'poll.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Poll fields to display.',
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
        'place.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Place fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersRepostsOfMe',
        'method' => 'GET',
        'path' => '/2/users/reposts_of_me',
        'parameters' => [
            [
                'name' => 'max_results',
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
            [
                'name' => 'tweet.fields',
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
                'name' => 'media.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'poll.fields',
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
                'name' => 'place.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'timeline.read',
            'tweet.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
        ],
    ];
}
