<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Delete a project by project slug.
 */
class CircleCIDeleteProject extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_delete_project';

    protected string $toolDescription = 'Delete a project by project slug.';

    protected string $method = 'DELETE';

    protected string $path = '/v2/project/{project_slug}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
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
