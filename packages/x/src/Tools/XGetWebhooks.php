<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get webhook
 */
class XGetWebhooks extends XGeneratedTool
{
    protected const SLUG = 'x_get_webhooks';

    protected const DESCRIPTION = 'Get webhook';

    protected const PARAMETERS = [
        'webhook_config.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of WebhookConfig fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getWebhooks',
        'method' => 'GET',
        'path' => '/2/webhooks',
        'parameters' => [
            [
                'name' => 'webhook_config.fields',
                'in' => 'query',
                'required' => false,
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
        'runtime_mode' => 'webhook_subscription',
        'tags' => [
            'Webhooks',
        ],
    ];
}
