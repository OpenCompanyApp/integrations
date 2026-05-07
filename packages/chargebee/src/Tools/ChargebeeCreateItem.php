<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Create a Chargebee item.
 */
class ChargebeeCreateItem extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/items';

    protected string $toolName = 'chargebee_create_item';

    protected string $toolDescription = 'Create a Chargebee item.';
}
