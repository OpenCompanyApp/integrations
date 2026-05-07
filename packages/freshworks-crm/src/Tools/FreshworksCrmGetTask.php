<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Fetch a Freshworks CRM task.
 */
class FreshworksCrmGetTask extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_get_task';
    protected string $toolDescription = 'Get a Freshworks CRM task by ID.';
    protected string $path = '/api/tasks/{id}';
    protected array $required = ['id'];
    protected array $queryParams = ['include'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
