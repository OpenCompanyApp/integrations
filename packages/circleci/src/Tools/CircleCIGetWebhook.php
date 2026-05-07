<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get an outbound webhook.
 */
class CircleCIGetWebhook extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_webhook';

    protected string $toolDescription = 'Get an outbound webhook.';

    protected string $method = 'GET';

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
