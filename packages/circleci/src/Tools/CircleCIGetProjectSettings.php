<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get project settings.
 */
class CircleCIGetProjectSettings extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_project_settings';

    protected string $toolDescription = 'Get project settings.';

    protected string $method = 'GET';

    protected string $path = '/v2/project/{project_slug}/settings';

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
