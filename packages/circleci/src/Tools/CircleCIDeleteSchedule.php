<?php

namespace OpenCompany\Integrations\CircleCI\Tools;

/**
 * Delete a schedule by ID.
 */
class CircleCIDeleteSchedule extends AbstractCircleCITool
{
    protected string $toolName = 'circleci_delete_schedule';

    protected string $toolDescription = 'Delete a schedule by ID.';

    protected string $method = 'DELETE';

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
