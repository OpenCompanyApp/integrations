<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get project summary metrics and trends.
 */
class CircleCIGetProjectInsightsSummary extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_project_insights_summary';

    protected string $toolDescription = 'Get project summary metrics and trends.';

    protected string $method = 'GET';

    protected string $path = '/v2/insights/{project_slug}/summary';

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
        'description' => 'Reporting window such as last-90-days.',
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
