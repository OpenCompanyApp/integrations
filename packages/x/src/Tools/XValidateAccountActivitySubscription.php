<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Validate subscription
 */
class XValidateAccountActivitySubscription extends XGeneratedTool
{
    protected const SLUG = 'x_validate_account_activity_subscription';

    protected const DESCRIPTION = 'Validate subscription';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook ID to check subscription against.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'validateAccountActivitySubscription',
        'method' => 'GET',
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
        'has_body' => false,
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
