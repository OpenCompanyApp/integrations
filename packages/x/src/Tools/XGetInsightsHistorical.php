<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get historical Post insights
 */
class XGetInsightsHistorical extends XGeneratedTool
{
    protected const SLUG = 'x_get_insights_historical';

    protected const DESCRIPTION = 'Get historical Post insights';

    protected const PARAMETERS = [
        'tweet_ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'List of PostIds for historical metrics.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'end_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the end of the time range.',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the start of the time range.',
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
        'id' => 'getInsightsHistorical',
        'method' => 'GET',
        'path' => '/2/insights/historical',
        'parameters' => [
            [
                'name' => 'tweet_ids',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'end_time',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'start_time',
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
