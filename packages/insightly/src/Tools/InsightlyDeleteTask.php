<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly task.
 */
class InsightlyDeleteTask extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_task';
    protected string $toolDescription = 'Delete an Insightly task.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Tasks/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly task ID to delete.'],
    ];
}
