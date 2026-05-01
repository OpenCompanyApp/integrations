<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Deletes X activity subscription
 */
class XDeleteActivitySubscription extends XGeneratedTool
{
    protected const SLUG = 'x_delete_activity_subscription';

    protected const DESCRIPTION = 'Deletes X activity subscription';

    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the subscription to delete.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteActivitySubscription',
        'method' => 'DELETE',
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
        'has_body' => false,
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
