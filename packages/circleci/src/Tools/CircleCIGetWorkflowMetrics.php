<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get metrics and recent runs for a workflow.
 */
class CircleCIGetWorkflowMetrics extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_workflow_metrics';

    protected string $toolDescription = 'Get metrics and recent runs for a workflow.';

    protected string $method = 'GET';

    protected string $path = '/v2/insights/{project_slug}/workflows/{workflow_name}';

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
