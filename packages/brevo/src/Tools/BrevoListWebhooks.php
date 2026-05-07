<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List webhooks.
 */
class BrevoListWebhooks extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_webhooks';

    protected string $toolDescription = 'List webhooks.';

    protected string $method = 'GET';

    protected string $path = '/webhooks';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'type' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Webhook type filter.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum records to return.',
    ],
    'offset' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of records to skip.',
    ],
    'sort' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Sort order when supported.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'type',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
