<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * List account-level CloudConvert webhooks.
 */
class CloudConvertListWebhooks extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_list_webhooks';

    protected string $toolDescription = 'List account-level CloudConvert webhooks.';

    protected string $method = 'GET';

    protected string $path = '/users/me/webhooks';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'url' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by webhook URL.',
    ],
    'per_page' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Results per page, defaults to 100.',
    ],
    'page' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Result page.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CloudConvert query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'url' => 'filter[url]',
    'per_page',
    'page',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
