<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly tasks.
 */
class InsightlyListTasks extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_tasks';
    protected string $toolDescription = 'List tasks from Insightly.';
    protected string $path = '/v3.1/Tasks';
    protected array $queryParams = ['top', 'skip', 'brief', 'count_total'];
    protected array $parameters = [
        'top' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return.'],
        'skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        'brief' => ['type' => 'boolean', 'description' => 'Return brief records when supported.'],
        'count_total' => ['type' => 'boolean', 'description' => 'Ask Insightly to include total count metadata.'],
    ];
}
