<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Update an existing Close task.
 */
class CloseUpdateTask extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_update_task';

    protected string $toolDescription = 'Update an existing Close task, including text, date, assignee, completion state, or lead association.';

    protected string $method = 'PUT';

    protected string $path = '/task/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['text', 'date', 'lead_id', 'assigned_to', 'assignee_id' => 'assigned_to', 'is_complete', '_type'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close task ID to update.'],
        'text' => ['type' => 'string', 'description' => 'Updated task body.'],
        'date' => ['type' => 'string', 'description' => 'Updated task date in YYYY-MM-DD format.'],
        'lead_id' => ['type' => 'string', 'description' => 'Associated Close lead ID.'],
        'assigned_to' => ['type' => 'string', 'description' => 'Assigned Close user ID.'],
        'assignee_id' => ['type' => 'string', 'description' => 'Legacy alias for assigned_to where hosts still use it.'],
        'is_complete' => ['type' => 'boolean', 'description' => 'Whether the task is complete.'],
        '_type' => ['type' => 'string', 'description' => 'Task type, usually lead for manually created tasks.'],
    ];
}
