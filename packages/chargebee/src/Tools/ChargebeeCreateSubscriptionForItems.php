<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Create a subscription with Product Catalog 2.0 item prices.
 */
class ChargebeeCreateSubscriptionForItems extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/subscriptions';

    protected string $toolName = 'chargebee_create_subscription_for_items';

    protected string $toolDescription = 'Create a subscription with Product Catalog 2.0 item prices.';
}
