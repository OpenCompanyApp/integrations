<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell product.
 */
class ZendeskSellDeleteProduct extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_delete_product';
    protected string $toolDescription = 'Delete a Zendesk Sell product by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v2/products/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Product ID.'],
    ];
}
