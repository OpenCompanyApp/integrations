<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Update a webhook.
 */
class BrevoUpdateWebhook extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_update_webhook';

    protected string $toolDescription = 'Update a webhook.';

    protected string $method = 'PUT';

    protected string $path = '/webhooks/{webhook_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'webhook_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Webhook ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
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
    'payload',
];
}
