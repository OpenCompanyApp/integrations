<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly task category.
 */
class InsightlyGetTaskCategory extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_task_category';
    protected string $toolDescription = 'Get an Insightly task category by ID.';
    protected string $path = '/v3.1/TaskCategories/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task category ID.'],
    ];
}
