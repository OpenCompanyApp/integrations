<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get 28-hour Post insights
 */
class XGetInsights28Hr extends XGeneratedTool
{
    protected const SLUG = 'x_get_insights28_hr';

    protected const DESCRIPTION = 'Get 28-hour Post insights';

    protected const PARAMETERS = [
        'tweet_ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'List of PostIds for 28hr metrics.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'granularity' => [
            'type' => 'string',
            'required' => true,
            'description' => 'granularity of metrics response.',
            'enum' => [
                'Daily',
                'Hourly',
                'Weekly',
                'Total',
            ],
        ],
        'requested_metrics' => [
            'type' => 'array',
            'required' => true,
            'description' => 'request metrics for historical request.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getInsights28Hr',
        'method' => 'GET',
        'path' => '/2/insights/28hr',
        'parameters' => [
            [
                'name' => 'tweet_ids',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'granularity',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'requested_metrics',
                'in' => 'query',
                'required' => true,
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
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Tweets',
        ],
    ];
}
