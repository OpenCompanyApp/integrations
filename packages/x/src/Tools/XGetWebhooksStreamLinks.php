<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get stream links
 */
class XGetWebhooksStreamLinks extends XGeneratedTool
{
    protected const SLUG = 'x_get_webhooks_stream_links';

    protected const DESCRIPTION = 'Get stream links';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'getWebhooksStreamLinks',
        'method' => 'GET',
        'path' => '/2/tweets/search/webhooks',
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
            'Stream',
        ],
    ];
}
