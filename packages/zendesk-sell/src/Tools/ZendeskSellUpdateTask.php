<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell task.
 */
class ZendeskSellUpdateTask extends ZendeskSellCreateTask
{
    protected string $toolName = 'zendesk_sell_update_task';
    protected string $toolDescription = 'Update a Zendesk Sell task by ID.';
    protected string $method = 'PUT';
    protected string $path = '/v2/tasks/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.'],
        'content' => ['type' => 'string', 'description' => 'Task content.'],
        'due_date' => ['type' => 'string', 'description' => 'Due date.'],
        'remind_at' => ['type' => 'string', 'description' => 'Reminder timestamp.'],
        'completed' => ['type' => 'boolean', 'description' => 'Completion state.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
    ];
}
