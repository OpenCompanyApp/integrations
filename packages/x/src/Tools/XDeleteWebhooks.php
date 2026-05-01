<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete webhook
 */
class XDeleteWebhooks extends XGeneratedTool
{
    protected const SLUG = 'x_delete_webhooks';

    protected const DESCRIPTION = 'Delete webhook';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the webhook to delete.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteWebhooks',
        'method' => 'DELETE',
        'path' => '/2/webhooks/{webhook_id}',
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
            'oauth1a_user_context',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'webhook_subscription',
        'tags' => [
            'Webhooks',
        ],
    ];
}
