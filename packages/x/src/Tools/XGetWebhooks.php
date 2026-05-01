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
    ];

    protected const OPERATION = [
        'id' => 'getWebhooks',
        'method' => 'GET',
        'path' => '/2/webhooks',
        'parameters' => [
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
