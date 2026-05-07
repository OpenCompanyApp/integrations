<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List job metrics for a project workflow.
 */
class CircleCIListWorkflowJobMetrics extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_workflow_job_metrics';

    protected string $toolDescription = 'List job metrics for a project workflow.';

    protected string $method = 'GET';

    protected string $path = '/v2/insights/{project_slug}/workflows/{workflow_name}/jobs';

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
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'branch',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
