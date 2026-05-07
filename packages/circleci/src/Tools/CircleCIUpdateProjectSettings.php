<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Update project settings.
 */
class CircleCIUpdateProjectSettings extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_update_project_settings';

    protected string $toolDescription = 'Update project settings.';

    protected string $method = 'PATCH';

    protected string $path = '/v2/project/{project_slug}/settings';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'project_slug' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CircleCI slug preserving slashes, such as gh/org/repo or circleci/org-id/project-id.',
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
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
