<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Trigger a new pipeline for a project.
 */
class CircleCITriggerPipeline extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_trigger_pipeline';

    protected string $toolDescription = 'Trigger a new pipeline for a project.';

    protected string $method = 'POST';

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
        'description' => 'Branch to build.',
    ],
    'tag' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Tag to build.',
    ],
    'parameters' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Pipeline parameters.',
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
    'branch',
    'tag',
    'parameters',
];
}
