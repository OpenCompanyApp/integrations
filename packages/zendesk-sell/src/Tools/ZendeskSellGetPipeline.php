<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell pipeline.
 */
class ZendeskSellGetPipeline extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_pipeline';
    protected string $toolDescription = 'Get a Zendesk Sell sales pipeline by ID.';
    protected string $path = '/v2/pipelines/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Pipeline ID.'],
    ];
}
