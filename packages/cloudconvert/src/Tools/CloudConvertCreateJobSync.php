<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Create a CloudConvert job and wait for completion using the sync API.
 */
class CloudConvertCreateJobSync extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_create_job_sync';

    protected string $toolDescription = 'Create a CloudConvert job and wait for completion using the sync API.';

    protected string $method = 'POST';

    protected string $path = '/jobs';

    protected bool $sync = true;

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
        'description' => 'Optional application tag.',
    ],
    'redirect' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Redirect to export URL when the job has an export/url task.',
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
    'redirect',
];
}
