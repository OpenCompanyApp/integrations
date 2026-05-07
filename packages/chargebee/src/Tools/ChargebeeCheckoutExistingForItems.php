<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Create a hosted checkout page for an existing item-price subscription.
 */
class ChargebeeCheckoutExistingForItems extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/hosted_pages/checkout_existing_for_items';

    protected string $toolName = 'chargebee_checkout_existing_for_items';

    protected string $toolDescription = 'Create a hosted checkout page for an existing item-price subscription.';
}
