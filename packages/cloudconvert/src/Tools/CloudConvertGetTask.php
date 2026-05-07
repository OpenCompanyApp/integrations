<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Get details and status for a CloudConvert task.
 */
class CloudConvertGetTask extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_get_task';

    protected string $toolDescription = 'Get details and status for a CloudConvert task.';

    protected string $method = 'GET';

    protected string $path = '/tasks/{task_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'task_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CloudConvert task ID.',
    ],
    'include' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated includes such as retries,depends_on_tasks,payload,job.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CloudConvert query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'task_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'include',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
