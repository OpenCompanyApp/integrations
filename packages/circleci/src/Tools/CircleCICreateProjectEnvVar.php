<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Create a project environment variable.
 */
class CircleCICreateProjectEnvVar extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_create_project_env_var';

    protected string $toolDescription = 'Create a project environment variable.';

    protected string $method = 'POST';

    protected string $path = '/v2/project/{project_slug}/envvar';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
    ],
    'name' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Environment variable name.',
    ],
    'value' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Environment variable value.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'project_slug',
    'name',
    'value',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'name',
    'value',
];
}
