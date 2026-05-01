<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create replay job for webhook
 */
class XCreateWebhookReplayJob extends XGeneratedTool
{
    protected const SLUG = 'x_create_webhook_replay_job';

    protected const DESCRIPTION = 'Create replay job for webhook';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'from_date' => [
                    'type' => 'string',
                    'description' => 'The oldest (starting) UTC timestamp (inclusive) from which events will be provided, in yyyymmddhhmm format.',
                    'required' => true,
                ],
                'to_date' => [
                    'type' => 'string',
                    'description' => 'The oldest (starting) UTC timestamp (inclusive) from which events will be provided, in yyyymmddhhmm format.',
                    'required' => true,
                ],
                'webhook_id' => [
                    'type' => 'string',
                    'description' => 'The unique identifier of this webhook config.',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'createWebhookReplayJob',
        'method' => 'POST',
        'path' => '/2/webhooks/replay',
        'parameters' => [
        ],
        'has_body' => true,
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
