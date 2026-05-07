<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Update a schedule by ID.
 */
class CircleCIUpdateSchedule extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_update_schedule';

    protected string $toolDescription = 'Update a schedule by ID.';

    protected string $method = 'PATCH';

    protected string $path = '/v2/schedule/{schedule_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'schedule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Schedule ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CircleCI JSON body fields to pass through.',
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
    'payload',
];
}
