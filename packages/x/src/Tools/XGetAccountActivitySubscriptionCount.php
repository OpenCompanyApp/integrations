<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get subscription count
 */
class XGetAccountActivitySubscriptionCount extends XGeneratedTool
{
    protected const SLUG = 'x_get_account_activity_subscription_count';

    protected const DESCRIPTION = 'Get subscription count';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'getAccountActivitySubscriptionCount',
        'method' => 'GET',
        'path' => '/2/account_activity/subscriptions/count',
        'parameters' => [
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
