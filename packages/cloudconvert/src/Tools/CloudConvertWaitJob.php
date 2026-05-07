<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Wait until a CloudConvert job finishes or fails using the sync API.
 */
class CloudConvertWaitJob extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_wait_job';

    protected string $toolDescription = 'Wait until a CloudConvert job finishes or fails using the sync API.';

    protected string $method = 'GET';

    protected string $path = '/jobs/{job_id}';

    protected bool $sync = true;

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
