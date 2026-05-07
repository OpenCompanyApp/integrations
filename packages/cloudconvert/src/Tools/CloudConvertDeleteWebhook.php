<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Delete an account-level CloudConvert webhook.
 */
class CloudConvertDeleteWebhook extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_delete_webhook';

    protected string $toolDescription = 'Delete an account-level CloudConvert webhook.';

    protected string $method = 'DELETE';

    protected string $path = '/webhooks/{webhook_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'webhook_id' => [
        'type' => 'string',
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
