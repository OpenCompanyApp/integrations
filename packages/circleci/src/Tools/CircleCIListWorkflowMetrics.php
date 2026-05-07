<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List workflow metrics for a project.
 */
class CircleCIListWorkflowMetrics extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_workflow_metrics';

    protected string $toolDescription = 'List workflow metrics for a project.';

    protected string $method = 'GET';

    protected string $path = '/v2/insights/{project_slug}/workflows';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'branch' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Branch filter.',
    ],
    'reporting_window' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Reporting window.',
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
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'branch',
    'reporting_window' => 'reporting-window',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
