<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Connection History
 */
class XGetConnectionHistory extends XGeneratedTool
{
    protected const SLUG = 'x_get_connection_history';

    protected const DESCRIPTION = 'Get Connection History';

    protected const PARAMETERS = [
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by connection status. Use \'active\' for current connections, \'inactive\' for historical/disconnected connections, or \'all\' for both.',
            'enum' => [
                'active',
                'inactive',
                'all',
            ],
        ],
        'endpoints' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Filter by streaming endpoint. Specify one or more endpoint names to filter results.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results to return per page.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Token for paginating through results. Use the value from \'next_token\' in the previous response.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getConnectionHistory',
        'method' => 'GET',
        'path' => '/2/connections',
        'parameters' => [
            [
                'name' => 'status',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'endpoints',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
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
            'Connections',
        ],
    ];
}
