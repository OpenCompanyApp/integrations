<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List outbound webhooks.
 */
class CircleCIListWebhooks extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_webhooks';

    protected string $toolDescription = 'List outbound webhooks.';

    protected string $method = 'GET';

    protected string $path = '/v2/webhook';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'scope_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Scope ID to filter by.',
    ],
    'scope_type' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Scope type to filter by.',
    ],
    'page_token' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Pagination token from the previous response.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'scope_id' => 'scope-id',
    'scope_type' => 'scope-type',
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
