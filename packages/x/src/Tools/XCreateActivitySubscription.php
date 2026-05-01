<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create X activity subscription
 */
class XCreateActivitySubscription extends XGeneratedTool
{
    protected const SLUG = 'x_create_activity_subscription';

    protected const DESCRIPTION = 'Create X activity subscription';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createActivitySubscription',
        'method' => 'POST',
        'path' => '/2/activity/subscriptions',
        'parameters' => [
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'dm.read',
            'tweet.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Activity',
            'Stream',
        ],
    ];
}
