<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Create an async CloudConvert job with named tasks.
 */
class CloudConvertCreateJob extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_create_job';

    protected string $toolDescription = 'Create an async CloudConvert job with named tasks.';

    protected string $method = 'POST';

    protected string $path = '/jobs';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'tasks' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Named task definitions keyed by task name.',
    ],
    'tag' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Optional application tag for filtering jobs.',
    ],
    'webhook_url' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Optional one-off webhook URL for this job.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional CloudConvert request body fields.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'tasks',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'tasks',
    'tag',
    'webhook_url',
];
}
