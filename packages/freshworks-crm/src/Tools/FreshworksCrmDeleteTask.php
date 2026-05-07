<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Delete a Freshworks CRM task.
 */
class FreshworksCrmDeleteTask extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_delete_task';
    protected string $toolDescription = 'Delete a Freshworks CRM task.';
    protected string $method = 'DELETE';
    protected string $path = '/api/tasks/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID to delete.'],
    ];
}
