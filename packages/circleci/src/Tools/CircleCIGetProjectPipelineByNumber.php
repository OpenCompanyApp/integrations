<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get a project pipeline by pipeline number.
 */
class CircleCIGetProjectPipelineByNumber extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_project_pipeline_by_number';

    protected string $toolDescription = 'Get a project pipeline by pipeline number.';

    protected string $method = 'GET';

    protected string $path = '/v2/project/{project_slug}/pipeline/{pipeline_number}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'pipeline_number' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Project pipeline number.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'project_slug',
    'pipeline_number',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
