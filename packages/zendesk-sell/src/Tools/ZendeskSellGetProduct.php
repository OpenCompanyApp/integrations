<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell product.
 */
class ZendeskSellGetProduct extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_product';
    protected string $toolDescription = 'Get a Zendesk Sell product by ID.';
    protected string $path = '/v2/products/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Product ID.'],
    ];
}
