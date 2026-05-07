<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Cancel a job by project slug and job number.
 */
class CircleCICancelJobByNumber extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_cancel_job_by_number';

    protected string $toolDescription = 'Cancel a job by project slug and job number.';

    protected string $method = 'POST';

    protected string $path = '/v2/project/{project_slug}/job/{job_number}/cancel';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'job_number' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Job number.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'project_slug',
    'job_number',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
