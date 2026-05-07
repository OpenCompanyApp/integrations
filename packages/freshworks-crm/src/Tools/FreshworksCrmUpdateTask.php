<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Update a Freshworks CRM task.
 */
class FreshworksCrmUpdateTask extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_update_task';
    protected string $toolDescription = 'Update a Freshworks CRM task.';
    protected string $method = 'PUT';
    protected string $path = '/api/tasks/{id}';
    protected string $bodyRoot = 'task';
    protected array $required = ['id'];
    protected array $bodyParams = ['title', 'description', 'due_date', 'owner_id', 'targetable_id', 'targetable_type', 'status', 'task_users_attributes'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.'],
        'title' => ['type' => 'string', 'description' => 'Task title.'],
        'description' => ['type' => 'string', 'description' => 'Task description.'],
        'due_date' => ['type' => 'string', 'description' => 'Due date string accepted by Freshworks CRM.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'targetable_id' => ['type' => 'integer', 'description' => 'Related record ID.'],
        'targetable_type' => ['type' => 'string', 'description' => 'Related record type.'],
        'status' => ['type' => 'string', 'description' => 'Task status.'],
        'task_users_attributes' => ['type' => 'array', 'description' => 'Additional task user assignments.'],
    ];
}
