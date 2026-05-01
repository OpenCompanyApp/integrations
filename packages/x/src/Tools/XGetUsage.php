<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get usage
 */
class XGetUsage extends XGeneratedTool
{
    protected const SLUG = 'x_get_usage';

    protected const DESCRIPTION = 'Get usage';

    protected const PARAMETERS = [
        'days' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of days for which you need usage for.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsage',
        'method' => 'GET',
        'path' => '/2/usage/tweets',
        'parameters' => [
            [
                'name' => 'days',
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
            'Usage',
        ],
    ];
}
