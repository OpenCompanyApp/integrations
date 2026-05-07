<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Estimate renewing a subscription.
 */
class ChargebeeEstimateRenewSubscription extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/subscriptions/{id}/renewal_estimate';

    protected string $toolName = 'chargebee_estimate_renew_subscription';

    protected string $toolDescription = 'Estimate renewing a subscription.';
}
