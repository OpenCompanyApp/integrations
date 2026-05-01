<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get stream rules
 */
class XGetRules extends XGeneratedTool
{
    protected const SLUG = 'x_get_rules';

    protected const DESCRIPTION = 'Get stream rules';

    protected const PARAMETERS = [
        'ids' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma-separated list of Rule IDs.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This value is populated by passing the \'next_token\' returned in a request to paginate through results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getRules',
        'method' => 'GET',
        'path' => '/2/tweets/search/stream/rules',
        'parameters' => [
            [
                'name' => 'ids',
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
            'bearer_token',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Stream',
            'Tweets',
        ],
    ];
}
