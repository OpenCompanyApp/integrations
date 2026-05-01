<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create stream link
 */
class XCreateWebhooksStreamLink extends XGeneratedTool
{
    protected const SLUG = 'x_create_webhooks_stream_link';

    protected const DESCRIPTION = 'Create stream link';

    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook ID to link to your FilteredStream ruleset.',
        ],
        'tweet.fields' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A comma separated list of Tweet fields to display.',
        ],
        'expansions' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A comma separated list of fields to expand.',
        ],
        'media.fields' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A comma separated list of Media fields to display.',
        ],
        'poll.fields' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A comma separated list of Poll fields to display.',
        ],
        'user.fields' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A comma separated list of User fields to display.',
        ],
        'place.fields' => [
            'type' => 'string',
            'required' => false,
            'description' => 'A comma separated list of Place fields to display.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createWebhooksStreamLink',
        'method' => 'POST',
        'path' => '/2/tweets/search/webhooks/{webhook_id}',
        'parameters' => [
            [
                'name' => 'webhook_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'tweet.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'expansions',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'media.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'poll.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'user.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'place.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
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
