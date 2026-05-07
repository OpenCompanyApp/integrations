<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * List artifacts for a job.
 */
class CircleCIListJobArtifacts extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_list_job_artifacts';

    protected string $toolDescription = 'List artifacts for a job.';

    protected string $method = 'GET';

    protected string $path = '/v2/project/{project_slug}/{job_number}/artifacts';

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
    'page_token' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Pagination token from the previous response.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum records to return when supported.',
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
    'job_number',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'page_token' => 'page-token',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
