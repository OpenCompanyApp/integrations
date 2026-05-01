<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get subscriptions
 */
class XGetAccountActivitySubscriptions extends XGeneratedTool
{
    protected const SLUG = 'x_get_account_activity_subscriptions';

    protected const DESCRIPTION = 'Get subscriptions';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook ID to pull subscriptions for.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getAccountActivitySubscriptions',
        'method' => 'GET',
        'path' => '/2/account_activity/webhooks/{webhook_id}/subscriptions/all/list',
        'parameters' => [
            [
                'name' => 'webhook_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
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
        'runtime_mode' => 'webhook_subscription',
        'tags' => [
            'Account Activity',
        ],
    ];
}
