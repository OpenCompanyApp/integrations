<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a webhook for a domain event.
 */
class MailgunDeleteWebhook extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_webhook';

    protected string $toolDescription = 'Delete a webhook for a domain event.';

    protected string $method = 'DELETE';

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
];

    /** @var list<string> */
    protected array $required = [
    'webhook_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
