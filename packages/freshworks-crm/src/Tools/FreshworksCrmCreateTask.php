<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Create a Freshworks CRM task.
 */
class FreshworksCrmCreateTask extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_create_task';
    protected string $toolDescription = 'Create a Freshworks CRM task.';
    protected string $method = 'POST';
    protected string $path = '/api/tasks';
    protected string $bodyRoot = 'task';
    protected array $required = ['title'];
    protected array $bodyParams = ['title', 'description', 'due_date', 'owner_id', 'targetable_id', 'targetable_type', 'status', 'task_users_attributes'];
    protected array $parameters = [
        'title' => ['type' => 'string', 'required' => true, 'description' => 'Task title.'],
        'description' => ['type' => 'string', 'description' => 'Task description.'],
        'due_date' => ['type' => 'string', 'description' => 'Due date string accepted by Freshworks CRM.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'targetable_id' => ['type' => 'integer', 'description' => 'Related record ID.'],
        'targetable_type' => ['type' => 'string', 'description' => 'Related record type such as Contact or Deal.'],
        'status' => ['type' => 'string', 'description' => 'Task status.'],
        'task_users_attributes' => ['type' => 'array', 'description' => 'Additional task user assignments.'],
    ];
}
