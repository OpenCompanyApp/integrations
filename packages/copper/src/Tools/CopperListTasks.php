<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Search Copper tasks.
 */
class CopperListTasks extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_tasks';

    protected string $toolDescription = 'Search and list Copper tasks.';

    protected string $method = 'POST';

    protected string $path = '/tasks/search';

    /** @var list<string> */
    protected array $bodyParams = ['page_size', 'page_number', 'sort_by', 'name', 'status', 'priority', 'assignee_ids', 'related_resource', 'due_date', 'tags'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'page_size' => ['type' => 'integer', 'description' => 'Number of tasks per page, up to 200.'],
        'page_number' => ['type' => 'integer', 'description' => 'Page number to fetch.'],
        'sort_by' => ['type' => 'string', 'description' => 'Copper sort field.'],
        'name' => ['type' => 'string', 'description' => 'Filter by task name.'],
        'status' => ['type' => 'string', 'description' => 'Task status filter.'],
        'priority' => ['type' => 'string', 'description' => 'Task priority filter.'],
        'assignee_ids' => ['type' => 'array', 'description' => 'Assignee user IDs.'],
        'related_resource' => ['type' => 'object', 'description' => 'Related Copper entity filter.'],
        'due_date' => ['type' => 'object', 'description' => 'Due date filter object.'],
        'tags' => ['type' => 'array', 'description' => 'Tags filter.'],
    ];
}
