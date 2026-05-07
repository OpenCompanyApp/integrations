<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Get details and status for a CloudConvert job.
 */
class CloudConvertGetJob extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_get_job';

    protected string $toolDescription = 'Get details and status for a CloudConvert job.';

    protected string $method = 'GET';

    protected string $path = '/jobs/{job_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'job_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CloudConvert job ID.',
    ],
    'redirect' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Redirect to export URL when available.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CloudConvert query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'job_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'redirect',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
