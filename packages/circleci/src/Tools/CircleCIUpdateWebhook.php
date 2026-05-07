<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Update an outbound webhook.
 */
class CircleCIUpdateWebhook extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_update_webhook';

    protected string $toolDescription = 'Update an outbound webhook.';

    protected string $method = 'PUT';

    protected string $path = '/v2/webhook/{webhook_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'webhook_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Webhook ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
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
