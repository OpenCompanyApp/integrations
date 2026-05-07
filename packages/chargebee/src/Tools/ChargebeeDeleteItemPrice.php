<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Delete or archive a Chargebee item price by ID.
 */
class ChargebeeDeleteItemPrice extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/item_prices/{id}/delete';

    protected string $toolName = 'chargebee_delete_item_price';

    protected string $toolDescription = 'Delete or archive a Chargebee item price by ID.';
}
