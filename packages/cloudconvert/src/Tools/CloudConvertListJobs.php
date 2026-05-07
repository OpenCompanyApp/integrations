<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * List CloudConvert jobs with documented filters.
 */
class CloudConvertListJobs extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_list_jobs';

    protected string $toolDescription = 'List CloudConvert jobs with documented filters.';

    protected string $method = 'GET';

    protected string $path = '/jobs';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by processing, finished, or error.',
    ],
    'tag' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by job tag.',
    ],
    'include' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Include tasks.',
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
    'status' => 'filter[status]',
    'tag' => 'filter[tag]',
    'include',
    'per_page',
    'page',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
