<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Media analytics
 */
class XGetMediaAnalytics extends XGeneratedTool
{
    protected const SLUG = 'x_get_media_analytics';

    protected const DESCRIPTION = 'Get Media analytics';

    protected const PARAMETERS = [
        'media_keys' => [
            'type' => 'array',
            'required' => true,
            'description' => 'A comma separated list of Media Keys. Up to 100 are allowed in a single request.',
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
            'description' => 'The granularity for the search counts results.',
            'enum' => [
                'hourly',
                'daily',
                'total',
            ],
        ],
        'media_analytics.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of MediaAnalytics fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getMediaAnalytics',
        'method' => 'GET',
        'path' => '/2/media/analytics',
        'parameters' => [
            [
                'name' => 'media_keys',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => false,
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
                'name' => 'media_analytics.fields',
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
            'tweet.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Media',
        ],
    ];
}
