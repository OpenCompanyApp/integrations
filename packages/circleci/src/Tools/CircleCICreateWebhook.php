<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Create an outbound webhook.
 */
class CircleCICreateWebhook extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_create_webhook';

    protected string $toolDescription = 'Create an outbound webhook.';

    protected string $method = 'POST';

    protected string $path = '/v2/webhook';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook name.',
    ],
    'url' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook URL.',
    ],
    'events' => [
        'type' => 'array',
        'required' => true,
        'description' => 'Event names.',
    ],
    'verify_tls' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Verify TLS certificate.',
    ],
    'signing_secret' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Signing secret.',
    ],
    'scope' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Webhook scope object.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'name',
    'url',
    'events',
    'scope',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'name',
    'url',
    'events',
    'verify_tls',
    'signing_secret',
    'scope',
];
}
