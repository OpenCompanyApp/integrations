<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create subscription
 */
class XCreateAccountActivitySubscription extends XGeneratedTool
{
    protected const SLUG = 'x_create_account_activity_subscription';

    protected const DESCRIPTION = 'Create subscription';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook ID to check subscription against.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createAccountActivitySubscription',
        'method' => 'POST',
        'path' => '/2/account_activity/webhooks/{webhook_id}/subscriptions/all',
        'parameters' => [
            [
                'name' => 'webhook_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'dm.read',
            'dm.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'webhook_subscription',
        'tags' => [
            'Account Activity',
        ],
    ];
}
