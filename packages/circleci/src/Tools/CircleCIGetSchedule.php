<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Get a schedule by ID.
 */
class CircleCIGetSchedule extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_get_schedule';

    protected string $toolDescription = 'Get a schedule by ID.';

    protected string $method = 'GET';

    protected string $path = '/v2/schedule/{schedule_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'schedule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Schedule ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'schedule_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
