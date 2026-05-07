<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List branches with insight data for a project.
 */
class CircleCIListInsightBranches extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_insight_branches';

    protected string $toolDescription = 'List branches with insight data for a project.';

    protected string $method = 'GET';

    protected string $path = '/v2/insights/{project_slug}/branches';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
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
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
