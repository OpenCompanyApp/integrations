<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Cancel a waiting or processing CloudConvert task.
 */
class CloudConvertCancelTask extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_cancel_task';

    protected string $toolDescription = 'Cancel a waiting or processing CloudConvert task.';

    protected string $method = 'POST';

    protected string $path = '/tasks/{task_id}/cancel';

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
