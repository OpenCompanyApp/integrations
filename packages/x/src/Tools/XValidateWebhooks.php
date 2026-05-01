<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Validate webhook
 */
class XValidateWebhooks extends XGeneratedTool
{
    protected const SLUG = 'x_validate_webhooks';

    protected const DESCRIPTION = 'Validate webhook';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the webhook to check.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'validateWebhooks',
        'method' => 'PUT',
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
