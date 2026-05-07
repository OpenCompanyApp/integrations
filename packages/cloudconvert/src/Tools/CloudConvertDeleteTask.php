<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Delete a CloudConvert task and its temporary data.
 */
class CloudConvertDeleteTask extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_delete_task';

    protected string $toolDescription = 'Delete a CloudConvert task and its temporary data.';

    protected string $method = 'DELETE';

    protected string $path = '/tasks/{task_id}';

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
