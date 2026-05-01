<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get X activity subscriptions
 */
class XGetActivitySubscriptions extends XGeneratedTool
{
    protected const SLUG = 'x_get_activity_subscriptions';

    protected const DESCRIPTION = 'Get X activity subscriptions';

    protected const PARAMETERS = [
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results to return per page.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getActivitySubscriptions',
        'method' => 'GET',
        'path' => '/2/activity/subscriptions',
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
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'tweet.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Activity',
        ],
    ];
}
