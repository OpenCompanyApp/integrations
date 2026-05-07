<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Update a Copper task.
 */
class CopperUpdateTask extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_update_task';

    protected string $toolDescription = 'Update a Copper task. Send only fields that should change.';

    protected string $method = 'PUT';

    protected string $path = '/tasks/{id}';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['name', 'details', 'due_date', 'priority', 'status', 'assignee_id', 'related_resource', 'reminder_date', 'tags'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Copper task ID.'],
        'name' => ['type' => 'string', 'description' => 'Task name.'],
        'details' => ['type' => 'string', 'description' => 'Task details.'],
        'due_date' => ['type' => 'integer', 'description' => 'Due date as Copper Unix timestamp.'],
        'priority' => ['type' => 'string', 'description' => 'Task priority.'],
        'status' => ['type' => 'string', 'description' => 'Task status.'],
        'assignee_id' => ['type' => 'integer', 'description' => 'Assigned user ID.'],
        'related_resource' => ['type' => 'object', 'description' => 'Related Copper entity object.'],
        'reminder_date' => ['type' => 'integer', 'description' => 'Reminder timestamp.'],
        'tags' => ['type' => 'array', 'description' => 'Task tags.'],
    ];
}
