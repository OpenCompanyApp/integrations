<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell task.
 */
class ZendeskSellGetTask extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_task';
    protected string $toolDescription = 'Get a Zendesk Sell task by ID.';
    protected string $path = '/v2/tasks/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.'],
    ];
}
