<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Delete a Close task.
 */
class CloseDeleteTask extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_delete_task';

    protected string $toolDescription = 'Delete a task from Close.';

    protected string $method = 'DELETE';

    protected string $path = '/task/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close task ID to delete.'],
    ];
}
