<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM tasks.
 */
class FreshworksCrmListTasks extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_tasks';
    protected string $toolDescription = 'List Freshworks CRM tasks using filter and pagination parameters.';
    protected string $path = '/api/tasks';
    protected array $queryParams = ['filter', 'page', 'per_page', 'include'];
    protected array $parameters = [
        'filter' => ['type' => 'string', 'description' => 'Task filter name.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
