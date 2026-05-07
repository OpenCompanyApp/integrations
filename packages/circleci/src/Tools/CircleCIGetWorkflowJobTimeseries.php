<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get timeseries data for a workflow job.
 */
class CircleCIGetWorkflowJobTimeseries extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_workflow_job_timeseries';

    protected string $toolDescription = 'Get timeseries data for a workflow job.';

    protected string $method = 'GET';

    protected string $path = '/v2/insights/{project_slug}/workflows/{workflow_name}/jobs/{job_name}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'workflow_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Workflow name.',
    ],
    'job_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Job name.',
    ],
    'branch' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Branch filter.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'project_slug',
    'workflow_name',
    'job_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'branch',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
