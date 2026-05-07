<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get one webhook by event type.
 */
class MailgunGetWebhook extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_webhook';

    protected string $toolDescription = 'Get one webhook by event type.';

    protected string $method = 'GET';

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
        'description' => 'Webhook event name, such as delivered or permanent_fail.',
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
