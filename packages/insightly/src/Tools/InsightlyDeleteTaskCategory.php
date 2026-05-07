<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly task category.
 */
class InsightlyDeleteTaskCategory extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_task_category';
    protected string $toolDescription = 'Delete an Insightly task category by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/TaskCategories/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task category ID.'],
    ];
}
