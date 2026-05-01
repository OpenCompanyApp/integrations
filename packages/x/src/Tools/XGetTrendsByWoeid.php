<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Trends by WOEID
 */
class XGetTrendsByWoeid extends XGeneratedTool
{
    protected const SLUG = 'x_get_trends_by_woeid';

    protected const DESCRIPTION = 'Get Trends by WOEID';

    protected const PARAMETERS = [
        'woeid' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The WOEID of the place to lookup a trend for.',
        ],
        'max_trends' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
        'trend.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Trend fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getTrendsByWoeid',
        'method' => 'GET',
        'path' => '/2/trends/by/woeid/{woeid}',
        'parameters' => [
            [
                'name' => 'woeid',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'max_trends',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'trend.fields',
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
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Trends',
        ],
    ];
}
