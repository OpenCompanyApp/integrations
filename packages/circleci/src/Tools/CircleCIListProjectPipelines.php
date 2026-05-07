<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List pipelines for a project.
 */
class CircleCIListProjectPipelines extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_project_pipelines';

    protected string $toolDescription = 'List pipelines for a project.';

    protected string $method = 'GET';

    protected string $path = '/v2/project/{project_slug}/pipeline';

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
        'description' => 'Filter by branch.',
    ],
    'page_token' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Pagination token from the previous response.',
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
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
