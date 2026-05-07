<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Delete a project environment variable.
 */
class CircleCIDeleteProjectEnvVar extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_delete_project_env_var';

    protected string $toolDescription = 'Delete a project environment variable.';

    protected string $method = 'DELETE';

    protected string $path = '/v2/project/{project_slug}/envvar/{env_var_name}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'env_var_name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Environment variable name.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'project_slug',
    'env_var_name',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
