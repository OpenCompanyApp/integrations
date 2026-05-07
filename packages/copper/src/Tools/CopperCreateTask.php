<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Create a Copper task.
 */
class CopperCreateTask extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_create_task';

    protected string $toolDescription = 'Create a Copper task.';

    protected string $method = 'POST';

    protected string $path = '/tasks';

    /** @var list<string> */
    protected array $required = ['name'];

    /** @var list<string> */
    protected array $bodyParams = ['name', 'details', 'due_date', 'priority', 'status', 'assignee_id', 'related_resource', 'reminder_date', 'tags'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Task name.'],
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
