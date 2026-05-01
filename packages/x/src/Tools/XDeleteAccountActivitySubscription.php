<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete subscription
 */
class XDeleteAccountActivitySubscription extends XGeneratedTool
{
    protected const SLUG = 'x_delete_account_activity_subscription';

    protected const DESCRIPTION = 'Delete subscription';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook ID to check subscription against.',
        ],
        'user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'User ID to unsubscribe from.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteAccountActivitySubscription',
        'method' => 'DELETE',
        'path' => '/2/account_activity/webhooks/{webhook_id}/subscriptions/{user_id}/all',
        'parameters' => [
            [
                'name' => 'webhook_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'user_id',
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
