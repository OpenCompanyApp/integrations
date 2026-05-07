<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Cancel a job by job ID.
 */
class CircleCICancelJobById extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_cancel_job_by_id';

    protected string $toolDescription = 'Cancel a job by job ID.';

    protected string $method = 'POST';

    protected string $path = '/v2/jobs/{job_id}/cancel';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'job_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Job ID.',
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
