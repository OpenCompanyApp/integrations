<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Create an Insightly task category.
 */
class InsightlyCreateTaskCategory extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_create_task_category';
    protected string $toolDescription = 'Create an Insightly task category.';
    protected string $method = 'POST';
    protected string $path = '/v3.1/TaskCategories';
    protected array $required = ['CATEGORY_NAME'];
    protected array $bodyParams = ['CATEGORY_NAME', 'BACKGROUND_COLOR', 'FOREGROUND_COLOR'];
    protected array $parameters = [
        'CATEGORY_NAME' => ['type' => 'string', 'required' => true, 'description' => 'Category name.'],
        'BACKGROUND_COLOR' => ['type' => 'string', 'description' => 'Background color value.'],
        'FOREGROUND_COLOR' => ['type' => 'string', 'description' => 'Foreground color value.'],
    ];
}
