<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete stream link
 */
class XDeleteWebhooksStreamLink extends XGeneratedTool
{
    protected const SLUG = 'x_delete_webhooks_stream_link';

    protected const DESCRIPTION = 'Delete stream link';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook ID to link to your FilteredStream ruleset.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteWebhooksStreamLink',
        'method' => 'DELETE',
        'path' => '/2/tweets/search/webhooks/{webhook_id}',
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
