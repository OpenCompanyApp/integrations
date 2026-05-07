<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Delete a webhook.
 */
class BrevoDeleteWebhook extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_delete_webhook';

    protected string $toolDescription = 'Delete a webhook.';

    protected string $method = 'DELETE';

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
