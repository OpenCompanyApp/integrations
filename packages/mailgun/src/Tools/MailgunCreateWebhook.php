<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create a webhook for a domain event.
 */
class MailgunCreateWebhook extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_webhook';

    protected string $toolDescription = 'Create a webhook for a domain event.';

    protected string $method = 'POST';

    protected string $path = '/domains/{domain}/webhooks';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook event name.',
    ],
    'url' => [
        'type' => 'array',
        'required' => true,
        'description' => 'Webhook target URLs.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional webhook fields.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'id',
    'url',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'id',
    'url',
];
}
