<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell tasks.
 */
class ZendeskSellListTasks extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_list_tasks';
    protected string $toolDescription = 'List Zendesk Sell tasks with pagination and resource filters.';
    protected string $path = '/v2/tasks';
    protected array $queryParams = ['page', 'per_page', 'sort_by', 'ids', 'type', 'resource_type', 'resource_id', 'completed', 'owner_id', 'creator_id'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Records per page, max 100.'],
        'resource_type' => ['type' => 'string', 'description' => 'Related resource type such as lead, contact, or deal.'],
        'resource_id' => ['type' => 'integer', 'description' => 'Related resource ID.'],
        'completed' => ['type' => 'boolean', 'description' => 'Filter by completion state.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
    ];
}
