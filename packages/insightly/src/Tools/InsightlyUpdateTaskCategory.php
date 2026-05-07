<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly task category.
 */
class InsightlyUpdateTaskCategory extends InsightlyCreateTaskCategory
{
    protected string $toolName = 'insightly_update_task_category';
    protected string $toolDescription = 'Update an Insightly task category.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/TaskCategories';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'CATEGORY_ID', 'CATEGORY_NAME', 'BACKGROUND_COLOR', 'FOREGROUND_COLOR'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task category ID.'],
        'CATEGORY_NAME' => ['type' => 'string', 'description' => 'Category name.'],
        'BACKGROUND_COLOR' => ['type' => 'string', 'description' => 'Background color value.'],
        'FOREGROUND_COLOR' => ['type' => 'string', 'description' => 'Foreground color value.'],
    ];
}
