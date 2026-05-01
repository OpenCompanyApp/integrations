<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Update X activity subscription
 */
class XUpdateActivitySubscription extends XGeneratedTool
{
    protected const SLUG = 'x_update_activity_subscription';

    protected const DESCRIPTION = 'Update X activity subscription';

    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the subscription to update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'tag' => [
                    'type' => 'string',
                    'description' => '',
                    'required' => false,
                ],
                'webhook_id' => [
                    'type' => 'string',
                    'description' => 'The unique identifier of this webhook config.',
                    'required' => false,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'updateActivitySubscription',
        'method' => 'PUT',
        'path' => '/2/activity/subscriptions/{subscription_id}',
        'parameters' => [
            [
                'name' => 'subscription_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Activity',
        ],
    ];
}
