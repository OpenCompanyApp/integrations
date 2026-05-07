<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell task.
 */
class ZendeskSellCreateTask extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_create_task';
    protected string $toolDescription = 'Create a Zendesk Sell task related to a lead, contact, or deal.';
    protected string $method = 'POST';
    protected string $path = '/v2/tasks';
    protected array $required = ['content', 'resource_type', 'resource_id'];
    protected array $bodyParams = ['content', 'resource_type', 'resource_id', 'due_date', 'remind_at', 'completed', 'owner_id'];
    protected array $parameters = [
        'content' => ['type' => 'string', 'required' => true, 'description' => 'Task content.'],
        'resource_type' => ['type' => 'string', 'required' => true, 'description' => 'Related resource type such as lead, contact, or deal.'],
        'resource_id' => ['type' => 'integer', 'required' => true, 'description' => 'Related resource ID.'],
        'due_date' => ['type' => 'string', 'description' => 'Due date.'],
        'remind_at' => ['type' => 'string', 'description' => 'Reminder timestamp.'],
        'completed' => ['type' => 'boolean', 'description' => 'Completion state.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
    ];
}
