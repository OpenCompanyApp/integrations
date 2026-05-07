<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell task.
 */
class ZendeskSellDeleteTask extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_delete_task';
    protected string $toolDescription = 'Delete a Zendesk Sell task by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v2/tasks/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.'],
    ];
}
