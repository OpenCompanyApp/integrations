<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get a webhook.
 */
class BrevoGetWebhook extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_webhook';

    protected string $toolDescription = 'Get a webhook.';

    protected string $method = 'GET';

    protected string $path = '/webhooks/{webhook_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'webhook_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Webhook ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'webhook_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
