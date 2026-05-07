<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List flaky tests for a project.
 */
class CircleCIListFlakyTests extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_flaky_tests';

    protected string $toolDescription = 'List flaky tests for a project.';

    protected string $method = 'GET';

    protected string $path = '/v2/insights/{project_slug}/flaky-tests';

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
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
