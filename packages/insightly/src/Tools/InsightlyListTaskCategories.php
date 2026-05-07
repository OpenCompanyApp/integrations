<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly task categories.
 */
class InsightlyListTaskCategories extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_task_categories';
    protected string $toolDescription = 'List Insightly task categories.';
    protected string $path = '/v3.1/TaskCategories';
}
