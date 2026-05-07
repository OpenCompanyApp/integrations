<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Create a retry task from the payload of another task.
 */
class CloudConvertRetryTask extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_retry_task';

    protected string $toolDescription = 'Create a retry task from the payload of another task.';

    protected string $method = 'POST';

    protected string $path = '/tasks/{task_id}/retry';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'task_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'CloudConvert task ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'task_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
