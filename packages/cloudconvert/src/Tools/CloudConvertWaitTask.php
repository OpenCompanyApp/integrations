<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Wait until a CloudConvert task finishes or fails using the sync API.
 */
class CloudConvertWaitTask extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_wait_task';

    protected string $toolDescription = 'Wait until a CloudConvert task finishes or fails using the sync API.';

    protected string $method = 'GET';

    protected string $path = '/tasks/{task_id}';

    protected bool $sync = true;

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
