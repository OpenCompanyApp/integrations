<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Create a schedule trigger for a project.
 */
class CircleCICreateSchedule extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_create_schedule';

    protected string $toolDescription = 'Create a schedule trigger for a project.';

    protected string $method = 'POST';

    protected string $path = '/v2/project/{project_slug}/schedule';

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
        'description' => 'Schedule name.',
    ],
    'description' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Schedule description.',
    ],
    'attribution_actor' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Attribution actor.',
    ],
    'parameters' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Pipeline parameters.',
    ],
    'timetable' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Schedule timetable object.',
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
    'timetable',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'name',
    'description',
    'attribution_actor',
    'parameters',
    'timetable',
];
}
