<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Delete a CloudConvert job and its temporary data.
 */
class CloudConvertDeleteJob extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_delete_job';

    protected string $toolDescription = 'Delete a CloudConvert job and its temporary data.';

    protected string $method = 'DELETE';

    protected string $path = '/jobs/{job_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'job_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CloudConvert job ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'job_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
