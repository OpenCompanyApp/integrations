<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Create an account-level CloudConvert webhook.
 */
class CloudConvertCreateWebhook extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_create_webhook';

    protected string $toolDescription = 'Create an account-level CloudConvert webhook.';

    protected string $method = 'POST';

    protected string $path = '/webhooks';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'url' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook endpoint URL.',
    ],
    'events' => [
        'type' => 'array',
        'required' => true,
        'description' => 'Webhook events such as job.finished and job.failed.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional CloudConvert request body fields.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'url',
    'events',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'url',
    'events',
];
}
