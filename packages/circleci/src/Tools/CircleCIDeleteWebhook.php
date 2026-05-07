<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Delete an outbound webhook.
 */
class CircleCIDeleteWebhook extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_delete_webhook';

    protected string $toolDescription = 'Delete an outbound webhook.';

    protected string $method = 'DELETE';

    protected string $path = '/v2/webhook/{webhook_id}';

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
