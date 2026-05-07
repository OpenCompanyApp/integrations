<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List or filter Close tasks.
 */
class CloseListTasks extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_tasks';

    protected string $toolDescription = 'List or filter Close tasks by lead, assignee, completion state, task type, date, and pagination fields.';

    protected string $path = '/task/';

    /** @var list<string> */
    protected array $queryParams = ['lead_id', 'assigned_to', 'is_complete', '_type', '_type__in', 'date', 'date__lt', 'date__lte', 'date__gt', 'date__gte', '_limit', '_skip', '_order_by'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'lead_id' => ['type' => 'string', 'description' => 'Filter tasks by Close lead ID.'],
        'assigned_to' => ['type' => 'string', 'description' => 'Filter tasks by assigned Close user ID.'],
        'is_complete' => ['type' => 'boolean', 'description' => 'Filter completed or incomplete tasks.'],
        '_type' => ['type' => 'string', 'description' => 'Task type. Use all to include all task types.'],
        '_type__in' => ['type' => 'string', 'description' => 'Comma-separated task types, for example missed_call,voicemail.'],
        'date' => ['type' => 'string', 'description' => 'Filter by exact task date.'],
        'date__lt' => ['type' => 'string', 'description' => 'Filter tasks before this date.'],
        'date__lte' => ['type' => 'string', 'description' => 'Filter tasks on or before this date.'],
        'date__gt' => ['type' => 'string', 'description' => 'Filter tasks after this date.'],
        'date__gte' => ['type' => 'string', 'description' => 'Filter tasks on or after this date.'],
        '_limit' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return.'],
        '_skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
        '_order_by' => ['type' => 'string', 'description' => 'Sort order supported by Close.'],
    ];
}
