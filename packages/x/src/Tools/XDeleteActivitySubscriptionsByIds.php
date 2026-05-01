<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete X activity subscriptions by IDs
 */
class XDeleteActivitySubscriptionsByIds extends XGeneratedTool
{
    protected const SLUG = 'x_delete_activity_subscriptions_by_ids';

    protected const DESCRIPTION = 'Delete X activity subscriptions by IDs';

    protected const PARAMETERS = [
        'ids' => [
            'type' => 'array',
            'required' => true,
            'description' => 'Comma-separated list of subscription IDs to delete.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteActivitySubscriptionsByIds',
        'method' => 'DELETE',
        'path' => '/2/activity/subscriptions',
        'parameters' => [
            [
                'name' => 'ids',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => false,
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
