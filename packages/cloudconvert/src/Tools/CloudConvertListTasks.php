<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * List CloudConvert tasks with documented filters.
 */
class CloudConvertListTasks extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_list_tasks';

    protected string $toolDescription = 'List CloudConvert tasks with documented filters.';

    protected string $method = 'GET';

    protected string $path = '/tasks';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'job_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by job ID.',
    ],
    'status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by waiting, processing, finished, or error.',
    ],
    'operation' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by operation such as convert or import/url.',
    ],
    'include' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated includes such as retries,depends_on_tasks.',
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
    'job_id' => 'filter[job_id]',
    'status' => 'filter[status]',
    'operation' => 'filter[operation]',
    'include',
    'per_page',
    'page',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
