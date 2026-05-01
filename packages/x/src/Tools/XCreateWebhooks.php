<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create webhook
 */
class XCreateWebhooks extends XGeneratedTool
{
    protected const SLUG = 'x_create_webhooks';

    protected const DESCRIPTION = 'Create webhook';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'url' => [
                    'type' => 'string',
                    'description' => '',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'createWebhooks',
        'method' => 'POST',
        'path' => '/2/webhooks',
        'parameters' => [
        ],
        'has_body' => true,
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
