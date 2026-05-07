<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get job details by project slug and job number.
 */
class CircleCIGetJobDetails extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_job_details';

    protected string $toolDescription = 'Get job details by project slug and job number.';

    protected string $method = 'GET';

    protected string $path = '/v2/project/{project_slug}/job/{job_number}';

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
