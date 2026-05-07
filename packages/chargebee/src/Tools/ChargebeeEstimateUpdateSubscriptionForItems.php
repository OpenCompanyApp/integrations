<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Estimate updating a Product Catalog 2.0 subscription.
 */
class ChargebeeEstimateUpdateSubscriptionForItems extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/estimates/update_subscription_for_items';

    protected string $toolName = 'chargebee_estimate_update_subscription_for_items';

    protected string $toolDescription = 'Estimate updating a Product Catalog 2.0 subscription.';
}
