<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell deal stage.
 */
class ZendeskSellGetStage extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_stage';
    protected string $toolDescription = 'Get a Zendesk Sell deal stage by ID.';
    protected string $path = '/v2/stages/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Stage ID.'],
    ];
}
