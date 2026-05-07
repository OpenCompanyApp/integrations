<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Update a Chargebee item price by ID.
 */
class ChargebeeUpdateItemPrice extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/item_prices/{id}';

    protected string $toolName = 'chargebee_update_item_price';

    protected string $toolDescription = 'Update a Chargebee item price by ID.';
}
