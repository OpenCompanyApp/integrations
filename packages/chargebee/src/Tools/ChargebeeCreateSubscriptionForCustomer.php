<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Create a subscription for an existing customer with item prices.
 */
class ChargebeeCreateSubscriptionForCustomer extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'Customer ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['customer_id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/customers/{customer_id}/subscription_for_items';

    protected string $toolName = 'chargebee_create_subscription_for_customer';

    protected string $toolDescription = 'Create a subscription for an existing customer with item prices.';
}
