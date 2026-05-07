<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Estimate cancelling a subscription.
 */
class ChargebeeEstimateCancelSubscriptionForItems extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/subscriptions/{id}/cancel_subscription_for_items_estimate';

    protected string $toolName = 'chargebee_estimate_cancel_subscription_for_items';

    protected string $toolDescription = 'Estimate cancelling a subscription.';
}
