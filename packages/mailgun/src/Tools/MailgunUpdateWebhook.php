<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Update a webhook for a domain event.
 */
class MailgunUpdateWebhook extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_update_webhook';

    protected string $toolDescription = 'Update a webhook for a domain event.';

    protected string $method = 'PUT';

    protected string $path = '/domains/{domain}/webhooks/{webhook_name}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'webhook_name' => [
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
    'webhook_name',
    'url',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'url',
];
}
